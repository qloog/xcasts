@extends('frontend.layouts.master')

@section('title')
    个人中心
@endsection

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
                    <div class="four wide column">
                        @include('frontend.user.base_info')

                        @include('frontend.user.info_nav')
                    </div>
                    <div class="twelve wide column">
                        <!-- detail -->
                        <div class="ui secondary segment">
                            <h4>最近话题</h4>
                        </div>
                        <div class="ui large middle aligned divided relaxed list padded segment" style="margin-top: -18px;">
                            <div class="ui comments">
                                @foreach($topics as $topic)
                                    <div class="comment">
                                        <div class="content">
                                            <a class="teal color" href="{{ route('topic.show', $topic->id) }}" target="_blank">{{ $topic->title }}</a>
                                            <div class="metadata">
                                                <div class="date">
                                                    {{ $topic->created_at->diffForHumans() }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <!-- detail -->
                        <div class="ui secondary segment">
                            <h4>最新评论</h4>
                        </div>
                        <div class="ui large middle aligned divided relaxed list padded segment"  style="margin-top: -18px;">
                            <div class="ui comments">
                                @foreach($replies as $reply)
                                    <div class="comment">
                                        <div class="content">
                                            <a class="teal color" href="{{ route('topic.show', $reply->topic->id) }}" target="_blank">{{ $reply->topic->title }}</a>
                                            <div class="metadata">
                                                <div class="date">
                                                    {{ $reply->created_at->diffForHumans() }}
                                                </div>
                                            </div>
                                            <div class="text markdown-body">
                                                {!! $reply->body !!}
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
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
        });
    </script>
@endsection