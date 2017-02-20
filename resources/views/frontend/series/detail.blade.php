@extends('frontend.layouts.master')

@section('content')

    <!-- banner -->
    <div class="ui grid" style="height:260px; background: #393E46;">
        <div class="row">
            <div class="three wide column"></div>
            <div class="ten wide column" style="color: #ffffff;margin-top: 40px;">
                <h3>{{ $series->name }}</h3>
                <div class="label">{{ $series->description }}</div>
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
                    @if (count($series->lessons) > 0)
                        @foreach($series->lessons as $key => $lesson)
                        <tr style="display: table-row">
                            <td class="ui center aligned">{{ $lesson->episode_id }}</td>
                            <td>
                                <i class="video play outline large icon"></i>
                                <a href="{{ route('series.lesson.show', ['slug' => $series->slug, $lesson->episode_id]) }}">{{ $lesson->name }}</a>
                            </td>
                            <td class="ui right aligned">
                                @if($lesson->is_free == 1)
                                    <a class="ui green label">Free</a>
                                @endif
                            </td>
                            <td class="ui right aligned">{{ $lesson->length }}</td>
                            <td class="ui center aligned">{{ date('Y-m-d' ,strtotime($lesson->created_at)) }}</td>
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