@extends('frontend.layouts.master')

@section('title')
    订阅
@endsection

@section('content')

    <div class="ui container">
        <div class="ui hidden divider"></div>
        <div class="ui hidden divider"></div>

        <div class="ui header center aligned">订阅，观看更多视频</div>
        <div class="ui cards four">
            <div class="ui card">
                <div class="content">
                    <div class="header center aligned">按月付</div>
                    <div class="ui hidden divider"></div>
                    <div class="meta center aligned"><i class="massive teal child icon"></i> </div>
                    <div class="ui divider horizontal"><h1 class="ui teal header">69元</h1></div>
                    <div class="meta center aligned">试看一个月</div>
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
                    <button class="ui button fluid teal buy_action" data-price="69" data-title="按月付" data-qr-url="{{ cdn('/images/month.jpeg') }}">现在购买</button>
                </div>
            </div>
            <div class="ui card">
                <div class="content">
                    {{--<a class="ui label left corner teal">--}}
                        {{--<i class="icon plus"></i>--}}
                    {{--</a>--}}
                    <div class="header center aligned">按季付</div>
                    <div class="ui hidden divider"></div>
                    <div class="meta center aligned"><i class="massive teal user icon"></i></div>
                    <div class="ui divider horizontal"><h1 class="ui teal header">199元</h1></div>
                    <div class="meta center aligned">先来一个季度</div>
                    {{--<div class="ui list">--}}
                        {{--<div class="item"><i class="icon checkmark blue"></i>--}}
                            {{--<div class="content">--}}
                                {{--<b>来一季度试试</b>--}}
                                {{--<br><small></small>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                </div>
                <div class="extra content">
                    <button class="ui button fluid teal buy_action" data-price="199" data-title="按季付" data-qr-url="{{ cdn('/images/quarter.jpeg') }}">现在购买</button>
                </div>
            </div>
            <div class="ui card">
                <div class="content">
                    <div class="header center aligned">半年付</div>
                    <div class="ui hidden divider"></div>
                    <div class="meta center aligned"><i class="massive centered teal student icon"></i></div>
                    <div class="ui divider horizontal"><h1 class="ui teal header">399元</h1></div>
                    <div class="meta center aligned">来它半年</div>
                    {{--<div class="ui list">--}}
                        {{--<div class="item"><i class="icon minus"></i>--}}
                            {{--<div class="content">--}}
                                {{--<b>半年适合我</b>--}}
                                {{--<br><small></small>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                </div>
                <div class="extra content">
                    <button class="ui button fluid teal buy_action" data-price="399" data-title="半年付" data-qr-url="{{ cdn('/images/half-year.jpeg') }}">现在购买</button>
                </div>
            </div>
            <div class="ui card">
                <div class="content">
                    <div class="header center aligned">按年付</div>
                    <div class="ui hidden divider"></div>
                    <div class="meta center aligned"><i class="massive teal spy icon"></i></div>
                    <div class="ui divider horizontal"><h1 class="ui teal header">599元</h1></div>
                    <div class="meta center aligned">必须一年啊</div>
                    {{--<div class="ui list">--}}
                        {{--<div class="item"><i class="icon checkmark blue"></i>--}}
                            {{--<div class="content">--}}
                                {{--<b>来上一年</b>--}}
                                {{--<br><small></small>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                </div>
                <div class="extra content">
                    <button class="ui button fluid teal buy_action" data-price="599" data-title="按年付" data-qr-url="{{ cdn('/images/year.jpeg') }}">现在购买</button>
                </div>
            </div>
        </div>
    </div>

    <div class="ui grid">
        <div class="row"></div>
        <div class="row"></div>
    </div>

    <div class="ui modal">
        <i class="close icon"></i>
        <div class="header">
            微信扫码支付
        </div>
        <div class="image content">
            <div class="ui medium image">
                <img id="qr_url" src="https://ss0.baidu.com/6ONWsjip0QIZ8tyhnq/it/u=1062989499,1682648318&fm=58">
            </div>
            <div class="description">
                <div class="ui header" id="title">按月购买</div>
                <p><h1 class="ui teal header" id="price">￥69</h1></p>
                <p>
                <div class="ui warning message">
                    <i class="close icon"></i>
                    <div class="header">
                        购买时请添加留言，如下：
                    </div>
                    <ul class="list">
                        <li>如是月付，请填写： 月付-用户id</li>
                        <li>如是季付，请填写： 季付-用户id</li>
                        <li>如是半年付，请填写： 半年付-用户id</li>
                        <li>如是年付，请填写： 年付-用户id</li>
                    </ul>
                </div>
                </p>
            </div>
        </div>
        <div class="actions">
            <div class="ui black deny button">
                再想想
            </div>
            <div class="ui positive right labeled icon button">
                购买完毕
                <i class="checkmark icon"></i>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript">
        $(document).ready(function(){ //scroll to top
            $('.buy_action').click(function () {
                var title = $(this).attr('data-title');
                console.log(title);
                var price = $(this).attr('data-price');
                var qr_url = $(this).attr('data-qr-url');
                $('#title').text(title);
                $('#price').text(price);
                $('#qr_url').attr('src', qr_url);

                $('.ui.modal')
                    .modal({
                        blurring: true
                    })
                    .modal('show')
                ;
            });

        });

    </script>
@endsection