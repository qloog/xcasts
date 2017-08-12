@extends('frontend.layouts.master')

@section('title')
    发布的话题
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
                                    <div class="active section">发布的话题({{ $user->topic_count }})</div>
                                </div>
                            </div>

                            <!-- detail -->
                            <div class="ui large middle aligned divided relaxed list padded segment">

                                <div class="ui comments">
                                    @foreach($topics as $topic)
                                        <div class="comment">
                                            <div class="content">
                                                <a class="teal color" href="{{ route('topics.show', $topic->id) }}" target="_blank">{{ $topic->title }}</a>
                                                <div class="metadata">
                                                    <div class="date">
                                                        {{ $topic->created_at->diffForHumans() }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                {!! $topics->render('partials.semantic-pagination') !!}
                            </div>
                        </div>
                    </div>
            <div class="ui hidden divider"></div>
        </div>
    </div>

@endsection

@section('scripts')
    <script type="text/javascript">
        $(document).ready(function () {
            $('.ui.dropdown').dropdown();

            $('.button').popup();
        });
    </script>
@endsection