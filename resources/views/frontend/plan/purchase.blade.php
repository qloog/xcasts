@extends('frontend.layouts.master')

@section('title')
    订阅
@endsection

@section('content')

    <div class="ui grid">
        <div class="row"></div>
        <div class="row"></div>
    </div>
    {{--<div class="ui center aligned header">订阅，观看更多视频</div>--}}
    <div class="ui vertical stripe center aligned piled segment container">
        <div class="ui tablet stackable huge steps">
            <div class="step">
                <i class="info circle icon"></i>
                <div class="content">
                    <div class="title">1. 确认订单</div>
                    {{--<div class="description">Verify order details</div>--}}
                </div>
            </div>
            <div class="@if($qrCode) active @elseif($paySuccess)  @else disabled @endif step">
                <i class="qrcode icon"></i>
                <div class="content">
                    <div class="title">2. 扫码支付</div>
                    {{--<div class="description">Enter billing information</div>--}}
                </div>
            </div>
            <div class="@if($paySuccess) active @else disabled @endif step">
                <i class="payment icon"></i>
                <div class="content">
                    <div class="title">3. 支付成功</div>
                    {{--<div class="description">Enter billing information</div>--}}
                </div>
            </div>
        </div>

        <div class="ui hidden divider"></div>

        @if ($qrCode)
            <div class="ui text container">
                <h2>请使用 微信 或 支付宝 支付</h2>

                <img src="{{ $qrCode }}" />

                <h4>若支付完成后没有自动跳转页面，请点击</h4>
                <button class="ui teal button" id="paid-btn">已完成支付</button>
                <div class="ui red message">
                    注意：在支付过程中最好不要点击或者关闭页面，支付完成后会自动跳转页面！️
                </div>
            </div>
        @elseif ($paySuccess)
            <div class="ui text container">
                <div class="ui green message">
                    <i class="ui complete icon"></i> 恭喜,购买成功!
                </div>
            </div>
        @else
            <div class="ui text container">
                <table class="ui definition table">
                    <tbody>
                    <tr>
                        <td>商品名称</td>
                        <td>{{ $plan->name }}</td>
                    </tr>
                    <tr>
                        <td>商品价格</td>
                        <td>
                            <a class="ui orange huge label">￥ {{ $plan->price }}</a>
                        </td>
                    </tr>
                    <tr>
                        <td>支付方式</td>
                        <td>微信 / 支付宝</td>
                    </tr>
                    </tbody>
                </table>
            </div>

            <div class="ui hidden divider"></div>

            <div class="ui text container">
                <a class="ui positive button" href="{{ route('plan.pay', ['alias' => $plan->alias]) }}">立即支付</a>
                <div class="ui small brown message">
                    请注意: 虚拟内容商品，购买后不支持退货、转让、退换，请斟酌确认。
                </div>
                {{--<p style="font-size:0.9em; margin: 1em 1em 1em; line-height: 1.4285em">请注意: 虚拟内容商品，购买后不支持退货、转让、退换，请斟酌确认。</p>--}}
            </div>
        @endif

    </div>
@endsection

@section('scripts')

    <script type="text/javascript">
        $(document).ready(function(){ //scroll to top
            $('.buy_action').click(function () {
                // check if user is logined
                var user_id = '{{ Auth::id() }}';
                if (!user_id) {
                    // swal 提示
                    swal({
                                title: "请确认登录",
                                //text: "You will not be able to recover this imaginary file!",
                                type: "warning",
                                showCancelButton: true,
                                cancelButtonText: "再逛逛",
                                confirmButtonColor: "#DD6B55",
                                confirmButtonText: "去登录",
                                closeOnConfirm: false
                            },
                            function(){
                                window.location.href = '{{ route('login') }}';
                            });

                    return false;
                }
            });

            var checkOrder = function () {
                $.get('{{ route('plan.check', ['order_id' => $orderId]) }}', function( data ) {
                    console.log('return', data);
                    if (data.code == 0) {
                        window.onbeforeunload = function(){};
                        window.location.href = '{{ route('plan.success', ['alias' => $plan->alias]) }}';
                    }
                });
            };

            if ('{{ $qrCode }}') {
                var msg = '支付过程中切忌离开页面，以免造成不必要的损失！';
                alert(msg);

                window.onbeforeunload = function(){
                    return msg;
                };

                setInterval(function () {
                    checkOrder()
                }, 3000);
            }

            $('#paid-btn').click(function () {
                window.onbeforeunload = function(){};
                checkOrder();
            })
        });
    </script>
@endsection