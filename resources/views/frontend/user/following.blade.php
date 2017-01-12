@extends('frontend.layouts.master')

@section('content')
    <div class="ui grid" style="background-color: #E9EAED">
        <div class="row"></div>
        <div class="row">
            <div class="thirteen wide column centered">
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
                                <div class="active section">关注的用户</div>
                            </div>
                        </div>

                        <!-- detail -->
                        <div class="ui segment">
                            <div class="ui middle aligned animated divided list">
                                @foreach($followings as $following)
                                <div class="item">
                                    <img class="ui avatar image" src="{{ $following->avatar }}">
                                    <div class="content">
                                        <div class="header">
                                            <a class="teal color" href="{{ route('user.show', $following->id) }}" target="_blank">{{ $following->name }}</a>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            {{--<div class="ui comments">--}}
                                    {{--<div class="comment">--}}
                                        {{--<div class="content">--}}
                                            {{--<img class="ui avatar image" src="{{ $following->avatar }}">--}}
                                            {{--<a class="teal color" href="{{ route('user.show', $following->id) }}" target="_blank">{{ $following->name }}</a>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                            {{--</div>--}}
                            {!! $followings->render('partials.semantic-pagination') !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row"></div>
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