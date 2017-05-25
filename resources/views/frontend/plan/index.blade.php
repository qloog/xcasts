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
                    <button class="ui button fluid teal">现在购买</button>
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
                    <button class="ui button fluid teal">现在购买</button>
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
                    <button class="ui button fluid teal">现在购买</button>
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
                    <button class="ui button fluid teal">现在购买</button>
                </div>
            </div>
        </div>
    </div>

    <div class="ui grid">
        <div class="row"></div>
        <div class="row"></div>
    </div>
@endsection