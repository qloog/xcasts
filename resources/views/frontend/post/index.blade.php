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
                            @if(count($posts))
                                @foreach($posts as $post)
                                    <div class="item">
                                        <div class="right floated content">
                                            <div class="ui circular labels">
                                                <a class="ui label">
                                                    {{ $post->reply_count }}
                                                </a>
                                            </div>
                                        </div>
                                        <img class="ui avatar image" src="{{ $post->user->avatar }}">
                                        <div class="content">
                                            <a class="header" href="{{ route('topic.show', $post->id) }}">{{ $post->title }}</a>
                                            <div class="meta" style="margin-top: 5px;">
                                        <span style="font-size: 12px; color: #ccc">
                                            <a class="item"><div class="ui horizontal label">PHP</div></a>
                                            ⋅  <a href="{{ route('user.show', $post->user_id) }}">{{ $post->user->name }}</a>
                                            ⋅ 于 {{ $post->created_at->diffForHumans() }}
                                            ⋅ 最后回复由 <a href="{{ route('user.show', $post->last_reply_user_id) }}">{{ $post->lastReplyUser->name }}</a> 于 {{ $topic->updated_at->diffForHumans() }}
                                        </span>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                        {{--{!! $posts->render('partials.semantic-pagination') !!}--}}
                    </div>
                </div>
            </div>
        </div>
        <div class="row"></div>
    </div>

@endsection