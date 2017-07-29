@extends('frontend.layouts.master')

@section('title')
    重置密码
@endsection

@section('content')
    <div class="ui container">
        <div class="ui stackable grid container">
            <div class="row"></div>
            <div class="row"></div>
            <div class="row">
                <div class="five wide column"></div>
                <div class="six wide column">
                <form class="ui large form" method="POST" action="{{ url('/password/reset') }}">
            <div class="ui stacked segment">
                {{ csrf_field() }}

                <input type="hidden" name="token" value="{{ $token }}">
                <div class="field">
                    <label>邮箱</label>
                    <input type="text" name="email" placeholder="邮箱地址" value="{{ $email or old('email') }}" required
                           autofocus>
                </div>
                <div class="field">
                    <label>密码</label>
                    <input id="password" type="password" class="form-control" name="password" required>
                </div>
                <div class="field">
                    <label>确认密码</label>
                    <input id="password-confirm" type="password" name="password_confirmation" required>
                </div>
                <button class="ui button" type="submit">重置密码</button>
            </div>
        </form>
                </div>
                <div class="five wide column"></div>
            </div>
            <div class="row"></div>
            <div class="row"></div>
        </div>
    </div>
@endsection
