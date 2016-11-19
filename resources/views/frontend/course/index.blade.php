@extends('frontend.layouts.master')

@section('content')

    <div class="ui center aligned header basic raised segment">
        <div class="teal ui buttons">
            <button class="ui active large button">后端</button>
            <button class="ui large button">服务</button>
            <button class="ui large button">前端</button>
            <button class="ui large button">工具</button>
        </div>
    </div>

    <div class="ui inverted container divider"></div>

    <div class="ui container">
        <div class="ui three stackable cards">

            @if (count($courses))
                @foreach($courses as $course)
                    <div class="ui raised link card">
                        <a class="image" href="{{ route('course.show', $course->slug) }}">
                            <img src="{{ $course->cover }}" style="width: 300px; height: 200px;"/>
                        </a>
                        <div class="content">
                            <a class="header" href="{{ route('course.show', $course->slug) }}">{{ $course->name }}</a>
                            <div class="meta">
                                {{--<a class="time">Last Seen 2 days ago</a>--}}
                                <span class="right floated">10 视频</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>

        {!! $courses->render() !!}
    </div>

    <div class="ui center aligned header basic raised segment"></div>

@endsection