<div class="ui center aligned segment">
    <h2 class="ui header">
        <img src="{{ Auth::user()->avatar }}" class="ui circular image">
        {{ Auth::user()->name }}
    </h2>
    <div>
        <div class="ui list">
            <div class="item">第 {{ $user->id }} 位会员</div>
            <div class="item">注册于 {{ $user->created_at->diffForHumans() }}</div>
            <div class="item">活跃于 {{ $user->updated_at->diffForHumans() }}</div>
        </div>
    </div>
    <div class="ui divider"></div>
    <div class="ui three small statistics">
        <div class="teal statistic">
            <a class="value" href="#">
                {{ $user->follower_count }}
            </a>
            <div class="label">
                关注者
            </div>
        </div>
        <div class="teal statistic">
            <a class="value" href="#">
                {{ $user->reply_count }}
            </a>
            <div class="label">
                评论
            </div>
        </div>
        <div class="teal statistic">
            <a class="value" href="#">
                {{ $user->topic_count }}
            </a>
            <div class="label">
                话题
            </div>
        </div>
    </div>
    <div class="ui divider"></div>
    <a class="ui fluid teal button" href="{{ route('user.edit', Auth()->id()) }}"><i class="edit icon"></i> 编辑个人资料 </a>
</div>