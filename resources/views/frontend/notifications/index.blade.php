@extends('frontend.layouts.master')

@section('content')
    <div class="ui grid" style="background-color: #E9EAED">
        <div class="row"></div>
        <div class="row">
            <div class="sixteen wide column centered">
                <div class="ui grid">
                    {{--<div class="four wide column">--}}
                        {{--@include('frontend.user.base_info')--}}

                        {{--@include('frontend.user.info_nav')--}}
                    {{--</div>--}}
                    <div class="sixteen wide column">
                        <div class="ui large middle aligned divided list padded segment">
                            <div class="ui breadcrumb">
                                <div class="active section">我的提醒</div>
                            </div>
                        </div>

                        <!-- detail -->
                        <div class="ui large middle aligned divided relaxed list padded segment">

                            <div class="ui comments">
                                @foreach($notifications as $item)
                                    <div class="comment">
                                        <div class="content">
                                            <a class="teal color" href="{{ route('topic.show', $item->topic_id) }}" target="_blank">test</a>
                                            <div class="metadata">
                                                <div class="date">
                                                    {{ $item->created_at->diffForHumans() }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
{{--                            {!! $notifications->render('partials.semantic-pagination') !!}--}}
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