<a class="item" href="/">
    <i class="home icon"></i> 首页
</a>
<a class="item @if(Request::is('courses*')) active @endif" href="{{ route('courses.index') }}">
    <i class="student icon"></i> 课程
</a>
<a class="item @if(Request::is('topics*')) active @endif" href="{{ route('topics.index') }}">
    <i class="talk icon"></i> 社区
</a>
<a class="item @if(Request::is('posts*')) active @endif" href="{{ route('blog.index') }}">
    <i class="content icon"></i> 文章
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