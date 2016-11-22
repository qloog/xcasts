<div class="ui three stackable cards">

    @for($i=0; $i<8; $i++)
        <div class="ui raised link card">
            <a class="image" href="#link">
                <img src="http://semantic-ui.com/images/avatar/large/steve.jpg" style="width: 357px; height: 210px;"/>
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