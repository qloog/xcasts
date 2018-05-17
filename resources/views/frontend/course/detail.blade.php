@extends('frontend.layouts.master')

@section('title')
    {{ $course->name }} - 视频
@endsection

@section('description', $course->description)

@section('content')

    <!-- banner -->
    <div class="ui vertical stripe segment" style="background:url('{{ thumb($course->cover_image, 1480, 525) }}')no-repeat 50% 0;height:525px">
        <div class="ui middle aligned stackable grid container">
            <div class="row">
                {{--<div class="one wide column"></div>--}}
                <div class="sixteen wide column" style="color: #ffffff;margin-top: 40px; background: rgba(0,0,0,0.3);padding: 30px 15px;">
                    <h3>{{ $course->name }}</h3>
                    <div class="label">{{ $course->description }}</div>
                </div>
                {{--<div class="one wide column"></div>--}}
            </div>
        </div>
    </div>

    <!-- episode list-->
    <div class="ui vertical stripe segment" style="background-color: #E9EAED;">
        <div class="ui middle aligned stackable grid container">
            <div class="row">
                <div class="twelve wide column">
                    <table class="ui selectable  striped structured teal table">
                        <thead>
                            <tr>
                                <th colspan="5" class="ui medium center aligned black header">课程大纲</th>
                            </tr>
                        </thead>
                        <tbody>
                        @if(count($course->sections) > 0)
                            @foreach($course->sections as $key => $section)
                                <tr>
                                    <td colspan="4" class="left aligned"><a href="#{{ $section->id }}" class="ui small black header">{{ $section->name }}</a></td>
                                </tr>
                                @foreach($section->videos as $k => $video)
                                    <tr style="display: table-row;" @if($video->mp4_url == '')  class="disabled" @endif>
                                        <td>
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            <i class="video play outline large icon"></i>
                                            @if($video->mp4_url)
                                                <a href="{{ route('video.show', ['slug' => $course->slug, $video->episode_id]) }}">{{ $video->name }}</a>
                                            @else
                                                <a>{{ $video->name }}</a>
                                            @endif
                                        </td>
                                        <td class="ui right aligned">
                                            @if($video->mp4_url && $video->is_free == 1)
                                                <a class="ui green label">Free</a>
                                            @elseif($video->mp4_url == '')
                                                <a class="ui gray label">录制中</a>
                                            @endif
                                        </td>
                                        <td class="ui right aligned">{{ formatToMinute($video->duration) }}</td>
                                        <!-- todo: 用发布时间取代 -->
                                        <td class="ui center aligned">{{ date('Y-m-d' ,strtotime($video->published_at)) }}</td>
                                    </tr>
                                @endforeach
                            @endforeach
                        @elseif (count($course->videos) > 0)
                            @foreach($course->videos as $key => $video)
                                @if ($video->mp4_url)
                                    <tr style="display: table-row">
                                        <td class="ui center aligned">{{ $key + 1 }}</td>
                                        <td>
                                            <i class="video play outline large icon"></i>
                                            <a href="{{ route('video.show', ['slug' => $course->slug, $video->episode_id]) }}">{{ $video->name }}</a>
                                        </td>
                                        <td class="ui right aligned">
                                            @if($video->is_free == 1)
                                                <a class="ui green label">Free</a>
                                            @endif
                                        </td>
                                        <td class="ui right aligned">{{ formatToMinute($video->duration) }}</td>
                                        <!-- todo: 用发布时间取代 -->
                                        <td class="ui center aligned">{{ date('Y-m-d' ,strtotime($video->published_at)) }}</td>
                                    </tr>
                                @else
                                    <tr style="display: table-row" class="disabled">
                                        <td class="ui center aligned">{{ $key + 1 }}</td>
                                        <td>
                                            <i class="video play outline large icon"></i>
                                            <a>{{ $video->name }}</a>
                                        </td>
                                        <td class="ui right aligned"></td>
                                        <td class="ui right aligned"></td>
                                        <td class="ui center aligned"></td>
                                    </tr>
                                @endif
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row"></div>
        </div>
    </div>

@endsection