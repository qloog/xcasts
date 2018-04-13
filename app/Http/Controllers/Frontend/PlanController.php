<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Plan;
use App\Repositories\Eloquent\OrdersRepositoryEloquent;
use App\Repositories\Eloquent\UserRepositoryEloquent;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Slince\YouzanPay\ApiContext;
use Slince\YouzanPay\YouzanPay;

class PlanController extends Controller
{

    protected $ordersRepo;
    protected $userRepo;

    public function __construct(OrdersRepositoryEloquent $ordersRepository, UserRepositoryEloquent $userRepository)
    {
        $this->ordersRepo = $ordersRepository;
        $this->userRepo = $userRepository;
    }

    public function index()
    {
        $plans = Plan::where('status', 1)->get();

        return view('frontend.plan.index', compact('plans'));
    }

    private static function getYouzanPay()
    {
        $clientId = env('YOUZAN_CLIENT_ID');
        $clientSecret = env('YOUZAN_CLIENT_SECRET');
        $kdtId = env('YOUZAN_KDT_ID');

        $apiContext = new ApiContext($clientId, $clientSecret, $kdtId);
        return new YouzanPay($apiContext);
    }

    public function purchase($alias)
    {
        $plan = Plan::where('alias', $alias)->first();

        $qrCode = '';
        $orderId = 0;
        $paySuccess = false;

        return view('frontend.plan.purchase', compact('plan', 'orderId', 'qrCode','paySuccess'));
    }

    public function pay($alias)
    {
        $plan = Plan::where('alias', $alias)->first();

        $orderId = $this->ordersRepo->createOrder($plan);
        if ($orderId) {
            $qrCodeResponse = self::getYouzanPay()->charge(
                [
                    'name' => $plan->name,
                    'price' => $plan->price * 100, // 单位是分
                    'source' => $orderId
                ]
            );
            $qrCode = $qrCodeResponse->getCode();

            $ret = Order::find($orderId)->update(['qrcode_id' => $qrCodeResponse->getId()]);
            Log::info('pay order: ', ['qrcode_resp' => $qrCodeResponse->getId(), 'update_ret' => $ret]);
        }

        $paySuccess = false;

        return view('frontend.plan.purchase', compact('plan', 'orderId', 'qrCode', 'paySuccess'));
    }

    public function success($alias)
    {
        $plan = Plan::where('alias', $alias)->first();

        $paySuccess = true;
        $qrCode = '';
        $orderId = 0;

        return view('frontend.plan.purchase', compact('plan', 'orderId', 'qrCode', 'paySuccess'));
    }

    /**
     * 页面轮询验证二维码的支付状态
     *
     * @param $orderId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function checkQRStatus($orderId)
    {
        $orderInfo = Order::where(['id'=>$orderId])->first()->toArray();

        $data = [
            'code' => $orderInfo && $orderInfo['status'] == 'paid' ? 0 : 1,
            'msg' => 'ok'
        ];

        return response()->json($data);
    }

    /**
     * youzan 推送回调地址
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @link https://www.youzanyun.com/docs/guide/3401/3449
     */
    public function push(Request $request)
    {
        Log::info('entry push...');
        $data = self::getYouzanPay()->verifyWebhook($request);
        Log::info('push data: ', ['data' => $data]);

        $successMsg = ['code' => 0, 'msg' => 'success'];
        if ($data['type'] =! 'TRADE_ORDER_STATE') {
            return response()->json($successMsg);
        }

        // 交易成功
        if ($data['status'] == 'TRADE_SUCCESS') {
            // 交易id
            $trade = self::getYouzanPay()->getTrade($data['id']);
            Log::info('youzan push callback: ', ['request' => $request, 'trade' => $data]);

            $qrId = $trade->getQrId();
            $orderInfo = $this->ordersRepo->findByField('qrcode_id', $qrId)->first()->toArray();

            if ($orderInfo && $orderInfo['status'] == 'paid') {
                return response()->json($successMsg);
            }

            // 开通会员
            if ($this->ordersRepo->paidOrder($qrId)) {
                // 订单详情
                $orderItem = OrderItem::where('order_id', $orderInfo['id'])->first();
                $orderInfo['type'] = $orderItem['item_id'];

                $ret = $this->userRepo->createUserMember(Auth::id(), $orderInfo);
                Log::info('youzan push callback open member: ', ['ret' => $ret]);

                return response()->json($successMsg);
            }
        }

        return response()->json($successMsg);
    }
}
