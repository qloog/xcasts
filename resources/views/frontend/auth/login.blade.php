@extends('frontend.layouts.master')

@section('content')

    <div class="ui container">
        <div class="ui stackable grid">
            <div class="row"></div>
            <div class="ui two wide column"></div>
            <div class="ui five wide column">
                <form class="ui form" method="POST" action="{{ url('/login') }}">
                    <p><h1>登录</h1></p>
                    {{ csrf_field() }}
                    <div class="field">
                        <label>用户名</label>
                        <input placeholder="用户名" name="email" type="text" value="{{ old('email') }}">
                    </div>
                    <div class="field">
                        <label>密码</label>
                        <input type="password" name="password" placeholder="密码" >
                    </div>
                    <div class="inline field">
                        <div class="ui checkbox">
                            <input type="checkbox" name="remember">
                            <label>Remember Me</label>
                        </div>
                    </div>
                    <button class="ui primary submit button" type="submit">登录</button>
                    <span><a href="{{ url('/password/reset') }}">忘记密码?</a> </span>
                </form>
            </div>
            <div class="ui seven wide column"></div>
            <div class="ui two wide column"></div>
            <div class="row"></div>
        </div>

    </div>
@endsection
