@extends('frontend.layouts.master')

@section('content')

    <div class="ui center aligned header basic raised segment">
        <div class="ui buttons">
            <button class="ui active large button">后端</button>
            <button class="ui large button">服务</button>
            <button class="ui large button">前端</button>
            <button class="ui large button">工具</button>
        </div>
    </div>

    <div class="ui inverted container divider"></div>

    <div class="ui container">
        <div class="ui three stackable cards">
            @for($i=0; $i<8; $i++)
                <div class="ui raised link card">
                    <a class="image" href="#link">
                        <img src="http://semantic-ui.com/images/avatar/large/steve.jpg" style="width: 300px; height: 200px;"/>
                    </a>
                    <div class="content">
                        <a class="header" href="#link">Steve Jobes</a>
                        <div class="meta">
                            <a class="time">Last Seen 2 days ago</a>
                            <span class="right floated">3 videos</span>
                        </div>
                    </div>
                </div>
            @endfor
        </div>
    </div>

    <div class="ui center aligned header basic raised segment"></div>

@endsection