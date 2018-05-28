    <div class="row">
        <div class="column">
            <div class="ui three stackable special cards">
                @if((isset($courses) && $courses))
                    @foreach($courses as $item)
                        <div class="ui raised link card">
                            <a class="ui image" href="{{ route('courses.show', $item->slug) }}">
                                {{--@if ($item->update_status == 1)--}}
                                    {{--<div class="ui red right ribbon label">预告</div>--}}
                                {{--@elseif ($item->update_status == 2)--}}
                                    {{--<div class="ui blue right ribbon label">更新中</div>--}}
                                {{--@elseif ($item->update_status == 3)--}}
                                    {{--<div class="ui green right ribbon label">已完结</div>--}}
                                {{--@endif--}}
                                <img src="{{ thumb($item->cover_image, 357, 210) }}" style="height: 210px;"/>
                            </a>
                            <div class="content">
                                <a class="center aligned header" href="{{ route('courses.show', $item->slug) }}">{{ $item->name }}</a>
                            </div>
                            <div class="extra content">
                                <a class="time">{{ date('Y-m-d', strtotime($item->created_at)) }}</a>
                                <span class="right floated">
                                    @if ($item->update_status == 1)
                                        <div class="ui orange  label">预告</div>
                                    @elseif ($item->update_status == 2)
                                        <div class="ui blue label">更新中</div>
                                    @elseif ($item->update_status == 3)
                                        <div class="ui green label">已完结</div>
                                    @endif
                                    {{ $item->videos->count() }} 视频
                                </span>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>