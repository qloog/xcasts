    <div class="row">
        <div class="column">
            <div class="ui three stackable special cards">
                @if((isset($courses) && $courses))
                    @foreach($courses as $item)
                        <div class="ui raised link card">
                            <a class="ui image" href="{{ route('courses.show', $item->slug) }}">
                                @if ($item->is_publish == 2)
                                <div class="ui red ribbon label">预告</div>
                                @endif
                                <img src="{{ thumb($item->cover_image, 357, 210) }}" style="height: 210px;"/>
                            </a>
                            <div class="content">
                                <a class="center aligned header" href="{{ route('courses.show', $item->slug) }}">{{ $item->name }}</a>
                            </div>
                            <div class="extra content">
                                <a class="time">{{ date('Y-m-d', strtotime($item->created_at)) }}</a>
                                <span class="right floated">{{ $item->videos->count() }} 视频</span>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>