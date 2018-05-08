@extends('frontend.layouts.master')

@section('title')
    博客
@endsection

@section('content')
    <div class="ui stackable grid container">
        <div class="row"></div>
        <div class="row">
            <div class="four wide column">
                <div class="ui segment">
                    <h3 class="ui header"><i class="icon chart bar"></i> 阅读排行榜 </h3>
                    <div class="ui divided items">
                        @foreach($topPosts as $post)
                            <div class="item">
                                <div class="content" style="font-size: 16px;">
                                    <a class="header" href="{{ route('post.show', $post->slug) }}" style="font-size: 16px;">
                                        {{ $post->title }}
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="twelve wide column">
                <div class="ui segment">
                <div class="ui  divided relaxed items">
                    @foreach($posts as $post)
                        <div class="item">
                            {{--<div class="ui small image">--}}
                                {{--<img src="{{ cdn('/blog-default-post-cover.jpeg') }}">--}}
                            {{--</div>--}}
                            <div class="content">
                                <a class="header" href="{{ route('post.show', $post->slug) }}">{{ $post->title }}</a>
                                <div class="meta">
                                    <a>{{ $post->created_at }}</a>
                                </div>
                                <div class="description">
                                    {{ $post->summary }}
                                </div>
                                <div class="extra">
                                    {{--<div class="ui label">tag1</div>--}}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                {!! $posts->render('partials.semantic-pagination') !!}
                </div>
            </div>
        </div>
        <div class="row"></div>
    </div>
@endsection