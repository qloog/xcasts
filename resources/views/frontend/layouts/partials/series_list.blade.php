<div class="ui three stackable cards">

    @if((isset($series) && $series))
    @foreach($series as $item)
        <div class="ui raised link card">
            <a class="image" href="{{ route('series.show', $item->id) }}">
                <img src="{{ $item->cover_image }}" style="width: 357px; height: 210px;"/>
            </a>
            <div class="content">
                <a class="header" href="{{ route('series.show', $item->id) }}">{{ $item->name }}</a>
                <div class="meta">
                    <a class="time">{{ $item->created_at->diffForHumans() }}</a>
                    <span class="right floated">{{ $item->lessons->count() }} 视频</span>
                </div>
            </div>
        </div>
    @endforeach
    @endif
</div>