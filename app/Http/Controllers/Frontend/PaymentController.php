<?php

namespace App\Http\Controllers\Frontend;

use App\Contracts\Repositories\GoodsRepository;
use App\Contracts\Repositories\OrdersRepository;
use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Input;
use Log;

/**
 * @property GoodsRepository  goodsRepo
 * @property OrdersRepository orderRepo
 */
class PaymentController extends Controller
{
    public function __construct(GoodsRepository $goodsRepository, OrdersRepository $ordersRepository)
    {
        $this->goodsRepo = $goodsRepository;
        $this->orderRepo = $ordersRepository;
    }

    /**
     * 支付
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function pay(Request $request)
    {
        // 下订单
        $plan = $request->get('plan');
        $goodsInfo = $this->goodsRepo->findByField('alias', $plan)->first();

        // 生成订单
        $orderData = [
            'id' => $this->orderRepo->genOrderNo(),
            'order_amount' => $goodsInfo->price,
            'pay_amount' => $goodsInfo->price,
            'quantity' => 1,
            'is_paid' => 0,
            'user_id' => Auth::id(),
            'created_at' => time()
        ];
        $orderNo = $this->orderRepo->create($orderData);

        // 获取支付跳转链接并跳转
        // 创建支付单。
        $alipay = app('alipay.web');
        $alipay->setOutTradeNo($orderNo);
        $alipay->setTotalFee($goodsInfo->pay_amount);
        $alipay->setSubject($goodsInfo->name);
        $alipay->setBody($goodsInfo->description);

        $alipay->setQrPayMode('4'); //该设置为可选，添加该参数设置，支持二维码支付。

        // 跳转到支付页面。
        return redirect()->to($alipay->getPayLink());
    }

    /**
     * 同步通知
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function return()
    {
        // 验证请求。
        if (! app('alipay.web')->verify()) {
            Log::notice('Alipay return query data verification fail.', [
                'data' => Request::getQueryString()
            ]);
            return view('frontend.payment.fail');
        }

        // 判断通知类型。
        switch (Input::get('trade_status')) {
            case 'TRADE_SUCCESS':
            case 'TRADE_FINISHED':
                // TODO: 支付成功，取得订单号进行其它相关操作。
                Log::debug('Alipay notify get data verification success.', [
                    'out_trade_no' => Input::get('out_trade_no'),
                    'trade_no' => Input::get('trade_no')
                ]);
                break;
        }

        return view('frontend.payment.success');
    }

    /**
     * 异步通知
     *
     * @return string
     */
    public function notify()
    {
        // 验证请求。
        if (! app('alipay.web')->verify()) {
            Log::notice('Alipay notify post data verification fail.', [
                'data' => Request::instance()->getContent()
            ]);
            return 'fail';
        }

        // 判断通知类型。
        switch (Input::get('trade_status')) {
            case 'TRADE_SUCCESS':
            case 'TRADE_FINISHED':
                // TODO: 支付成功，取得订单号进行其它相关操作。
                Log::debug('Alipay notify post data verification success.', [
                    'out_trade_no' => Input::get('out_trade_no'),
                    'trade_no' => Input::get('trade_no')
                ]);
                break;
        }

        return 'success';
    }

    public function cancel()
    {

    }
}
