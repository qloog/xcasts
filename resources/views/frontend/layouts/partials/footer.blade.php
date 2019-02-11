<div class="ui inverted vertical footer segment">
    <div class="ui container">
        <div class="ui computer only stackable inverted grid">
            <div class="five wide column">
                <h4 class="ui inverted header">1024课堂</h4>
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
                    <a href="{{ route('topics.index') }}" class="item">问答社区</a>
                    <a href="{{ route('post.index') }}" class="item">文章</a>
                    <a href="https://weibo.com/phpcasts" target="_blank" class="item">微博</a>
                    <a href="{{ route('feedback.create') }}" class="item">留言反馈</a>
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
                <h4 class="ui inverted small header">微信订阅号</h4>
                <img class="ui image" src="{{ cdn('/wechat_qrcode.jpg') }}">
                <div class="ui inverted list">
                    <a href="javascript:void(0);" class="item">QQ群: 737994259</a>
                </div>
            </div>
        </div>

        <div class="ui divider inverted"></div>

        <div class="ui inverted right floated horizontal list">
            <div class="disabled item" href="#"></div>
        </div>
        <div class="ui inverted horizontal list">
            <a class="disabled item">Powered By</a><a class="item" href="https://laravel.com">Laravel</a>
            <div class="item"><a href="{{ url('/terms') }}">服务条款</a></div>
            <div class="disabled item">© 1024课堂 2019. All rights reserved.</div>
            <div class="disabled item">京ICP备16064137号</div>
        </div>

        {{--<a class="back-to-top" href="javascript:;"></a>--}}
    </div>
</div>