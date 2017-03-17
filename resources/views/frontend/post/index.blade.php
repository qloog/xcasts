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
                                        <a class="header" href="javascript:;">12 Years a Slave</a>
                                        <div class="meta">
                                            <span class="cinema">发布于：2017-10-10</span>
                                        </div>
                                        <div class="description">
                                            <p>
                                                我是简单的描述貌似我是简单的描述貌似我是简单的描述貌似我是简单的描述貌似我是简
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
                        {{--{!! $posts->render('partials.semantic-pagination') !!}--}}
                    </div>
                </div>
            </div>
        </div>
        <div class="row"></div>
    </div>

@endsection