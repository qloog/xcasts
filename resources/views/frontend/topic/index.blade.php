@extends('frontend.layouts.master')

@section('title')
    社区
@endsection

@section('content')
    <div class="ui grid">
        <div class="row"></div>
        <div class="row">
            <div class="thirteen wide column centered">
                <div class="ui grid">
                    <div class="twelve wide column">
                        <div class="ui large middle aligned divided relaxed list padded segment">
                            @if(count($topics))
                            @foreach($topics as $topic)
                            <div class="item">
                                <div class="right floated content">
                                    <div class="ui circular labels">
                                        <a class="ui label">
                                            {{ $topic->reply_count }}
                                        </a>
                                    </div>
                                </div>
                                <img class="ui avatar image" src="{{ cdn($topic->user->avatar) }}">
                                <div class="content">
                                    <a class="header" href="{{ route('topic.show', $topic->id) }}">{{ $topic->title }}</a>
                                    <div class="meta" style="margin-top: 5px;">
                                        <span style="font-size: 12px; color: #ccc">
                                            <a class="item"><div class="ui horizontal label">{{ $topic->category->name }}</div></a>
                                            ⋅  <a href="{{ route('user.show', $topic->user_id) }}">{{ $topic->user->name }}</a>
                                            ⋅ 于 {{ $topic->created_at->diffForHumans() }}
                                            ⋅ 最后回复由 <a href="{{ route('user.show', $topic->last_reply_user_id) }}">{{ $topic->lastReplyUser->name }}</a> 于 {{ $topic->updated_at->diffForHumans() }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            @endif
                        </div>
                        {!! $topics->render('partials.semantic-pagination') !!}
                    </div>
                    <div class="four wide column">
                        @if(Auth::check())
                        <div class="ui center aligned segment">
                            <a class="ui teal big basic button" href="{{ route('topic.create') }}"><i class="write icon"></i>新建话题</a>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="row"></div>
    </div>

@endsection