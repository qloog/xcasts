<?php

namespace App\Repositories\Eloquent;

use App\Exceptions\GeneralException;
use App\Models\OrderItem;
use App\Models\Plan;
use Carbon\Carbon;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Contracts\Repositories\OrdersRepository;
use App\Models\Order;
use App\Validators\OrdersValidator;

/**
 * Class OrdersRepositoryEloquent
 * @package namespace App\Repositories\Eloquent;
 */
class OrdersRepositoryEloquent extends BaseRepository implements OrdersRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Order::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function genOrderNo()
    {
        return date('YmdHis' . rand(10000,99999));
    }

    /**
     * @param Plan $plan
     * @return bool
     */
    public function createOrder(Plan $plan)
    {
        $orderId = date('YmdHis' . rand(10000,99999));
        $userId = \Auth::id();

        $order = new Order();
        $order->id = $orderId;
        $order->order_amount = $plan->price;
        $order->pay_amount = $plan->price;
        $order->pay_method = 'wechat';
        $order->paid_at = Carbon::now();
        $order->status = 'pending';
        $order->user_id = $userId;
        $orderRet = $order->save();

        $itemRet = false;
        if ($orderRet) {
            $item = new OrderItem();
            $item->order_id = $orderId;
            $item->item_id = $plan->id;
            $item->name = $plan->name;
            $item->price = $plan->price;
            $quantity = 1;
            $item->quantity = $quantity;
            $item->amount = $plan->price * $quantity;
            $item->user_id = $userId;
            $itemRet = $item->save();
        }

        return $orderRet && $itemRet ? $orderId : 0;
    }

    /**
     *
     *
     * @param $qrId
     * @return bool
     */
    public function paidOrder($qrId)
    {
        if (!$qrId) {
            return false;
        }

        return Order::where('qrcode_id', $qrId)->update(['status' => 'paid', 'paid_at' => Carbon::now()]);
    }

}
