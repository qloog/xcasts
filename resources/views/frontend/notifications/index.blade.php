@extends('frontend.layouts.master')

@section('content')
    <div class="ui grid" style="background-color: #E9EAED">
        <div class="row"></div>
        <div class="row">
            <div class="thirteen wide column centered">
                <div class="ui grid">
                    <div class="four wide column">
                        <div class="ui center aligned segment">
                            <div class="ui divided very relaxed large list">
                                <a class="item" href="{{ route('notifications.index') }}"><i class="alarm icon"></i>通知</a>
                            </div>
                        </div>
                    </div>
                    <div class="twelve wide column">
                        <div class="ui large middle aligned divided list padded segment">
                            <div class="ui breadcrumb">
                                <div class="active section">我的提醒</div>
                            </div>
                        </div>

                        <!-- detail -->
                        <div class="ui large middle aligned divided relaxed list padded segment">
                            <div class="ui comments">
                                @if(count($notifications))
                                    @foreach($notifications as $notification)
                                        <div class="comment">
                                            <div class="content">
                                                <a href="{{ route('user.show', $notification->user->id) }}">{{ $notification->user->name }}</a>
                                                 •
                                                @if($notification->type == 'at')
                                                    在话体中提及你: <a class="teal color" href="{{ route('topic.show', $notification->topic_id) }}" target="_blank">{{ $notification->topic->title }}</a>
                                                    <div class="metadata">
                                                        <div class="date">
                                                            • 于 •  {{ $notification->created_at->diffForHumans() }}
                                                        </div>
                                                    </div>
                                                @elseif($notification->type == 'new_reply')
                                                    回复了你:<a class="teal color" href="{{ route('topic.show', $notification->topic_id) }}" target="_blank">{{ $notification->topic->title }}</a>
                                                    <div class="metadata">
                                                        <div class="date">
                                                            • 于 •  {{ $notification->created_at->diffForHumans() }}
                                                        </div>
                                                    </div>
                                                    <div class="text markdown-body">
                                                        {!! $notification->body !!}
                                                    </div>
                                                @elseif($notification->type == 'follow')
                                                    关注了你
                                                    <div class="metadata">
                                                        <div class="date">
                                                            • 于 •  {{ $notification->created_at->diffForHumans() }}
                                                        </div>
                                                    </div>
                                                @endif
                                                <h4 class="ui dividing header"></h4>
                                            </div>
                                        </div>
                                    @endforeach
                                    {!! $notifications->render('partials.semantic-pagination') !!}
                                @endif
                            </div>

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