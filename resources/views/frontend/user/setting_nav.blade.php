<div class="ui center aligned segment">
    <div class="ui divided very relaxed large middle aligned selection list">
        <a class="item" href="{{ route('user.edit', Auth::id()) }}"><i class="black user icon"></i>  个人信息</a>
        <a class="item" href="{{ route('user.avatar.edit', Auth::id()) }}"><i class="black image icon"></i>  修改头像</a>
        {{--<a class="item" href="{{ route('user.notification', Auth::id()) }}"><i class="black alarm icon"></i>  消息通知</a>--}}
        {{--<a class="item" href="{{ route('user.bind', Auth::id()) }}"><i class="black add user icon"></i>  帐号绑定</a>--}}
    </div>
</div>