@extends('frontend.layouts.master')

@section('content')

    <div class="ui center aligned header basic raised segment">
        <div class="teal ui buttons">
            <a class="ui @if($type=='backend') active @endif large button" href="{{ route('course.index', ['type' => 'backend']) }}">后端</a>
            <a class="ui @if($type=='service') active @endif large button" href="{{ route('course.index', ['type' => 'service']) }}">服务</a>
            <a class="ui @if($type=='frontend') active @endif large button" href="{{ route('course.index', ['type' => 'frontend']) }}">前端</a>
            <a class="ui @if($type=='tool') active @endif large button" href="{{ route('course.index', ['type' => 'tool']) }}">工具</a>
        </div>
    </div>

    <div class="ui inverted container divider"></div>

    <div class="ui container">
        @include('frontend.layouts.partials.course_list')

        {!! $courses->render() !!}
    </div>

    <div class="ui center aligned header basic raised segment"></div>

@endsection