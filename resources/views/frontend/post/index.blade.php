@extends('frontend.layouts.master')

@section('title')
    博客
@endsection

@section('content')
    <div class="ui container">

        <div class="ui hidden divider"></div>

        <div class="ui relaxed divided items">
            @foreach($posts as $post)
            <div class="item">
                <div class="ui medium image">
                    <img src="{{ cdn('blog-default-post-cover.jpeg') }}">
                </div>
                <div class="content">
                    <a class="header" href="{{ route('blog.show', $post->slug) }}">{{ $post->title }}</a>
                    <div class="meta">
                        <a>{{ $post->created_at }}</a>
                        {{--<a>分类</a>--}}
                    </div>
                    <div class="description">
                        {{ $post->summary }}
                    </div>
                    <div class="extra">
                        {{--<div class="ui right floated primary button">--}}
                            {{--<i class="right chevron icon"></i>--}}
                        {{--</div>--}}
                        {{--<div class="ui label">tag1</div>--}}
                    </div>
                </div>
            </div>
            @endforeach

            <div class="ui hidden divider"></div>
        </div>
    </div>
@endsection