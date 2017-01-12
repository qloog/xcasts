@extends('frontend.layouts.master')

@section('content')

    <!-- banner -->
    <div class="ui grid" style="height:260px; background: #393E46;">
        <div class="row">
            <div class="three wide column"></div>
            <div class="ten wide column" style="color: #ffffff;margin-top: 40px;">
                <h3>{{ $course->name }}</h3>
                <div class="label">{{ $course->description }}</div>
            </div>
            <div class="three wide column"></div>
        </div>
    </div>

    <!-- episode list-->
    <div class="ui grid"  style="background-color: #E9EAED;">
        <div class="row">
            <div class="four wide column"></div>
            <div class="eight wide column">
                <table class="ui single line selectable  table">
                    <tbody>
                    @if (count($course->videos) > 0)
                        @foreach($course->videos as $key => $video)
                        <tr style="display: table-row">
                            <td class="ui center aligned">{{ $key+1 }}</td>
                            <td>
                                <i class="video play outline large icon"></i>
                                <a href="{{ route('course.video.show', $video->id) }}">{{ $video->name }}</a>
                            </td>
                            <td class="ui right aligned">
                                @if($video->is_free == 1)
                                    <a class="ui green label">Free</a>
                                @endif
                            </td>
                            <td class="ui right aligned">{{ $video->length }}</td>
                            <td class="ui center aligned">{{ date('Y-m-d' ,strtotime($video->created_at)) }}</td>
                        </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>
            </div>
            <div class="four wide column"></div>
        </div>
        <div class="row"></div>
    </div>

@endsection