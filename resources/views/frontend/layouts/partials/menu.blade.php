{{--<div class="ui container">--}}
    {{--<div class="ui huge secondary inverted menu">--}}
        <div class="header item">PHPCasts</div>
        @include('frontend.layouts.partials.menu_items')
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
    {{--</div>--}}
{{--</div>--}}