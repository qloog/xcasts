@extends('frontend.layouts.master')

@section('content')
    <div class="ui grid">
        <div class="row"></div>
        <div class="row">
            <div class="thirteen wide column centered">
                <div class="ui grid">
                    <div class="four wide column">
                    @include('frontend.user.left_sidebar')
                    </div>
                    <div class="twelve wide column">
                        <!-- detail -->
                        <div class="ui large middle aligned divided relaxed list padded segment" style="margin-top: -18px;">
                            <h2 class="ui header">编辑个人资料</h2>
                            <div class="ui divider"></div>
                            <form class="ui form" method="post" action="{{ route('user.update', Auth()->id()) }}">
                                    <div class="field">
                                        <label>昵称</label>
                                        <input type="text" name="username" disabled=disabled value="{{ Auth()->user()->username }}">
                                    </div>
                                    <div class="field">
                                        <label>邮箱</label>
                                        <input type="text" name="email"  disabled=disabled value="{{ Auth()->user()->email }}">
                                    </div>
                                    <div class="field">
                                        <label>真实姓名</label>
                                        <input type="text" name="realname" value="{{ $user->profile->realname }}">
                                    </div>
                                    <div class="field">
                                        <label>城市</label>
                                        <input type="text" name="city" value="{{ $user->profile->city }}">
                                    </div>
                                    <div class="field">
                                        <label>公司</label>
                                        <input type="text" name="company" value="{{ $user->profile->city }}">
                                    </div>
                                    <div class="field">
                                        <label>微博地址</label>
                                        <input type="text" name="weibo" value="{{ $user->profile->weibo }}">
                                    </div>
                                    <div class="field">
                                        <label>个人网站</label>
                                        <input type="text" name="website" value="{{ $user->profile->website }}">
                                    </div>
                                    <div class="field">
                                        <label>个人介绍</label>
                                        <textarea rows="2" name="introduction">{{ $user->profile->introduction }}</textarea>
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