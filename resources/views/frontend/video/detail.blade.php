@extends('frontend.layouts.master')

@section('styles')
    <link href="{{ asset('videojs/video-js.min.css') }}" rel="stylesheet">
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
                           poster="{{ $video->cdn_cover_image }}" data-setup='{}'>
                        {{--<source src="{{ $video->cdn_mp4_url }}" type='video/mp4'>--}}
                        <source src="http://live.mengzhu.tv/mz/19.flv"
                                type="video/flv"
                                data-quality="HD"
                                label="HD"
                                data-default="true">
                        <p class="vjs-no-js">
                            To view this video please enable JavaScript, and consider upgrading to a web browser that
                            <a href="http://videojs.com/html5-video-support/" target="_blank">supports HTML5 video</a>
                        </p>
                    </video>
                    <div class="ui fluid card" style="margin-top: 0px;">
                        <div class="content">
                            <div class="ui header">
                                <div class="ui big breadcrumb">
                                    <a class="section">Yaf路由</a>
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
                    @foreach($comments as $comment)
                    <div class="comment">
                        <a class="avatar">
                            <img src="http://alcdn.img.xiaoka.tv/20161017/eaa/10a/2725024/eaa10a6a418be34d6ab830edceabcfce.jpg">
                        </a>
                        <div class="content">
                            <a class="author">{{ $comment->user->username }}</a>
                            <div class="metadata">
                                <div class="date">{{ $comment->created_at->diffForHumans() }}</div>
                            </div>
                            <div class="text markdown-body">
                                <p>{!! $comment->content !!}</p>
                            </div>
                            <div class="actions">
                                <a class="reply"><i class="thumbs outline up icon"></i>赞</a>
                                <a class="reply"><i class="reply icon"></i>回复</a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    <form class="ui reply form" method="post" action="{{ route('comment.store') }}">
                        {!! csrf_field() !!}
                        <input type="hidden" name="relation_id" value="{{ $video->id }}" >
                        <input type="hidden" name="type" value="video" >
                        <div class="field">
                            <textarea name="content" placeholder="支持Markdown语法"></textarea>
                        </div>
                        <button class="ui primary submit labeled icon button" type="submit"><i class="icon edit"></i>发表回复</button>
                    </form>
                </div>
            </div>
            <div class="one wide column"></div>
        </div>
        <div class="row"></div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('videojs/video.min.js') }}"></script>
    <!-- If you'd like to support IE8 -->
    <script src="{{ asset('videojs/ie8/videojs-ie8.min.js') }}"></script>

    <script type="text/javascript">
        var video = videojs("phpcasts-video", {
            "fluid":!0,
            "playbackRates":[0.5,.75,1,1.25,1.5,1.75,2],
            "controls": true,
            "autoplay": false,
            "preload": "auto"
        }).ready(function () {

        });
    </script>
@endsection