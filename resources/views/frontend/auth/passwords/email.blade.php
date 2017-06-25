@extends('frontend.layouts.master')

@section('title')
    重置密码
@endsection

<!-- Main Content -->
@section('content')
    <div class="ui stackable grid container">
        <div class="row"></div>
        <div class="row"></div>
        <div class="row">
            <div class="five wide column"></div>
            <div class="six wide column">
                @if (session('status'))
                    <div class="ui success message transition container">
                        <i class="close icon"></i>
                        <div class="header">{{ session('status') }} </div>
                        {{--<p>That offer has expired </p>--}}
                    </div>
                @endif

                <form class="ui form segment" method="POST" action="{{ url('/password/email') }}">
                    <h3 class="ui centered header">发送重置密码链接</h3>
                    {{ csrf_field() }}
                    <div class="field">
                        <label></label>
                        <input type="text" name="email" placeholder="邮箱地址" value="{{ $email or old('email') }}" required autofocus>
                    </div>
                    <button class="teal fluid ui button big" type="submit">发送</button>
                </form>
            </div>
            <div class="five wide column"></div>
        </div>
        <div class="row"></div>
        <div class="row"></div>
    </div>
@endsection