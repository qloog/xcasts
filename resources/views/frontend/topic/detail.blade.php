@extends('frontend.layouts.master')

@section('content')
    <div class="ui grid">
        <div class="row"></div>
        <div class="row">
            <div class="thirteen wide column centered">
                <div class="ui grid">
                    <div class="twelve wide column">
                        <!-- detail -->
                        <div class="ui large middle aligned divided relaxed list padded segment">
                            <h2>Second Header</h2>
                            <div class="ui divider"></div>

                            {!! $topic->body !!}
                        </div>

                        <!-- votes -->
                        <div class="ui large center aligned divided relaxed list padded segment">
                            <div class="ui buttons">
                                <button class="ui teal button" data-inverted=""
                                        data-tooltip="点赞相当于收藏，可以在个人页面的「赞过的话题」导航里查看"
                                        data-position="top center">
                                    <i class="thumbs up white icon"></i>点赞
                                </button>
                                <div class="or"></div>
                                <button class="ui yellow button" data-inverted=""
                                        data-tooltip="如果觉得我的文章对您有用，请随意打赏。你的支持将鼓励我继续创作！可以修改个人资料「支付二维码」开启打赏功能。"
                                        data-position="top center">
                                    <i class="heart white icon"></i>打赏
                                </button>
                            </div>

                            <p></p>
                            <div >
                                @for($i=0;$i<30;$i++)
                                <img class="ui avatar image" src="http://semantic-ui.com/images/avatar/small/matt.jpg" style="width: 40px;height: 40px;"/>
                                <img class="ui  avatar image" src="http://semantic-ui.com/images/avatar/small/elliot.jpg" style="width: 40px;height: 40px;"/>
                                <img class="ui  avatar image" src="http://semantic-ui.com/images/avatar/small/helen.jpg" style="width: 40px;height: 40px;"/>
                                <img class="ui  avatar image" src="http://semantic-ui.com/images/avatar/small/jenny.jpg" style="width: 40px;height: 40px;"/>
                                <img class="ui  avatar image" src="http://semantic-ui.com/images/avatar/small/joe.jpg" style="width: 40px;height: 40px;"/>
                                @endfor
                            </div>
                        </div>

                        <!-- comments -->
                        <div class="ui large middle aligned divided relaxed list padded segment">
                            <h3 class="ui dividing header">回复数量: 10</h3>

                            <div class="ui minimal comments">
                                @for($i=0; $i<20; $i++)
                                <div class="comment">
                                    <a class="avatar">
                                        <img src="http://semantic-ui.com/images/avatar/small/matt.jpg">
                                    </a>
                                    <div class="content">
                                        <a class="author teal">Joe Henderson</a>
                                        <div class="metadata">
                                            <div class="date">
                                                1 day ago
                                            </div>
                                        </div>
                                        <div class="text">
                                            <p>The hours, minutes and seconds stand as visible reminders that your effort put them all there. </p>
                                            <p>Preserve until your next run, when the watch lets you see how Impermanent your efforts are.</p>
                                        </div>
                                        <div class="actions">
                                            <a class="reply"><i class="thumbs outline up icon"></i></a>
                                            <a class="reply"><i class="reply icon"></i></a>
                                        </div>
                                    </div>
                                </div>
                                @endfor
                            </div>
                        </div>

                        <div class="ui large middle aligned divided relaxed list">
                            <form class="ui reply form">
                                <div class="field">
                                    <textarea placeholder="请使用Markdown语法编写 :)"></textarea>
                                </div>
                                <div class="ui teal submit labeled icon button">
                                    <i class="icon edit"></i> 回复
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="four wide column">
                        <div class="ui card">
                            <div class="image">
                                <img src="/images/avatar2/large/kristy.png">
                            </div>
                            <div class="content">
                                <a class="header">Kristy</a>
                                <div class="meta">
                                    <span class="date">Joined in 2013</span>
                                </div>
                                <div class="description">
                                    Kristy is an art director living in New York.
                                </div>
                            </div>
                            <div class="extra content">
                                <a>
                                    <i class="user icon"></i>
                                    22 Friends
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row"></div>
    </div>

@endsection

@section('scripts')
    <script type="text/javascript">
        $(document).ready(function () {
            $('.ui.dropdown').dropdown();

            $('.button').popup();
        });
    </script>
@endsection