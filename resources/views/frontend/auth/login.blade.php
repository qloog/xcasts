@extends('frontend.layouts.master')

@section('content')
    <div class="ui two column middle aligned very relaxed stackable grid container teal segment">
        <div class="column">
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

            <form class="ui form" method="POST" action="{{ url('/login') }}">
                <p><h1>登录</h1></p>
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
                        <input type="checkbox" name="remember">
                        <label>Remember Me</label>
                    </div>
                </div>
                <button class="ui primary submit button" type="submit">登录</button>
                <span><a href="{{ url('/password/reset') }}">忘记密码?</a></span>
            </form>
        </div>
        {{--<div class="ui vertical divider">Or </div>--}}
        <div class="center aligned column">
            <div class="ui big green labeled icon button"><i class="signup icon"></i> Sign Up </div>
        </div>
    </div>
@endsection