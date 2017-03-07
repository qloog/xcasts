<div class="ui inverted vertical footer segment">
    <div class="ui container">
        <div class="ui computer only stackable inverted grid">
            <div class="five wide column">
                <h4 class="ui inverted header">PHPCasts</h4>
                <p></p>
            </div>
            <div class="three wide column">
                <h4 class="ui inverted small header">产品与服务</h4>
                <div class="ui inverted list">
                    <a href="{{ url('vip') }}" class="item">VIP会员</a>
                    <a href="{{ url('path') }}" class="item">学习路线</a>
                    <a href="{{ url('one-to-one') }}" class="item">一对一</a>
                </div>
            </div>
            <div class="three wide column">
                <h4 class="ui inverted small header">支持</h4>
                <div class="ui inverted list">
                    <a href="{{ route('topic.index') }}" class="item">问答社区</a>
                    <a href="{{ url('blog') }}" class="item">技术博客</a>
                    <a href="http://laravel.com" target="_blank" class="item">Laravel官网</a>
                </div>
            </div>
            <div class="three wide column">
                <h4 class="ui inverted small header">关于本站</h4>
                <div class="ui inverted list">
                    <a href="{{ url('link') }}" class="item">友情链接</a>
                    <a href="{{ url('copyright') }}" class="item">社区规则</a>
                    <a href="{{ url('copyright') }}" class="item">版权声明</a>
                    {{--<a href="#" class="item">合作</a>--}}
                </div>
            </div>
            <div class="two wide column">
                <h4 class="ui inverted small header">服务提供商</h4>
                <img class="ui image" src="https://oj1ylm48b.qnssl.com/qiniu-white-195x105.png?e=1488901273&token=qvuNOgNkZMAJXYEPSHBT-6JEigk2AechM_fm57zS:YpYLdIknyqaL75clcpzgD5R9LWU">
            </div>
        </div>

        <div class="ui divider inverted"></div>

        <div class="ui inverted right floated horizontal list">
            <div class="disabled item" href="#">运行于 Aliyun 的 ECS 云主机上.</div>
        </div>
        <div class="ui inverted horizontal list">
            <a class="disabled item">Powered By</a><a class="item" href="https://laravel.com">Laravel</a>
            <div class="item"><a href="{{ url('/terms') }}">服务条款</a></div>
            <div class="disabled item">© PHPCasts 2017. All rights reserved.</div>
        </div>

        <a class="back-to-top" href="javascript:;"></a>
    </div>
</div>