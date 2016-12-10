<div class="ui center aligned segment">
    <div class="ui massive horizontal divided list">
        <div class="item">
            <img class="ui tiny avatar image" src="{{ Auth::user()->avatar }}">
            <div class="content">
                <div class="header">Helen</div>
            </div>
        </div>
    </div>
    <div>
        <div class="ui list">
            <div class="item">第 {{ $user->id }} 位会员</div>
            <div class="item">注册于 {{ $user->created_at->diffForHumans() }}</div>
            <div class="item">活跃于 {{ $user->updated_at->diffForHumans() }}</div>
        </div>
    </div>
    <div class="ui divider"></div>
    <div class="ui small statistics centered">
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