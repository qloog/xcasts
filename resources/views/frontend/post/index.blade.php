@extends('frontend.layouts.master')

@section('title')
    博客
@endsection

@section('content')
    <div class="ui stackable grid container">
        <div class="row"></div>
        <div class="row">
            <div class="four wide column">
                {{--<div class="ui basic segment">--}}
                    <div class="ui large fluid vertical menu">
                        <div class="item">
                            <h3 class="header"><i class="icon chart bar"></i> 阅读排行榜 </h3>
                            <div class="menu">
                            @foreach($topPosts as $post)
                                <a class="item" href="{{ route('post.show', $post->slug) }}" style="font-size: 16px;">
                                    {{ $post->title }}
                                </a>
                            @endforeach
                            </div>
                        </div>
                    </div>
                {{--</div>--}}
            </div>
            <div class="twelve wide column">
                <div class="ui segment">
                <div class="ui  divided relaxed items">
                    @foreach($posts as $post)
                        <div class="item"  style="padding: 0.5em 0em;">
                            {{--<div class="ui small image">--}}
                                {{--<img src="{{ cdn('/blog-default-post-cover.jpeg') }}">--}}
                            {{--</div>--}}
                            <div class="content">
                                <a class="header" href="{{ route('post.show', $post->slug) }}" style="font-size: 15px;font-weight: 100">
                                    {{ $post->title }}
                                </a>
                                <div class="meta">
                                    <a><i class="clock outline icon"></i>{{ $post->created_at }}</a>
                                </div>
                                <div class="description">
                                    {{ $post->summary }}
                                </div>
                                <div class="extra">
                                    {{--<div class="ui right floated  button">--}}
                                        {{--阅读全文--}}
                                        {{--<i class="right chevron icon"></i>--}}
                                    {{--</div>--}}
                                    <div class="ui label">
                                        <i class="binoculars icon"></i>
                                        {{ $post->view_count }}

                                    </div>
                                    <a class="header" href="{{ route('post.show', ['id' => $post->slug]) }}">阅读全文</a>
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