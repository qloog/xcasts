@extends('frontend.layouts.master')

@section('title')
    赞过的话题
@endsection

@section('content')
    <div class="ui grid" style="background-color: #E9EAED">
        <div class="ui container">
            <div class="ui hidden divider"></div>
            <div class="ui grid">
                        <div class="four wide column">
                            @include('frontend.user.base_info')
                            @include('frontend.user.info_nav')
                        </div>
                        <div class="twelve wide column">
                            <div class="ui large middle aligned divided list padded segment">
                                <div class="ui breadcrumb">
                                    <a class="section" href="{{ route('user.show', $user->id) }}">个人中心</a>
                                    <div class="divider"> / </div>
                                    <div class="active section">赞过的话题</div>
                                </div>
                            </div>

                            <!-- detail -->
                            <div class="ui large middle aligned divided relaxed list padded segment">

                                <div class="ui comments">
                                    @foreach($topics as $topic)
                                        <div class="comment">
                                            <div class="content">
                                                <a class="teal color" href="{{ route('topic.show', $topic->id) }}" target="_blank">{{ $topic->title }}</a>
                                                <div class="metadata">
                                                    <div class="date">
                                                        {{ $topic['vote_count'] }} 点赞 ⋅ {{ $topic['reply_count'] }} 回复 ⋅
                                                    </div>
                                                    {{ $topic->created_at->diffForHumans() }}
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                {!! $topics->render() !!}
                            </div>
                        </div>
                    </div>
            <div class="ui hidden divider"></div>
        </div>
    </div>
@endsection