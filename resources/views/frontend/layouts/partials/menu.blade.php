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
        <a class="item" href="javascript:;">
            <i class="talk icon"></i> 问答
        </a>
        <a class="item" href="javascript:;">
            <i class="write icon"></i> 文章
        </a>
        <div class="ui right simple dropdown item">
            @if (Auth::guest())
                <a class="ui button" href="{{ url('/login') }}">登录</a>
                <a class="ui teal button" href="{{ url('/register') }}">注册</a>
            @else
                <i class="user icon"></i>{{ Auth::user()->username }}
                <i class="dropdown icon"></i>
                <div class="menu">
                    <a class="item"><i class="edit icon"></i> Edit Profile</a>
                    <a class="item"><i class="globe icon"></i> Choose Language</a>
                    <a class="item"><i class="settings icon"></i> Account Settings</a>
                    <a class="item" href="{{ url('/logout') }}"><i class="settings icon"></i>退出登录</a>
                </div>
            @endif
        </div>
    </div>
</div>