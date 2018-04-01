    <div class="row">
        <div class="ui three stackable cards">
            @if((isset($courses) && $courses))
            @foreach($courses as $item)
                <div class="ui card">
                    <a class="image" href="{{ route('courses.show', $item->slug) }}">
                        <img src="{{ thumb($item->cover_image) }}" style="width: 357px; height: 210px;"/>
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
