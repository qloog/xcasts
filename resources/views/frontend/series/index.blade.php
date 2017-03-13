@extends('frontend.layouts.master')

@section('title')
    视频
@endsection

@section('content')

    <div class="ui center aligned header basic raised segment">
        <div class="teal ui buttons">
            <a class="ui @if($type=='') active @endif large button" href="{{ route('series.index') }}">全部</a>
            <a class="ui @if($type=='backend') active @endif large button" href="{{ route('series.index', ['type' => 'backend']) }}">后端</a>
            <a class="ui @if($type=='service') active @endif large button" href="{{ route('series.index', ['type' => 'service']) }}">服务</a>
            <a class="ui @if($type=='frontend') active @endif large button" href="{{ route('series.index', ['type' => 'frontend']) }}">前端</a>
            <a class="ui @if($type=='tool') active @endif large button" href="{{ route('series.index', ['type' => 'tool']) }}">工具</a>
            <a class="ui @if($type=='test') active @endif large button" href="{{ route('series.index', ['type' => 'test']) }}">测试</a>
        </div>
    </div>

    <div class="ui inverted container divider"></div>

    <div class="ui container">
        @include('frontend.layouts.partials.series_list')

        {!! $series->render() !!}
    </div>

    <div class="ui center aligned header basic raised segment"></div>

@endsection