@extends('frontend.layouts.master')

@section('title')
  {{ $post->title }} - 博客
@endsection

@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/social-share.js/1.0.16/css/share.min.css">
    <link href="{{ asset('css/github-markdown.css') }}" rel="stylesheet">
    <style type="text/css">
        .ui.comments { max-width: 100%!important}
    </style>
@endsection

@section('content')
  <div class="ui container">
    <div class="ui hidden divider"></div>
    <div class="ui grid">
          <div class="sixteen wide column">
            <div class="ui large middle aligned divided relaxed list padded segment">
              <div class="ui divided items">
                  <div class="item">
                      {{--<div class="image">--}}
                      {{--<img src="/images/wireframe/image.png">--}}
                      {{--</div>--}}
                      <div class="content">
                        <a class="header" href="{{ route('blog.show', ['slug' => $post->slug]) }}">{{ $post->title }}</a>
                        <div class="meta">
                          <p class="cinema">发布时间：{{ $post->created_at }}</p>
                          <span class="cinema">更新时间：{{ $post->updated_at }}</span>
                        </div>
                          <div class="description markdown-body">
                              <div class="ui hidden divider"></div>
                              {!! $post->content !!}
                              <div class="ui hidden divider"></div>
                          </div>
                      </div>
                    </div>

                  <!--social share bar-->
                  <div class="social-share"></div>
              </div>
            </div>
          </div>
        </div>
    <div class="ui hidden divider"></div>
  </div>

@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/social-share.js/1.0.16/js/social-share.min.js"></script>
@endsection