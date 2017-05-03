@extends('frontend.layouts.master')

@section('title')
    订阅
@endsection

@section('content')
    <div class="ui grid">
        <div class="row"></div>
        <div class="row"></div>
    </div>

    <div class="ui container">
        <div class="ui header center aligned">订阅，观看更多视频</div>
        <div class="ui cards four">
            <div class="ui card">
                <div class="content">
                    <div class="header center aligned">按月付</div>
                    <div class="meta center aligned">free and unlimited</div>
                    <div class="ui divider horizontal"><h1 class="ui teal header">59</h1></div>
                    <div class="ui list">
                        <div class="item"><i class="icon checkmark"></i> <div class="content">
                                Do things
                            </div></div>
                        <div class="item"><i class="icon checkmark"></i> <div class="content">
                                <b>25.000</b> of stuff
                            </div></div>
                        <div class="item"><i class="icon checkmark"></i> <div class="content">
                                <b>30</b> days of history
                            </div></div>
                        <div class="item"><i class="icon checkmark"></i> <div class="content">
                                <b>20</b> is just a number
                            </div></div>
                        <div class="item"><i class="icon checkmark"></i> <div class="content">
                                <b>15</b> is another number
                            </div></div>
                        <div class="item"><i class="icon minus"></i> <div class="content">
                                <b>Default</b> Server
                                <br><small>(50 Petaflops/s)</small>
                            </div></div>
                    </div>
                </div>
                <div class="extra content">
                    <button class="ui button fluid teal">Default</button>
                </div>
            </div>
            <div class="ui card">
                <div class="content">
                    {{--<a class="ui label left corner teal">--}}
                        {{--<i class="icon plus"></i>--}}
                    {{--</a>--}}
                    <div class="header center aligned">按季付</div>
                    <div class="meta center aligned">prio ressources</div>
                    <div class="ui divider horizontal"><h1 class="ui teal header">169</h1></div>
                    <div class="ui list">
                        <div class="item"><i class="icon checkmark blue"></i> <div class="content">
                                Do <b>all</b> things
                            </div></div>
                        <div class="item"><i class="icon checkmark blue"></i> <div class="content">
                                <b>60.000</b> of stuff
                            </div></div>
                        <div class="item"><i class="icon checkmark blue"></i> <div class="content">
                                <b>120</b> days of history
                            </div></div>
                        <div class="item"><i class="icon checkmark blue"></i> <div class="content">
                                <b>100</b> is just a number
                            </div></div>
                        <div class="item"><i class="icon checkmark blue"></i> <div class="content">
                                <b>60</b> is another number
                            </div></div>
                        <div class="item"><i class="icon checkmark blue"></i> <div class="content">
                                <b>Awesome</b> Server
                                <br><small>(50 Petaflops/s)</small>
                            </div></div>
                        <div class="item"><i class="icon checkmark blue"></i> <div class="content">
                                <b>Support</b> the development
                            </div></div>
                    </div>
                </div>
                <div class="extra content">
                    <button class="ui button fluid teal">Order now</button>
                </div>
            </div>
            <div class="ui card">
                <div class="content">
                    <div class="header center aligned">半年付</div>
                    <div class="meta center aligned">free and unlimited</div>
                    <div class="ui divider horizontal"><h1 class="ui teal header">299</h1></div>
                    <div class="ui list">
                        <div class="item"><i class="icon checkmark"></i> <div class="content">
                                Do things
                            </div></div>
                        <div class="item"><i class="icon checkmark"></i> <div class="content">
                                <b>25.000</b> of stuff
                            </div></div>
                        <div class="item"><i class="icon checkmark"></i> <div class="content">
                                <b>30</b> days of history
                            </div></div>
                        <div class="item"><i class="icon checkmark"></i> <div class="content">
                                <b>20</b> is just a number
                            </div></div>
                        <div class="item"><i class="icon checkmark"></i> <div class="content">
                                <b>15</b> is another number
                            </div></div>
                        <div class="item"><i class="icon minus"></i> <div class="content">
                                <b>Default</b> Server
                                <br><small>(50 Petaflops/s)</small>
                            </div></div>
                    </div>
                </div>
                <div class="extra content">
                    <button class="ui button fluid teal">Default</button>
                </div>
            </div>
            <div class="ui card">
                <div class="content">
                    <div class="header center aligned">按年付</div>
                    <div class="meta center aligned">prio ressources</div>
                    <div class="ui divider horizontal"><h1 class="ui teal header">599</h1></div>
                    <div class="ui list">
                        <div class="item"><i class="icon checkmark blue"></i> <div class="content">
                                Do <b>all</b> things
                            </div></div>
                        <div class="item"><i class="icon checkmark blue"></i> <div class="content">
                                <b>60.000</b> of stuff
                            </div></div>
                        <div class="item"><i class="icon checkmark blue"></i> <div class="content">
                                <b>120</b> days of history
                            </div></div>
                        <div class="item"><i class="icon checkmark blue"></i> <div class="content">
                                <b>100</b> is just a number
                            </div></div>
                        <div class="item"><i class="icon checkmark blue"></i> <div class="content">
                                <b>60</b> is another number
                            </div></div>
                        <div class="item"><i class="icon checkmark blue"></i> <div class="content">
                                <b>Awesome</b> Server
                                <br><small>(50 Petaflops/s)</small>
                            </div></div>
                        <div class="item"><i class="icon checkmark blue"></i> <div class="content">
                                <b>Support</b> the development
                            </div></div>
                    </div>
                </div>
                <div class="extra content">
                    <button class="ui button fluid teal">Order now</button>
                </div>
            </div>
        </div>
    </div>

    <div class="ui grid">
        <div class="row"></div>
        <div class="row"></div>
    </div>
@endsection