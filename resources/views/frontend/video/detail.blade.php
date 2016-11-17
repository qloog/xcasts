@extends('frontend.layouts.master')

@section('styles')
    <link href="{{ asset('videojs/video-js.min.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="ui grid">
        <div class="row" style="background-color: #393E46;">
            <div class="one wide column"></div>
            <div class="fourteen wide column">
                <video id="course-video" class="video-js vjs-fluid vjs-big-play-centered placeholder"
                       poster="{{ $video->cdn_cover_image }}" data-setup='{}'>
                    <source src="{{ $video->cdn_mp4_url }}" type='video/mp4'>
                    <p class="vjs-no-js">
                        To view this video please enable JavaScript, and consider upgrading to a web browser that
                        <a href="http://videojs.com/html5-video-support/" target="_blank">supports HTML5 video</a>
                    </p>
                </video>
                <div class="ui bottom attached"  style="background-color: #393E46;">
                    <div class="ui header">{{ $video->name }}</div>
                    <div class="meta">发布于: {{ $video->created_at }}</div>
                    <div class="description">{{ $video->description }}</div>
                </div>
            </div>
            <div class="one wide column"></div>
        </div>
    </div>

    <div class="ui divider"></div>

    <div class="ui container">
        <div class="ui comments">
            <h3 class="ui dividing header">评论</h3>
            <div class="comment">
                <a class="avatar">
                    <img src="http://alcdn.img.xiaoka.tv/20161017/eaa/10a/2725024/eaa10a6a418be34d6ab830edceabcfce.jpg">
                </a>
                <div class="content">
                    <div class="author">
                        <form class="ui reply form">
                            <div class="field">
                                <textarea></textarea>
                            </div>
                            <div class="ui primary submit labeled icon button"><i class="icon edit"></i> Add Comment </div>
                        </form>
                    </div>
                </div>
            </div>
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
                        <a class="right floated reply">Reply</a>
                    </div>
                </div>
            </div>
            <div class="comment">
                <a class="avatar">
                    <img src="http://alcdn.img.xiaoka.tv/20161017/eaa/10a/2725024/eaa10a6a418be34d6ab830edceabcfce.jpg">
                </a>
                <div class="content">
                    <a class="author">Christian Rocha</a>
                    <div class="metadata">
                        <div class="date">2 days ago</div>
                    </div>
                    <div class="text">I re-tweeted this. </div>
                    <div class="actions">
                        <a class="reply">Reply</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('videojs/video.min.js') }}"></script>
    <!-- If you'd like to support IE8 -->
    <script src="{{ asset('videojs/ie8/videojs-ie8.min.js') }}"></script>

    <script type="text/javascript">
        var video = videojs("course-video", {
            "controls": true,
            "autoplay": false,
            "preload": "auto"
        }).ready(function () {
            var myPlayer = this;    // Store the video object
            var aspectRatio = 5 / 12;
            function resizeVideoJS() {
                // Get the parent element's actual width
                var width = document.getElementById(myPlayer.id()).parentElement.offsetWidth;
                // Set width to fill parent element, Set height
                myPlayer.width(width).height(width * aspectRatio);
            }
            resizeVideoJS(); // Initialize the function
            window.onresize = resizeVideoJS; // Call the function on resize
        });
    </script>
@endsection