@extends('frontend.layouts.master')

@section('content')
    <div class="ui grid">
        <div class="row"></div>
        <div class="row">
            <div class="thirteen wide column centered">
                <div class="ui card">
                    <div class="content">
                        <div class="header">半年付</div>
                    </div>
                    <div class="content">
                        <div class="ui small feed">
                            <div class="event">
                                <div class="content">
                                    <div class="summary">
                                        366元/半年
                                    </div>
                                </div>
                            </div>
                            <div class="event">
                                <div class="content">
                                    <div class="summary">
                                        半年适合我
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="extra content">
                        <button class="ui button">去支付宝付款</button>
                    </div>
                </div>

                <div class="ui card">
                    <div class="content">
                        <div class="header">Project Timeline</div>
                    </div>
                    <div class="content">
                        <h4 class="ui sub header">Activity</h4>
                        <div class="ui small feed">
                            <div class="event">
                                <div class="content">
                                    <div class="summary">
                                        <a>Elliot Fu</a> added <a>Jenny Hess</a> to the project
                                    </div>
                                </div>
                            </div>
                            <div class="event">
                                <div class="content">
                                    <div class="summary">
                                        <a>Stevie Feliciano</a> was added as an <a>Administrator</a>
                                    </div>
                                </div>
                            </div>
                            <div class="event">
                                <div class="content">
                                    <div class="summary">
                                        <a>Helen Troy</a> added two pictures
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="extra content">
                        <button class="ui button">Join Project</button>
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection