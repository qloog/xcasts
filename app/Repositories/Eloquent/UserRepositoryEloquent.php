<?php

namespace App\Repositories\Eloquent;

use App\Exceptions\GeneralException;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Reply;
use App\Models\Topic;
use App\Models\UserMember;
use App\Models\Vote;
use Auth;
use DB;
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
        if (empty($data['name']) || empty($data['type']) || empty($data['pay_method'])) {
            throw new GeneralException('open member need params error');
        }

        $userId = $this->getUserIdByName($data['name']);

        $orderId = 0;
        // generate order
        DB::transaction(function () use($userId, $data) {
            $orderId = $this->createOrder($userId, $data);
            if ($orderId) {
                $this->createOrderItem($userId, $orderId, $data);
                $this->createUserMember($userId, $data);
            }
        });

        return $orderId ? true : false;
    }

    /**
     * 创建订单
     *
     * @param $userId
     * @param $data
     * @return bool|string
     * @throws GeneralException
     */
    private function createOrder($userId, $data)
    {
        $orderId = date('YmdHis' . rand(10000,99999));
        $order = new Order();
        $order->id = $orderId;
        $order->order_amount = $data['order_amount'];
        $order->pay_amount = $data['pay_amount'];
        $order->pay_method = $data['pay_method'];
        $order->paid_at = $data['paid_at'];
        $order->status = 'paid';
        $order->user_id = $userId;
        $ret = $order->save();

        if (!$ret) {
            throw new GeneralException('订单创建失败');
        }

        return  $ret ? $orderId : 0;
    }

    private function createOrderItem($userId, $orderId, $data)
    {
        $item = new OrderItem();
        $item->order_id = $orderId;
        $item->item_id = $data['type'];
        $item->name = $this->getTypeText($data['type']) . '会员';
        $item->price = $data['pay_amount'];
        $quantity = 1;
        $item->quantity = $quantity;
        $item->amount = $data['pay_amount'] * $quantity;
        $item->user_id = $userId;
        $item->save();
    }

    private function createUserMember($userId, $data)
    {
        $preMember = UserMember::where('user_id',$userId)->where('status',1)->first();
        // 新买会员
        if (!$preMember) {
            $userMember = new UserMember();
            $userMember->type = $data['type'];
            $startTime = $data['paid_at'];
            $userMember->start_time = $startTime;
            $userMember->user_id = $userId;
            $userMember->end_time = $this->getEndTime($startTime, $data['type']);
            $userMember->status = 1;

            return $userMember->saveOrFail();
        } else {
            // 已经购买过会员
            // a. 会员还未到期就续费, 则在结束时间上再加对应的时间段即可
            if (time() <= strtotime($preMember->end_time)) {
                $preMember->end_time = $this->getEndTime($preMember->end_time, $data['type']);
                $preMember->type = $data['type'];

                return $preMember->save();
            } else {
                // b. 购买的会员已经过期再次购买: 先将之前的记录status置为0, 再新插入一条
                $preMember->status = 0;
                $preMember->save();

                $userMember = new UserMember();
                $userMember->type = $data['type'];
                $startTime = $data['paid_at'];
                $userMember->start_time = $startTime;
                $userMember->user_id = $userId;
                $userMember->end_time = $this->getEndTime($startTime, $data['type']);
                $userMember->status = 1;
                return $userMember->save();
            }
        }
    }

    /**
     * 获得结束时间
     *
     * @param $startTime
     * @param $level
     * @return bool|string
     */
    private function getEndTime($startTime, $level)
    {
        $startTime = strtotime($startTime);
        $monthTime = 24*3600*30; // 一个月
        $endTime = 0;
        switch ($level) {
            // 一个月
            case 1:
                $endTime = $startTime + $monthTime;
                break;
            // 3个月
            case 2:
                $endTime = $startTime + $monthTime*3;
                break;
            // 半年
            case 3:
                $endTime = $startTime + $monthTime*6;
                break;
            // 一年
            case 4:
                $endTime = $startTime + $monthTime*12;
                break;
            // 两年
            case 5:
                $endTime = $startTime + $monthTime*24;
                break;
            // 3年
            case 6:
                $endTime = $startTime + $monthTime*36;
                break;
        }

        return date('Y-m-d H:i:s', $endTime);
    }

    public function memberDetail($userId)
    {
        $record =  UserMember::where('user_id', $userId)->where('status',1)->first();

        if ($record) {
            $record->type = $this->getTypeText($record->type);
        }

        return $record;
    }

    private function getTypeText($type)
    {
        switch ($type) {
            case 1:
                $text = '月度';
                break;
            case 2:
                $text = '季度';
                break;
            case 3:
                $text = '半年';
                break;
            case 4:
                $text = '年';
                break;
            case 5:
                $text = '2年';
                break;
            case 6:
                $text = '3年';
                break;
            default:
                $text = '--';
        }

        return $text;
    }

    public function isMember($userId)
    {
        $detail = UserMember::where('user_id', $userId)->where('status',1)->first();
        if ($detail) {
            return ((time() > strtotime($detail->start_time)) && (strtotime($detail->end_time) > time()))  ? true:  false;
        }

        return false;
    }
}
