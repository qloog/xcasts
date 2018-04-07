@extends('frontend.layouts.master')

@section('title', '登录')

@section('content')
    <div class="ui stackable grid container">
        <div class="row"></div>
        <div class="row"></div>
        <div class="row">
            <div class="five wide column"></div>
            <div class="six wide column">

                <form class="ui form segment" method="POST" action="{{ url('/login') }}">
                    {{ csrf_field() }}
                    <div class="field">
                        <label>邮箱</label>
                        <input placeholder="邮箱地址" name="email" type="text" value="{{ old('email') }}">
                    </div>
                    <div class="field">
                        <label>密码</label>
                        <input type="password" name="password" placeholder="密码" >
                    </div>
                    <div class="inline field">
                        <div class="ui checkbox">
                            <input type="checkbox" name="remember" >
                            <label>记住密码</label>
                        </div>
                    </div>
                    <button class="teal fluid ui button big" type="submit">立 即 登 录</button>
                    <div class="inline field">
                        <a class="ui block link list" href="{{ url('/password/reset') }}">忘记密码?</a>
                    </div>
                </form>
            </div>
            <div class="five wide column"></div>
        </div>
        <div class="centered row">
            <h4 class="ui disabled header">没有帐号?</h4>
        </div>
        <div class="centered row">
            <a class="ui green button" href="{{ url('/register') }}">马上注册</a>
        </div>

        @include('frontend.layouts.partials.oauth_login')

        <div class="row"></div>
    </div>
@endsection