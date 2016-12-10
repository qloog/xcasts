@extends('frontend.layouts.master')

@section('content')
    <div class="ui grid">
        <div class="row"></div>
        <div class="row">
            <div class="thirteen wide column centered">
                <div class="ui grid">
                    <div class="four wide column">
                        @include('frontend.user.setting_nav')
                    </div>
                    <div class="twelve wide column">
                        <!-- detail -->
                        <div class="ui large middle aligned divided relaxed list padded segment" style="margin-top: -18px;">
                            <h2 class="ui header">编辑个人资料</h2>
                            <div class="ui divider"></div>
                            <form class="ui form" method="POST" action="{{ route('user.update', Auth()->id()) }}">
                                <input type="hidden" name="_method" value="PUT">
                                {!! csrf_field() !!}
                                    <div class="field">
                                        <label>昵称</label>
                                        <input type="text" name="name" disabled=disabled value="{{ Auth()->user()->name }}">
                                    </div>
                                    <div class="field">
                                        <label>邮箱</label>
                                        <input type="text" name="email"  disabled=disabled value="{{ Auth()->user()->email }}">
                                    </div>
                                    <div class="field">
                                        <label>真实姓名</label>
                                        <input type="text" name="real_name" value="{{ $user->real_name }}">
                                    </div>
                                    <div class="field">
                                        <label>城市</label>
                                        <input type="text" name="city" value="{{ $user->city }}">
                                    </div>
                                    <div class="field">
                                        <label>公司</label>
                                        <input type="text" name="company" value="{{ $user->company }}">
                                    </div>
                                    <div class="field">
                                        <label>微博地址</label>
                                        <input type="text" name="weibo_url" value="{{ $user->weibo_url }}">
                                    </div>
                                    <div class="field">
                                        <label>个人网站</label>
                                        <input type="text" name="personal_website" value="{{ $user->personal_website }}">
                                    </div>
                                    <div class="field">
                                        <label>个人介绍</label>
                                        <textarea rows="2" name="introduction">{{ $user->introduction }}</textarea>
                                    </div>
                                <button class="ui teal center aligned button" type="submit">保存修改</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row"></div>
    </div>

@endsection