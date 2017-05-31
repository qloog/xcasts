<div class="ui container">
    <div class="ui huge secondary inverted menu">
        <div class="header item">PHPCasts</div>
        <a class="item" href="/">
            <i class="home icon"></i> 首页
        </a>
        <a class="item @if(Request::is('course*')) active @endif" href="{{ route('course.index') }}">
            <i class="student icon"></i> 课程
        </a>
        <a class="item @if(Request::is('topic*')) active @endif" href="{{ route('topic.index') }}">
            <i class="talk icon"></i> 社区
        </a>
        <a class="item @if(Request::is('blog*')) active @endif" href="{{ route('blog.index') }}">
        <i class="content icon"></i> 博客
        </a>
        <a class="item @if(Request::is('vip')) active @endif" href="{{ route('vip') }}">
            <i class="unhide icon"></i> 订阅
        </a>
        {{--<a class="item">--}}
            {{--<div class="ui icon search input">--}}
                {{--<input class="prompt" type="text" placeholder="Laravel">--}}
                {{--<i class="search icon"></i>--}}
            {{--</div>--}}
        {{--</a>--}}
        <div class="right item">
            @if(!Auth::guest())
                @if(Auth::user()->notification_count)
                    <a class="ui circular ui orange label" style="margin-right: 10px;" href="{{ route('notifications.index') }}">
                        {{ Auth::user()->notification_count }}
                    </a>
                @else
                    <a class="ui circular ui label" style="margin-right: 10px;" href="{{ route('notifications.index') }}">
                        0
                    </a>
                @endif
            @endif
        @if (Auth::guest())
            <a class="ui button" href="{{ route('login') }}">登录</a>
            <a class="ui teal button" href="{{ url('register') }}">注册</a>
        @else
            <div class="ui simple dropdown">
            <img class="ui avatar image" src="{{ Auth::user()->avatar ? cdn(Auth::user()->avatar) : '/avatars/default.png' }}">{{ Auth::user()->name }}
                <i class="dropdown icon"></i>
                <div class="menu">
                    <a class="item" href="{{ route('user.show', Auth::user()->id) }}"><i class="user icon"></i> 个人中心</a>
                    <a class="item" href="{{ route('user.edit', Auth::user()->id) }}"><i class="settings icon"></i> 编辑资料</a>
{{--                    <a class="item" href="{{ route('user.edit', Auth::user()->id) }}"><i class="unordered list icon"></i> 我的订单</a>--}}
                    <a class="item" href="{{ route('logout') }}"><i class="sign out icon"></i>退出登录</a>
                </div>
            </div>
        @endif
        </div>
    </div>
</div>