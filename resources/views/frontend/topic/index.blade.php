@extends('frontend.layouts.master')

@section('content')
    <div class="ui grid">
        <div class="row"></div>
        <div class="row">
            <div class="thirteen wide column centered">
                <div class="ui grid">
                    <div class="twelve wide column">
                        <div class="ui secondary segment">
                            <p>I am pretty noticeable but you might check out other content before you look at me.</p>
                        </div>
                        <div class="ui large middle aligned divided relaxed list padded segment">
                            @if(count($topics))
                            @foreach($topics as $topic)
                            <div class="item">
                                <div class="right floated content">
                                    <div class="ui circular labels">
                                        <a class="ui label">
                                            11
                                        </a>
                                    </div>
                                </div>
                                <img class="ui avatar image" src="{{ asset('/avatars/avatar.png') }}">
                                <div class="content">
                                    <a class="header" href="{{ route('topic.show', $topic->id) }}">{{ $topic->title }}</a>
                                    <div class="description">
                                        <div class="ui horizontal link list">
                                            <a class="item">
                                                <div class="ui horizontal label">PHP</div>
                                            </a>
                                            <a class="disabled item">
                                                3分钟前
                                            </a>
                                            <a class="disabled item">
                                                最后回复来自:
                                            </a>
                                            <a class="item">
                                                是非得失发
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            @endif
                        </div>
                    </div>
                    <div class="four wide column">
                        <div class="ui center aligned segment">
                            <a class="ui teal big basic button" href="{{ route('topic.create') }}"><i class="write icon"></i>新建话题</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row"></div>
    </div>

@endsection