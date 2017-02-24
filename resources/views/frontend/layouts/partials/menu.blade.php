<div class="ui container">
    <div class="ui huge secondary inverted menu">
        <div class="header item">PHPCasts</div>
        <a class="item" href="/">
            <i class="home icon"></i> 首页
        </a>
        <a class="item" href="{{ route('series.index') }}">
            <i class="record icon"></i> 视频
        </a>
        <a class="item" href="{{ route('topic.index') }}">
            <i class="talk icon"></i> 社区
        </a>
        <a class="item" href="{{ route('vip') }}">
            <i class="unhide icon"></i> 订阅
        </a>
        <a class="item">
            <div class="ui icon search input">
                <input class="prompt" type="text" placeholder="Laravel">
                <i class="search icon"></i>
            </div>
        </a>
        <div class="right item">
            <a class="ui circular label" style="margin-right: 10px;">
                0
            </a>
        @if (Auth::guest())
            <a class="ui button" href="{{ route('login') }}">登录</a>
            <a class="ui teal button" href="{{ url('register') }}">注册</a>
        @else
            <div class="ui simple dropdown">
            <img class="ui avatar image" src="{{ Auth::user()->avatar }}">{{ Auth::user()->name }}
                <i class="dropdown icon"></i>
                <div class="menu">
                    <a class="item" href="{{ route('user.show', Auth::user()->id) }}"><i class="user icon"></i> 个人中心</a>
                    <a class="item" href="{{ route('user.edit', Auth::user()->id) }}"><i class="settings icon"></i> 编辑资料</a>
                    <a class="item" href="{{ route('user.edit', Auth::user()->id) }}"><i class="unordered list icon"></i> 我的订单</a>
                    <a class="item" href="{{ route('logout') }}"><i class="sign out icon"></i>退出登录</a>
                </div>
            </div>
        @endif
        </div>
    </div>
</div>