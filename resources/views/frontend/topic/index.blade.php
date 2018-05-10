@extends('frontend.layouts.master')

@section('title')
    社区
@endsection

@section('content')
    <div class="ui vertical stripe segment" style="padding: 2em 0em;">
        <div class="ui stackable grid container">
            <div class="row">
                <div class="twelve wide column">
                    <div class="ui divided items segment">
                    @if(count($topics))
                    @foreach($topics as $topic)
                    <div class="item">
                        <img class="ui rounded image " src="{{ get_avatar_url($topic->user) }}" width="48px;" height="48px;">
                        <div class="middle aligned content">
                            <a class="header" href="{{ route('topics.show', $topic->id) }}">{{ $topic->title }}</a>
                            <div class="meta" style="margin-bottom: -10px;">
                                <span style="font-size: 12px; color: #ccc">
                                    <a class="item"><div class="ui horizontal label">{{ $topic->category->name }}</div></a>
                                    ⋅  <a href="{{ route('user.show', $topic->user_id) }}">{{ $topic->user->name }}</a>
                                    ⋅ 于 {{ $topic->created_at->diffForHumans() }}
                                    @if($topic->last_reply_user_id > 0)
                                    ⋅ 最后回复由
                                        <a href="{{ route('user.show', $topic->last_reply_user_id) }}">
                                            {{ $topic->lastReplyUser->name }}
                                        </a>
                                        于 {{ $topic->last_reply_time_at->diffForHumans() }}
                                    @endif
                                </span>
                                <div class="ui right floated content">
                                    <i class="comment outline icon"></i> {{ $topic->reply_count }}
                                </div>
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
                        <a class="ui teal huge button" href="{{ route('topics.create') }}"><i class="write icon"></i>新建话题</a>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="row"></div>

@endsection