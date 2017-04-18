@extends('frontend.layouts.master')

@section('title')
    {{ $video->name }} - {{ $course->name }} - 视频
@endsection

@section('styles')
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
    <div class="ui grid" style="background-color: #393E46">
        <div class="row"></div>
        <div class="row">
            <div class="one wide column"></div>
            <div class="fourteen wide column">
                    <video id="phpcasts-video" class="video-js vjs-fluid vjs-big-play-centered placeholder"
                           poster="{{ cdn($video->cover_image) }}" data-setup='{}'>
                        <source src="{{ cdn($video->mp4_url) }}" type='video/mp4'>
                        <source src="" type="video/flv" data-quality="HD" label="HD" data-default="true">
                        <p class="vjs-no-js">
                            To view this video please enable JavaScript, and consider upgrading to a web browser that
                            <a href="http://videojs.com/html5-video-support/" target="_blank">supports HTML5 video</a>
                        </p>
                    </video>
                    <div class="ui fluid card" style="margin-top: 0px;">
                        <div class="content">
                            <div class="ui header">
                                <div class="ui big breadcrumb">
                                    <a class="section" href="{{ route('course.show', ['slug' => $course->slug]) }}">{{ $video->course->name }}</a>
                                    <i class="right arrow icon divider"></i>
                                    <div class="active section">{{ $video->name }}</div>
                                </div>
                            </div>
                            <div class="meta">发布于: {{ $video->created_at }}</div>
                            <div class="ui large feed">
                                <div class="event">
                                    <div class="content">
                                        <div class="summary">
                                            {{ $video->description }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="description">

                            </div>
                            <div class="extra content">
                                <button class="ui right floated teal button">下一节<i class="arrow right icon"></i></button>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="one wide column"></div>
        </div>
    </div>

    <div class="ui grid"  style="background-color: #E9EAED">
        <div class="row">
            <div class="one wide column"></div>
            <div class="fourteen wide column">
                <div class="ui comments segment">
                    <h3 class="ui dividing header">发表评论</h3>
                    <form class="ui reply form" method="post" action="{{ route('comment.store') }}">
                        {!! csrf_field() !!}
                        <input type="hidden" name="relation_id" value="{{ $video->id }}" >
                        <input type="hidden" name="slug" value="{{ $course->slug }}" >
                        <input type="hidden" name="episode_id" value="{{ $video->episode_id }}" >
                        <div class="@if(!Auth::check()) disabled field @endif">
                            <textarea name="content" id="reply_content" placeholder="@if(Auth::check()) 请使用Markdown语法编写 :) @else 需要登录后才能发表评论. @endif" required></textarea>
                        </div>
                        <button class="ui primary submit labeled icon button @if(!Auth::check()) disabled field @endif" type="submit"><i class="icon edit"></i>回复</button>
                    </form>
                    @foreach($comments as $comment)
                    <div class="comment">
                        <a class="avatar">
                            <img src="{{ $comment->user->avatar }}">
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
            <div class="one wide column"></div>
        </div>
        <div class="row"></div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript">
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