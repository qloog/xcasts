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
            <a class="value" href="{{ route('user.followers', ['id' => $user->id]) }}">
                {{ $user->follower_count }}
            </a>
            <div class="label">
                关注者
            </div>
        </div>
        <div class="teal statistic">
            <a class="value" href="{{ route('user.replies', $user->id) }}">
                {{ $user->reply_count }}
            </a>
            <div class="label">
                评论
            </div>
        </div>
        <div class="teal statistic">
            <a class="value" href="{{ route('user.topics', $user->id) }}">
                {{ $user->topic_count }}
            </a>
            <div class="label">
                话题
            </div>
        </div>
    </div>
    <div class="ui divider"></div>
    @if(Auth::id() == request('id'))
        <a class="ui fluid teal button" href="{{ route('user.edit', Auth()->id()) }}"><i class="edit icon"></i> 编辑个人资料 </a>
    @elseif (Auth::check())
        @if($user->isFollowedBy(Auth::id()))
            <div class="ui bottom attached button" id="follow_user">
                <i class="minus icon"></i>
                取消关注
            </div>
        @else
            <div class="ui bottom attached orange button" id="follow_user">
                <i class="add icon"></i>
                关注
            </div>
        @endif
    @endif
</div>

@section('scripts')
    <script type="text/javascript">

        $(document).ready(function () {
            $('.ui.dropdown').dropdown();

            $('.button').popup();

            // display user qrcode
            $('#reward').click(function () {
                $('#user_qrcode_modal')
                    .modal({
                        blurring: true
                    })
                    .modal('show');
            });

            // 关注用户
            $('#follow_user').click(function () {
                $.ajax({
                    type: 'POST',
                    url: '{{ route('user.follow', $user->id) }}',
                    data: {'_token': '{{ csrf_token() }}','_method':'post'},
                    dataType:'json',
                    success: function (ret) {
                        if (ret.code == 200 ) {
                            window.location.reload();
                        }
                    }
                });
            });
        });
    </script>
@endsection