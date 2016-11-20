@extends('frontend.layouts.master')

@section('content')
    <div class="ui stackable grid container">
        <div class="row"></div>
        <div class="row"></div>
        <div class="row">
            <div class="five wide column"></div>
            <div class="six wide column">
                @if (count($errors) > 0)
                    <div class="ui error message container">
                        <i class="close icon"></i>
                        <ul class="list">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form class="ui form ten columns segment " method="POST" action="{{ url('/register') }}">
                    {{ csrf_field() }}

                    <div class="field two column">
                        <label>用户名</label>
                        <input type="text" name="username" value="{{ old('username') }}" placeholder="字母或与数字组合" autofocus>
                    </div>
                    <div class="field">
                        <label>邮箱</label>
                        <input type="text" name="email" value="{{ old('email') }}" placeholder="邮箱地址">
                    </div>
                    <div class="field">
                        <label>密码</label>
                        <input type="password" name="password" value="{{ old('password') }}" placeholder="设置你的登录密码,至少6位">
                    </div>
                    <div class="field">
                        <label>确认密码</label>
                        <input type="password" name="password_confirmation" value="{{ old('password_confirmation') }}" placeholder="请再次输入你的密码">
                    </div>
                    <button class="teal fluid ui button big" type="submit">立 即 注 册</button>
                </form>
            </div>
            <div class="five wide column"></div>
        </div>
        <div class="centered row">
            <h4 class="ui disabled header">已有帐号?</h4>
        </div>
        <div class="centered row">
            <a class="ui green button" href="{{ route('login') }}">马上登录</a>
        </div>
        <div class="row"></div>
    </div>

@endsection
