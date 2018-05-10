<div class="ui center aligned segment">
    <h2 class="ui small sequenced images">
        <img src="{{ get_avatar_url($user) }}" class="ui medium circular avatar image">
        {{ $user->name }}
    </h2>
    <div class="ui vertical text menu">
        <div class="item">第 {{ $user->id }} 位会员</div>
        <div class="item">注册于 {{ $user->created_at->diffForHumans() }}</div>
        <div class="item">活跃于 {{ $user->updated_at->diffForHumans() }}</div>
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
    @if(Auth()->id())
    <a class="ui fluid teal button" href="{{ route('user.edit', Auth()->id()) }}"><i class="edit icon"></i> 编辑个人资料 </a>
    @endif
</div>