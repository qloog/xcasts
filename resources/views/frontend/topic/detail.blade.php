@extends('frontend.layouts.master')

@section('title')
    {{ $topic->title }} - 社区
@endsection

@section('styles')
    <link href="{{ asset('css/github-markdown.css') }}" rel="stylesheet">
    <style type="text/css">
        .ui.comments { max-width: 100%!important}
    </style>
@endsection

@section('content')
    <div class="ui container">
        <div class="ui hidden divider"></div>
        <div class="ui grid">
            <div class="twelve wide column">
                <!-- detail -->
                <div class="ui secondary segment">
                    <h2>{{ $topic->title }}</h2>
                    <p><a href="#"> 分类</a>
                        ⋅  <a href="{{ route('user.show', $topic->user_id) }}">{{ $topic->user->name }}</a>
                        ⋅ 于 {{ $topic->created_at->diffForHumans() }}
                        ⋅ 最后回复由 <a href="{{ route('user.show', $topic->last_reply_user_id) }}">{{ $topic->lastReplyUser->name }}</a> 于 {{ $topic->updated_at->diffForHumans() }}
                        ⋅ {{ $topic->view_count }} 阅读
                    </p>
                </div>
                <div class="ui large middle aligned divided relaxed list padded segment" style="margin-top: -18px;">
                    <div class="markdown-body">
                        {!! $topic->body !!}
                    </div>
                </div>

                <!-- votes -->
                <div class="ui large center aligned divided relaxed list padded segment">
                    <div class="ui buttons">
                        <button class="ui teal button" data-inverted=""
                                data-tooltip="点赞相当于收藏，可以在个人页面的「赞过的话题」导航里查看"
                                data-position="top center" id="up_vote">
                            <i class="thumbs up white icon"></i>点赞
                        </button>
                        {{--<div class="or"></div>--}}
                        {{--<button class="ui yellow button" data-inverted=""--}}
                                {{--data-tooltip="如果觉得我的文章对您有用，请随意打赏。你的支持将鼓励我继续创作！可以修改个人资料「支付二维码」开启打赏功能。"--}}
                                {{--data-position="top center"--}}
                                {{--id="reward"--}}
                        {{-->--}}
                            {{--<i class="heart white icon"></i>打赏--}}
                        {{--</button>--}}
                    </div>
                    <p></p>
                    <div id="voted_user_list">
                        @foreach($votedUsers as $user)
                        <a href="{{ route('user.show', $user['id']) }}" data-uid="{{ $user['id'] }}">
                            <img class="ui avatar image" src="{{ $user['avatar'] ? cdn($user['avatar']) : '/avatars/default.png' }}" style="width: 40px;height: 40px;"/>
                        </a>
                        @endforeach
                    </div>
                </div>

                <!-- comments -->
                <div class="ui large middle aligned divided relaxed list padded segment">
                    <h3 class="ui dividing header">回复数量: {{ $topic->reply_count }}</h3>

                    <div class="ui comments">
                        @foreach($replies as $key => $reply)
                        <div class="comment">
                            <a class="avatar">
                                <img src="{{ cdn($reply->user->avatar) }}">
                            </a>
                            <div class="content">
                                <a class="author" href="{{ route('user.show', $reply->user->id) }}#{{$key+1}}">{{ $reply->user->name }}</a>
                                <div class="metadata">
                                    <div class="date">
                                        <a href="{{ route('topics.show', $topic->id) }}#reply{{ $reply->id }}" id="reply{{ $reply->id }}"> #{{ $key + 1 }}</a>
                                    </div>
                                    <div class="date">
                                        {{ $reply->created_at->diffForHumans() }}
                                    </div>
                                </div>
                                <div class="text markdown-body">
                                    {!! $reply->body !!}
                                </div>
                                <div class="actions">
                                    <a class="reply" href="javascript:void(0)" onclick="reply_vote({{ $reply->id }})">
                                        <i class="thumbs outline up icon"></i>赞(<span id="vote_count_{{ $reply->id }}">{{ $reply->vote_count }}</span>)
                                    </a>
                                    <a class="reply" href="javascript:void(0)" onclick="reply('{{ $reply->user->name }}')"><i class="reply icon"></i>回复</a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="ui large middle aligned divided relaxed list">
                    <form class="ui reply form" method="post" action="{{ route('reply.store') }}">
                        {!! csrf_field() !!}
                        <input type="hidden" name="topic_id" value="{{ $topic->id }}">
                        <div class="@if(!Auth::check()) disabled field @endif">
                            <textarea name="body" id="reply_content" placeholder="@if(Auth::check()) 请使用Markdown语法编写 :) @else 需要登录后才能发表评论. @endif" required></textarea>
                        </div>
                        <button class="ui teal submit labeled icon button @if(!Auth::check()) disabled field @endif" type="submit">
                            <i class="icon edit"></i> 回复
                        </button>
                    </form>
                </div>
            </div>
            <div class="four wide column">
                <div class="ui card">
                    <div class="ui large circular image">
                        <img src="{{ cdn($topic->user->avatar) }}">
                    </div>
                    <div class="content">
                        <div class="header">{{ $topic->user->name }}</div>
                        <div class="meta">
                            <a class="group">{{ $topic->user->introduction }}</a>
                        </div>
                    </div>
                    <div class="extra content">
                        <a class="right floated created">
                            {{ $topic->user->created_at->diffForHumans() }}加入
                        </a>
                        <a class="friends">
                            <i class="user icon"></i>
                            {{ $topic->user->follower_count }} 粉丝
                        </a>
                    </div>
                    @if(Auth::check())
                        @if($topic->user->isFollowedBy(Auth::id()))
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
            </div>
        </div>
        <div class="ui hidden divider"></div>
    </div>

    <div class="ui standard test modal" id="user_qrcode_modal">
        <div class="header">
            Select a Photo
        </div>
        <div class="image content">
            <div class="ui medium image">
                <img src="http://semantic-ui.com/images/avatar2/large/rachel.png">
            </div>
            <div class="description">
                <div class="ui header">Default Profile Image</div>
                <p>We've found the following <a href="https://www.gravatar.com" target="_blank">gravatar</a> image associated with your e-mail address.</p>
                <p>Is it okay to use this photo?</p>
            </div>
        </div>
        <div class="actions">
            <div class="ui black deny button">
                Nope
            </div>
            <div class="ui positive right labeled icon button">
                Yep, that's me
                <i class="checkmark icon"></i>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script type="text/javascript">
        // 回复用户
        function reply(username) {
            var replyContent = $('#reply_content');
            var oldContent = replyContent.val();
            var lastAtUser = "@" + username + " ";
            var newContent = '';
            if (oldContent.length > 0) {
                if (oldContent != lastAtUser) {
                    newContent = oldContent + "\n" + lastAtUser;
                }
            } else {
                newContent = lastAtUser;
            }

            replyContent.focus();
            replyContent.val(newContent);
        }

        // 回复投票
        function reply_vote(reply_id) {
            console.log(reply_id);
            $.ajax({
                type: 'POST',
                url: '/reply/' + reply_id + '/vote',
                data: {'_token': '{{ csrf_token() }}','_method':'post'},
                dataType:'json',
                success: function (ret) {
                    console.log(ret);
                    if (ret.code == 200 ) {
                        $('#vote_count_' + reply_id).text(ret.count);
                    }
                }
            });
        }

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
                    url: '{{ route('user.follow', $topic->user->id) }}',
                    data: {'_token': '{{ csrf_token() }}','_method':'post'},
                    dataType:'json',
                    success: function (ret) {
                        if (ret.code == 200 ) {
                            window.location.reload();
                        }
                    }
                });
            });

            // 点赞
            $('#up_vote').click(function () {
                // check if user is logined
                var user_id = '{{ Auth::id() }}';
                if (!user_id) {
                    // swal 提示
                    swal({
                        title: "请确认登录",
                        //text: "You will not be able to recover this imaginary file!",
                        type: "warning",
                        showCancelButton: true,
                        cancelButtonText: "取消",
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "去登录",
                        closeOnConfirm: false
                    },
                    function(){
                        window.location.href = '{{ route('login') }}';
                    });

                    return false;
                }
                $.ajax({
                    type: 'POST',
                    url: '{{ route('topics.upvote', $topic->id) }}',
                    data: {'_token': '{{ csrf_token() }}','_method':'post'},
                    dataType:'json',
                    success: function (ret) {
                        if (ret.code == 200 ) {
                            window.location.reload();
                            {{--@if(Auth::check())--}}
                            {{--var str = '<a href="{{ route('user.show', Auth::id()) }}" data-uid="{{ Auth::id() }}">';--}}
                                {{--str += '<img class="ui avatar image" src="{{ Auth::user()->avatar ? cdn(Auth::user()->avatar) : '/avatars/default.png'}}" style="width: 40px;height: 40px;"/>';--}}
                                {{--str += '</a>';--}}
                            {{--@endif--}}

                            {{--var voted_a_obj = $('#voted_user_list a');--}}
                            {{--var voted_user_count = voted_a_obj.length;--}}
                            {{--if (voted_user_count == 0) {--}}
                                {{--$('#voted_user_list').append(str);--}}
                                {{--return false;--}}
                            {{--}--}}
                            {{--voted_a_obj.map(function (key,value) {--}}
                                {{--console.log(value.getAttribute('data-uid'));--}}
                                {{--if (value.getAttribute('data-uid') == '{{ Auth::id() }}') {--}}
                                    {{--//todo: 如何移除对象里对应的item[js里如何动态删除和添加list]--}}
                                    {{--$(this).remove(voted_a_obj[key]);--}}
                                {{--} else {--}}
                                    {{--if (key == 0) {--}}
                                        {{--value.before(str);--}}
                                    {{--}--}}
                                {{--}--}}
                            {{--});--}}
                        }
                    }
                });
            });
        });
    </script>
@endsection