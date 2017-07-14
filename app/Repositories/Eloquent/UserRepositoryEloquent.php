<?php

namespace App\Repositories\Eloquent;

use App\Exceptions\GeneralException;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Reply;
use App\Models\Topic;
use App\Models\Vote;
use Auth;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Contracts\Repositories\UserRepository;
use App\Models\User;

/**
 * Class UserRepositoryEloquent
 * @package namespace App\Repositories\Eloquent\Backend;
 */
class UserRepositoryEloquent extends BaseRepository implements UserRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return User::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    /**
     * 创建新用户
     *
     * @param array $input
     * @return bool
     * @throws GeneralException
     */
    public function create(array $input)
    {
        if (isset($input['assignees_roles']) && count($input['assignees_roles']) == 0) {
            throw new GeneralException('You must select at least one role for this user.');
        }

        $user = new User;
        $user->name = $input['name'];
        $user->email = $input['email'];
        //$user->password = $input['password'];
        $user->status = isset($input['status']) ? 1 : 0;
        //$user->confirmation_code = md5(uniqid(mt_rand(), true));
        //$user->confirmed = isset($input['confirmed']) ? 1 : 0;
        if ($user->save()) {
            //Attach new roles
            $user->attachRoles($input['assignees_roles']);
            return true;
        }
        throw new GeneralException('There was a problem creating this user. Please try again.');
    }

    /**
     * 更新用户
     *
     * @param array $input
     * @param       $id
     * @param bool  $withRole
     * @return bool
     * @throws GeneralException
     * @internal param $roles
     */
    public function update(array $input, $id, $withRole = true)
    {
        $user = User::find($id);

        if (!$withRole) {
            return $user->update($input);
        }

        $this->checkUserByEmail($input, $user);
        $roles['assignees_roles'] = $input['assignees_roles'];
        if ($user->update($input)) {
            //For whatever reason this just wont work in the above call, so a second is needed for now
            $user->status = isset($input['status']) ? 1 : 0;
            //$user->confirmed = isset($input['confirmed']) ? 1 : 0;
            $user->save();
            $this->checkUserRolesCount($roles);
            $this->flushRoles($roles, $user);
            //$this->flushPermissions($permissions, $user);
            return true;
        }
        throw new GeneralException('There was a problem updating this user. Please try again.');
    }

    public function updateAvatar($input, $id)
    {

    }

    /**
     * @param $input
     * @param $user
     * @throws GeneralException
     */
    private function checkUserByEmail($input, $user)
    {
        //Figure out if email is not the same
        if ($user->email != $input['email'])
        {
            //Check to see if email exists
            if (User::where('email', '=', $input['email'])->first()) {
                throw new GeneralException('That email address belongs to a different user.');
            }
        }
    }
    /**
     * @param $roles
     * @param $user
     */
    private function flushRoles($roles, $user)
    {
        //Flush roles out, then add array of new ones
        $user->detachRoles($user->roles);
        $user->attachRoles($roles['assignees_roles']);
    }

    /**
     * @param $roles
     * @throws GeneralException
     */
    private function checkUserRolesCount($roles)
    {
        //User Updated, Update Roles
        //Validate that there's at least one role chosen
        if (count($roles['assignees_roles']) == 0) {
            throw new GeneralException('You must choose at least one role.');
        }
    }

    /**
     * @param $id
     * @return mixed
     */
    public function destroy($id)
    {
        $user = User::find($id);

        $user->status = 0;

        return $user->save();
    }

    public function getTopicsByUserId($userId, $limit = 15)
    {
        return Topic::whose($userId)->recent()->paginate($limit);
    }

    public function getRepliesByUserId($userId, $limit = 15)
    {
        return Reply::whose($userId)->recent()->paginate($limit);
    }

    public function getVotesByUserId($userId, $limit = 15)
    {
        return $this->find($userId)->votedTopics()->orderBy('pivot_created_at','desc')->paginate($limit);
    }

    public function getFollowingsByUserId($userId, $limit = 15)
    {
        return $this->find($userId)->followings()->orderBy('id', 'desc')->paginate($limit);
    }

    public function getFollowersByUserId($userId, $limit)
    {
        return $this->find($userId)->followers()->orderBy('id', 'desc')->paginate($limit);
    }

    /**
     * 关注/取消关注某用户
     *
     * @param int $userId 被关注或取消关乎的用户id
     * @return bool
     */
    public function followUser($userId)
    {
        $user = $this->find(Auth::id());
        $toUser = $this->find($userId);

        if ($user->isFollowing($userId)) {
            return $user->unfollow($userId)  && $toUser->decrement('follower_count', 1);
        } else {
            app('XCasts\Notifications\Notifier')->newFollowNotify($user, $toUser);
            return $user->follow($userId) && $toUser->increment('follower_count', 1);
        }
    }

    public function getUserIdByName($name)
    {
        $user = User::where('name', $name)->first();

        return $user ? $user->id : 0;
    }

    /**
     * 开通会员
     *
     * @param $data
     * @return bool
     * @throws GeneralException
     */
    public function openMember($data)
    {
        if (empty($data['name']) || empty($data['plan_type']) || empty($data['pay_method'])) {
            throw new GeneralException('open member need params error');
        }

        $userId = $this->getUserIdByName($data['name']);

        // generate order
        $orderId = date('YmdHis' . rand(10000,99999));
        $order = new Order();
        $order->id = $orderId;
        $order->order_amount = $data['order_amount'];
        $order->pay_amount = $data['pay_amount'];
        $order->quantity = 1;
        $order->pay_method = $data['pay_method'];
        $order->is_paid = 1;
        $order->paid_at = $data['paid_at'];
        $order->completed_at = $data['paid_at'];
        $order->status = 'paid';
        $order->user_id = $this->getUserIdByName($data['name']);
        $orderRet = $order->save();

        if (!$orderRet) {
            throw new GeneralException('订单创建失败');
        }

        // write to order_details
        // todo: drop order_details and add vips(order_id, user_id, type, expire_at)
        $ret = false;
        if ($orderId) {
            $detail = new orderDetail();
            $detail->order_id = $orderId;
            $detail->goods_id = 1;
            $detail->goods_name = '月度会员';
            $detail->goods_price = $data['pay_amount'];
            $detail->quantity = 1;
            $detail->expired_at = time();   // todo: 通过计算获得
            $detail->user_id = $userId;
            $ret = $detail->save();
        }

        if ($ret) {
            return true;
        }
    }

    public function memberDetail($userId)
    {
        return OrderDetail::where('user_id', $userId)->first();
    }

    public function isMember($userId)
    {
        $detail = OrderDetail::where('user_id', $userId)->first();
        if ($detail) {
            return strtotime($detail->expired_at) > time() ? true:  false;
        }

        return false;
    }
}
