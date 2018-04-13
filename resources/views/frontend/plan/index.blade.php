@extends('frontend.layouts.master')

@section('title')
    订阅
@endsection

@section('content')

    <div class="ui grid">
        <div class="row"></div>
        <div class="row"></div>
    </div>
    <div class="ui center aligned header">订阅，观看更多视频</div>

    <div class="ui divider"></div>

    <div class="ui container">
        <div class="ui icon message">
            <i class="announcement icon"></i>
            <div class="content">
                <div class="header">
                    购买提示
                </div>
                <ul class="list">
                    <li>支持微信和支付宝支付</li>
                    <li>投资自己, 投资未来 </li>
                    <li>Just do it. ^_^</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="ui vertical stripe segment container">
        <div class="ui four cards">
            @foreach($plans as $plan)
            <div class="ui card">
                <div class="content">
                    <div class="header center aligned">{{ $plan->name }}</div>
                    <div class="ui hidden divider"></div>
                    <div class="meta center aligned"><i class="massive teal child icon"></i> </div>
                    <div class="ui divider horizontal"><h1 class="ui teal header">{{ $plan->price }}元</h1></div>
                    <div class="meta center aligned">{{ $plan->description }}</div>
                    {{--<div class="ui list">--}}
                        {{--<div class="item"><i class="icon checkmark blue"></i>--}}
                            {{--<div class="content">--}}
                                {{--<b>先体验一个月</b>--}}
                                {{--<br><small></small>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                </div>
                <div class="extra content">
                    <a class="ui button fluid teal buy_action" href="{{ route('plan.purchase', ['alias' => $plan->alias]) }}">现在购买</a>
                </div>
            </div>
            @endforeach
        </div>
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
        });
    </script>
@endsection