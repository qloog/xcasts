@extends('frontend.layouts.master')

@section('styles')
    <link href="{{ asset('css/github-markdown.css') }}" rel="stylesheet">
    <style type="text/css">
        .ui.comments { max-width: 100%!important}
    </style>
@stop

@section('content')
    <div class="ui grid">
        <div class="row"></div>
        <div class="row">
            <div class="thirteen wide column centered">
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
                                <div class="or"></div>
                                <button class="ui yellow button" data-inverted=""
                                        data-tooltip="如果觉得我的文章对您有用，请随意打赏。你的支持将鼓励我继续创作！可以修改个人资料「支付二维码」开启打赏功能。"
                                        data-position="top center">
                                    <i class="heart white icon"></i>打赏
                                </button>
                            </div>

                            <p></p>
                            <div id="voted_user_list">
                                @foreach($votedUsers as $user)
                                <a href="{{ route('user.show', $user['id']) }}" data-uid="{{ Auth::check() ? Auth::id() : 0 }}">
                                    <img class="ui avatar image" src="{{ $user['avatar'] }}" style="width: 40px;height: 40px;"/>
                                </a>
                                @endforeach
                            </div>
                        </div>

                        <!-- comments -->
                        <div class="ui large middle aligned divided relaxed list padded segment">
                            <h3 class="ui dividing header">回复数量: {{ $topic->reply_count }}</h3>

                            <div class="ui comments">
                                @foreach($replies as $reply)
                                <div class="comment">
                                    <a class="avatar">
                                        <img src="http://semantic-ui.com/images/avatar/small/matt.jpg">
                                    </a>
                                    <div class="content">
                                        <a class="author" href="{{ route('user.show', $reply->user->id) }}">{{ $reply->user->name }}</a>
                                        <div class="metadata">
                                            <div class="date">
                                                {{ $reply->created_at->diffForHumans() }}
                                            </div>
                                        </div>
                                        <div class="text markdown-body">
                                            {!! $reply->body !!}
                                        </div>
                                        <div class="actions">
                                            <a class="reply"><i class="thumbs outline up icon"></i></a>
                                            <a class="reply"><i class="reply icon"></i></a>
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
                                    <textarea name="body" placeholder="@if(Auth::check()) 请使用Markdown语法编写 :) @else 需要登录后才能发表评论. @endif" required></textarea>
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
                                <img src="{{ $topic->user->avatar }}">
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
            </div>
        </div>
        <div class="row"></div>
    </div>

@endsection

@section('scripts')
    <script type="text/javascript">
        $(document).ready(function () {
            $('.ui.dropdown').dropdown();

            $('.button').popup();

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

            $('#up_vote').click(function () {
                $.ajax({
                    type: 'POST',
                    url: '{{ route('topic.upvote', $topic->id) }}',
                    data: {'_token': '{{ csrf_token() }}','_method':'post'},
                    dataType:'json',
                    success: function (ret) {
                        if (ret.code == 200 ) {

                            @if(Auth::check())
                            var str = '<a href="{{ route('user.show', Auth::id()) }}" data-uid="{{ Auth::id() }}"> \
                                    <img class="ui avatar image" src="{{ Auth::user()->avatar }}" style="width: 40px;height: 40px;"/> \
                                    </a>';
                            @endif

                            var voted_a_obj = $('#voted_user_list a');
                            var voted_user_count = voted_a_obj.length;
                            if (voted_user_count == 0) {
                                $('#voted_user_list').append(str);
                                return false;
                            }
                            voted_a_obj.map(function (key,value) {
                                console.log(value.getAttribute('data-uid'));
                                if (value.getAttribute('data-uid') == '{{ Auth::id() }}') {
                                    $(this).remove(key);
                                } else {
                                    if (key == 0) {
                                        value.before(str);
                                    }
                                }
                            });
                        }
                    }
                });
            });

        });
    </script>
@endsection