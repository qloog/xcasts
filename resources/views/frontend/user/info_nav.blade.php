<div class="ui center aligned segment">
    <div class="ui divided very relaxed large list">
        <a class="item" href="{{ route('user.topics', $user->id) }}"><i class="write icon"></i> 发布的话题</a>
        <a class="item" href="{{ route('user.replies', $user->id) }}"><i class="comment icon"></i> 发表的回复</a>
        <a class="item" href="{{ route('user.following', $user->id) }}"><i class="unhide icon"></i> 关注的用户</a>
        <a class="item" href="{{ route('user.votes', $user->id) }}"><i class="thumbs up icon"></i> 赞过的话题</a>
    </div>
</div>