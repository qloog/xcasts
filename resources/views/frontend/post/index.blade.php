@extends('frontend.layouts.master')

@section('title')
    博客
@endsection

@section('content')
    <div class="ui grid">
        <div class="row"></div>
        <div class="row">
            <div class="thirteen wide column centered">
                <div class="ui grid">
                    <div class="sixteen wide column">
                        <div class="ui large middle aligned divided relaxed list padded segment">
                            <div class="ui divided items">
                            @if(count($posts))
                                @foreach($posts as $post)
                                <div class="item">
                                    {{--<div class="image">--}}
                                        {{--<img src="/images/wireframe/image.png">--}}
                                    {{--</div>--}}
                                    <div class="content">
                                        <a class="header" href="{{ route('blog.show', ['id' => $post->id]) }}">{{ $post->title }}</a>
                                        <div class="meta">
                                            <span class="cinema">发布于：{{ $post->created_at }}</span>
                                        </div>
                                        <div class="description">
                                            <p>
                                                {{ $post->content }}
                                            </p>
                                        </div>
                                        {{--<div class="extra">--}}
                                            {{--<div class="ui label">IMAX</div>--}}
                                            {{--<div class="ui label"><i class="globe icon"></i> Additional Languages</div>--}}
                                            {{--<div class="ui right floated primary button">--}}
                                                {{--Buy tickets--}}
                                                {{--<i class="right chevron icon"></i>--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                    </div>
                                </div>
                                @endforeach
                            @endif
                            </div>
                        </div>
                        {!! $posts->render('partials.semantic-pagination') !!}
                    </div>
                </div>
            </div>
        </div>
        <div class="row"></div>
    </div>

@endsection