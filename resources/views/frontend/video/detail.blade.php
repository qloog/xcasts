@extends('frontend.layouts.master')

@section('styles')
    <link href="{{ asset('videojs/video-js.min.css') }}" rel="stylesheet">
    <style type="text/css">
        /* Hidden by default, selectively shown.
            At this point this is how a skin designer would show them. */
        .video-js .vjs-current-time { display: block; }
        .video-js .vjs-time-divider { display: block; }
        .video-js .vjs-duration { display: block; }
    </style>
@endsection

@section('content')
    <div class="ui grid" style="background-color: #393E46">
        <div class="row"></div>
        <div class="row">
            <div class="one wide column"></div>
            <div class="fourteen wide column">
                <div class="ui basic segment">
                    <video id="phpcasts-video" class="video-js vjs-fluid vjs-big-play-centered placeholder"
                           poster="{{ $video->cdn_cover_image }}" data-setup='{}'>
                        {{--<source src="{{ $video->cdn_mp4_url }}" type='video/mp4'>--}}
                        <source src="//player.vimeo.com/external/149192583.hd.mp4?s=ced26a33f0ddd6538d7a7dbc767fe7a81f15668a&amp;profile_id=119"
                                type="video/mp4"
                                data-quality="HD"
                                label="HD"
                                data-default="true">

                        <source src="//player.vimeo.com/external/149192583.sd.mp4?s=b0a79c3165b9834290b709915b1f3e387a7ae285&amp;profile_id=112"
                                type="video/mp4"
                                data-quality="SD"
                                label="SD">
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
                                <button class="ui right floated teal button">下一节</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="one wide column"></div>
        </div>
    </div>


    <div class="ui grid">
        <div class="row" style="background-color: #F5F5F1">
            <div class="one wide column"></div>
            <div class="fourteen wide column">
                <div class="ui comments">
                    <h3 class="ui dividing header">发表评论</h3>
                    <div class="comment">
                        <a class="avatar">
                            <img src="http://alcdn.img.xiaoka.tv/20161017/eaa/10a/2725024/eaa10a6a418be34d6ab830edceabcfce.jpg">
                        </a>
                        <div class="content">
                            <a class="author">Joe Henderson</a>
                            <div class="metadata">
                                <div class="date">1 day ago</div>
                            </div>
                            <div class="text">
                                <p>The hours, minutes and seconds stand as visible reminders that your effort put them all there. </p>
                                <p>Preserve until your next run, when the watch lets you see how Impermanent your efforts are.</p>
                            </div>
                            <div class="actions">
                                <a class="right floated reply">回复</a>
                            </div>
                            <form class="ui reply form">
                                <div class="field">
                                    <textarea placeholder="支持Markdown语法"></textarea>
                                </div>
                                <div class="ui primary submit labeled icon button"><i class="icon edit"></i>发表回复</div>
                            </form>
                        </div>
                    </div>
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