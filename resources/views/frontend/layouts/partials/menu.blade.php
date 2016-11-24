<div class="ui container">
    <div class="ui large secondary inverted pointing menu">
        <div class="header item">PHPCasts</div>
        <a class="item">
            <div class="ui icon search input">
                <input class="prompt" type="text" placeholder="Laravel">
                <i class="search icon"></i>
            </div>
        </a>
        <a class="item" href="/">
            <i class="home icon"></i> 首页
        </a>
        <a class="item" href="{{ route('course.index') }}">
            <i class="student icon"></i> 课程
        </a>
        <a class="item" href="{{ route('topic.index') }}">
            <i class="talk icon"></i> 社区
        </a>
        <div class="ui right simple dropdown item">
            @if (Auth::guest())
                <a class="ui button" href="{{ url('/login') }}">登录</a>
                <a class="ui teal button" href="{{ url('/register') }}">注册</a>
            @else
                <i class="user icon"></i>{{ Auth::user()->username }}
                <i class="dropdown icon"></i>
                <div class="menu">
                    <a class="item"><i class="user icon"></i> 个人中心</a>
                    <a class="item"><i class="settings icon"></i> 编辑资料</a>
                    <a class="item" href="{{ url('/logout') }}"><i class="sign out icon"></i>退出登录</a>
                </div>
            @endif
        </div>
    </div>
</div>