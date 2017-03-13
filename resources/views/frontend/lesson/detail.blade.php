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
                           poster="{{ $lesson->cover_image }}" data-setup='{}'>
                        <source src="{{ $lesson->mp4_url }}" type='video/mp4'>
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
                                    <a class="section" href="{{ route('series.show', ['slug' => $series->slug]) }}">{{ $lesson->series->name }}</a>
                                    <i class="right arrow icon divider"></i>
                                    <div class="active section">{{ $lesson->name }}</div>
                                </div>
                            </div>
                            <div class="meta">发布于: {{ $lesson->created_at }}</div>
                            <div class="ui large feed">
                                <div class="event">
                                    <div class="content">
                                        <div class="summary">
                                            {{ $lesson->description }}
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
                        <input type="hidden" name="relation_id" value="{{ $lesson->id }}" >
                        <input type="hidden" name="slug" value="{{ $series->slug }}" >
                        <input type="hidden" name="episode_id" value="{{ $lesson->episode_id }}" >
                        <input type="hidden" name="type" value="lesson" >
                        <div class="@if(!Auth::check()) disabled field @endif">
                            <textarea name="content" placeholder="@if(Auth::check()) 请使用Markdown语法编写 :) @else 需要登录后才能发表评论. @endif" required></textarea>
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
                                <a class="reply"><i class="thumbs outline up icon"></i>赞(0)</a>
                                <a class="reply"><i class="reply icon"></i>回复</a>
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