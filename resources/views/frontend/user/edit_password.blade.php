@extends('frontend.layouts.master')

@section('title')
    修改密码
@endsection

@section('content')
    <div class="ui container">
        <div class="ui hidden divider"></div>
        <div class="ui grid">
            <div class="four wide column">
                @include('frontend.user.setting_nav')
            </div>
            <div class="twelve wide column">
                <!-- detail -->
                <div class="ui large middle aligned divided relaxed list padded segment" style="margin-top: -18px;">
                    <h2 class="ui header"><i class="ui lock"></i>修改密码</h2>
                    <div class="ui divider"></div>
                    <form class="ui form" method="POST" action="{{ route('user.update_password', Auth()->id()) }}">
                        <input type="hidden" name="_method" value="PUT">
                        {!! csrf_field() !!}
                        <div class="field">
                            <label for="email">邮箱</label>
                            <input type="text" name="email" id="email" disabled=disabled value="{{ Auth()->user()->email }}">
                        </div>
                        <div class="field">
                            <label>密码</label>
                            <input type="password" name="password" value="">
                        </div>
                        <div class="field">
                            <label>确认密码</label>
                            <input type="password" name="password_confirmation" value="">
                        </div>
                        <button class="ui teal center aligned button" type="submit">保存修改</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="ui hidden divider"></div>
    </div>

@endsection