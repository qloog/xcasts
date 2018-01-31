<div class="ui three stackable cards">

    @if((isset($courses) && $courses))
    @foreach($courses as $item)
        <div class="ui raised link card">
            <a class="image" href="{{ route('courses.show', $item->slug) }}">
                <img src="{{ thumb($item->cover_image) }}" style="width: 357px; height: 210px;"/>
            </a>
            <div class="content">
                <a class="header" href="{{ route('courses.show', $item->slug) }}">{{ $item->name }}</a>
                <div class="meta">
                    <a class="time">{{ $item->created_at->diffForHumans() }}</a>
                    <span class="right floated">{{ $item->videos->count() }} 视频</span>
                </div>
            </div>
        </div>
    @endforeach
    @endif
</div>