@extends('frontend.layouts.master')

@section('title')
    {{ $video->name }} - {{ $course->name }} - 视频
@endsection

@section('description', $video->description)

@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/social-share.js/1.0.16/css/share.min.css">
    <link href="{{ asset('css/github-markdown.css') }}" rel="stylesheet">
    <style type="text/css">
        /* Hidden by default, selectively shown.
            At this point this is how a skin designer would show them. */
        .video-js .vjs-current-time { display: block; }
        .video-js .vjs-time-divider { display: block; }
        .video-js .vjs-duration { display: block; }

        .ui.comments { max-width: 72.5%!important}
    </style>
@endsection

@section('content')
    <div class="ui grid" style="background-color: #E9EAED">
        <div class="row"></div>
        <div class="row" style="margin-bottom: 10px;">
            <div class="one wide column"></div>
            <div class="ten wide column">
                @if(Auth()->guest())
                    <div class="ui centered text">
                        <div style="text-align: center; background: url(/images/hello-world.png) 50% 70% no-repeat #080808;padding: 22% 0;">
                            <h3 style="color: #fff;">&nbsp;&nbsp;&nbsp;&nbsp;观看视频需要登录</h3>
                            <ul class="ui list">
                                <li><a href="{{ url('/register') }}" class="ui teal button">马上加入 1024课堂</a></li>
                                <li style="margin-top:20px"><a href="{{ url('/login') }}">有账号?马上登录</a></li>
                            </ul>
                        </div>
                    </div>
                @else
                    @if ($video->is_free == 1)
                        <video id="phpcasts-video" class="video-js vjs-fluid vjs-big-play-centered placeholder"
                               poster="{{ cdn($video->cover_image) }}" data-setup='{}'>
                            <source src="{{ cdn($video->mp4_url) }}" type='video/mp4'>
                            <source src="" type="video/flv" data-quality="HD" label="HD" data-default="true">
                            <p class="vjs-no-js">
                                To view this video please enable JavaScript, and consider upgrading to a web browser that
                                <a href="http://videojs.com/html5-video-support/" target="_blank">supports HTML5 video</a>
                            </p>
                        </video>
                    @else
                        @if(Auth()->user()->isMember)
                            <video id="phpcasts-video" class="video-js vjs-fluid vjs-big-play-centered placeholder"
                                   poster="{{ cdn($video->cover_image) }}" data-setup='{}'>
                                <source src="{{ cdn($video->mp4_url) }}" type='video/mp4'>
                                <source src="" type="video/flv" data-quality="HD" label="HD" data-default="true">
                                <p class="vjs-no-js">
                                    To view this video please enable JavaScript, and consider upgrading to a web browser that
                                    <a href="http://videojs.com/html5-video-support/" target="_blank">supports HTML5 video</a>
                                </p>
                            </video>
                        @else
                            <div class="ui centered text">
                                <div style="text-align: center; background: url(/images/hello-world.png) 50% 70% no-repeat #080808;padding: 22% 0;">
                                    <h3 style="color: #fff;">&nbsp;&nbsp;&nbsp;&nbsp;订阅后可以观看全部视频</h3>
                                    <ul class="ui list">
                                        <li><a href="{{ url('/vip') }}" class="ui teal button">马上加入 订阅</a></li>
                                    </ul>
                                </div>
                            </div>
                        @endif
                    @endif
                @endif
                <div class="ui fluid card" style="margin-top: 0px;">
                    <div class="content">
                        <div class="ui header">
                            <div class="ui breadcrumb">
                                <a class="section" href="{{ route('courses.show', ['slug' => $course->slug]) }}">{{ $video->course->name }}</a>
                                <i class="right arrow icon divider"></i>
                                <div class="active section">{{ $video->name }}</div>
                            </div>
                            @if ($nextLink)
                                <a class="ui right floated green basic button" href="{{ $nextLink }}">下一节<i class="arrow right icon"></i></a>
                            @endif
                            @if ($preLink)
                                <a class="ui right floated green basic button" href="{{ $preLink }}"><i class="arrow left icon"></i>上一节</a>
                            @endif
                        </div>
                        <div class="meta">发布于: {{ $video->created_at }}</div>
                        <div class="description">
                            {{ $video->description }}
                        </div>
                        <div class="extra content" style="margin-top: 10px;">

                        </div>
                    </div>

                    <!--social share bar-->
                    <div class="social-share"></div>
                </div>

                <!-- comment -->
                <div class="ui segment">
                    <div class="ui comments">
                        <h3 class="ui dividing header">发表评论</h3>
                        <form class="ui reply form" method="post" action="{{ route('comment.store') }}">
                            {!! csrf_field() !!}
                            <input type="hidden" name="type" value="video">
                            <input type="hidden" name="relation_id" value="{{ $video->id }}" >
                            <input type="hidden" name="slug" value="{{ $course->slug }}" >
                            <input type="hidden" name="episode_id" value="{{ $video->episode_id }}" >
                            <div class="@if(!Auth::check()) disabled field @else field @endif">
                                <textarea name="content" id="reply_content" placeholder="@if(Auth::check()) 请使用Markdown语法编写 :) @else 需要登录后才能发表评论. @endif" required></textarea>
                            </div>
                            <button class="ui primary submit labeled icon button @if(!Auth::check()) disabled field @endif" type="submit"><i class="icon edit"></i>回复</button>
                        </form>

                        <h3 class="ui dividing header">评论列表({{ count($comments) }} 条)</h3>
                        @foreach($comments as $comment)
                            <div class="comment">
                                <a class="avatar">
                                    <img src="{{ get_avatar_url($comment->user) }}">
                                </a>
                                <div class="content">
                                    <a class="author">{{ $comment->user->name }}</a>
                                    <div class="metadata">
                                        <div class="date">{{ $comment->created_at->diffForHumans() }}</div>
                                    </div>
                                    <div class="text markdown-body">
                                        <p>{!! $comment->content !!}</p>
                                    </div>
                                    <div class="actions">
                                        <a class="reply" href="javascript:void(0)" onclick="reply_vote({{ $comment->id }})">
                                            <i class="thumbs outline up icon"></i>赞(<span id="vote_count_{{ $comment->id }}">{{ $comment->vote_count }}</span>)
                                        </a>
                                        <a class="reply" href="javascript:void(0)" onclick="reply('{{ $comment->user->name }}')">
                                            <i class="reply icon"></i>回复
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

            </div>

            <div class="four wide column">
                <div class="ui segment">
                    <h3 class="header"><i class="list ul icon"></i>播放列表</h3>
                    <div class="ui relaxed link list">
                        @foreach($videos as $item)
                        <a class="@if(route('video.show', ['slug'=> $course->slug, 'episode_id' => $item->episode_id]) == Request::url()) active @endif item" href="{{ route('video.show', ['slug'=> $course->slug, 'episode_id' => $item->episode_id]) }}"><i class="right triangle icon"></i>{{ $item->name }}</a>
                        @endforeach
                    </div>
                </div>

                <div class="ui segment">
                    <h3 class="header"><i class="list ul icon"></i>最新课程</h3>
                    <div class="ui relaxed link list">
                        @foreach($recentCourses as $val)
                            <a class="item" href="{{ route('courses.show', ['slug'=> $val->slug]) }}"><i class="right triangle icon"></i>{{ $val->name }}</a>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="one wide column"></div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/social-share.js/1.0.16/js/social-share.min.js"></script>
    <script type="text/javascript">
        var $config = {
            // sites               : ['wechat','qq','weibo','google','facebook'], // 启用的站点
            disabled            : ['diandian', 'douban', 'tencent', 'qzone', 'linkedin'], // 禁用的站点
            wechatQrcodeTitle   : "微信扫一扫：分享", // 微信二维码提示文字
            wechatQrcodeHelper  : '<p>微信里点“发现”，扫一下</p><p>二维码便可将本文分享至朋友圈。</p>',
        };
        socialShare('.social-share', $config);

        var video = videojs("phpcasts-video", {
            "fluid":!0,
            "playbackRates":[0.5,.75,1,1.25,1.5,1.75,2],
            "controls": true,
            "autoplay": false,
            "preload": "auto"
        }).ready(function () {

        });

        function reply_vote(comment_id) {
            console.log(comment_id);
            $.ajax({
                type: 'POST',
                url: '/comment/' + comment_id + '/vote',
                data: {'_token': '{{ csrf_token() }}','_method':'post'},
                dataType:'json',
                success: function (ret) {
                    console.log(ret);
                    if (ret.code == 200 ) {
                        $('#vote_count_' + comment_id).text(ret.count);
                    }
                }
            });
        }

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
    </script>
@endsection