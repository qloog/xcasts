<div class="ui three stackable cards">

    @if((isset($courses) && $courses))
    @foreach($courses as $course)
        <div class="ui raised link card">
            <a class="image" href="{{ route('course.show', $course->id) }}">
                <img src="http://semantic-ui.com/images/avatar/large/steve.jpg" style="width: 357px; height: 210px;"/>
            </a>
            <div class="content">
                <a class="header" href="{{ route('course.show', $course->id) }}">{{ $course->name }}</a>
                <div class="meta">
                    <a class="time">{{ $course->created_at->diffForHumans() }}</a>
                    <span class="right floated">{{ $course->videos->count() }} 视频</span>
                </div>
            </div>
        </div>
    @endforeach
    @endif
</div>