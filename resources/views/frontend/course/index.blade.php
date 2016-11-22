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
        @include('frontend.layouts.partials.course_list')

        {!! $courses->render() !!}
    </div>

    <div class="ui center aligned header basic raised segment"></div>

@endsection