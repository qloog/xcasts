@extends('frontend.layouts.master')

@section('styles')
    <link href="{{ asset('css/github-markdown.css') }}" rel="stylesheet">
    <style type="text/css">
        .ui.comments { max-width: 100%!important}
    </style>
@stop

@section('content')
    <div class="ui grid">
        <div class="row"></div>
        <div class="row">
            <div class="thirteen wide column centered">
                <div class="ui grid">
                    <div class="four wide column">
                        <div class="ui centered segment">
                            <div class="ui massive horizontal divided list">
                                <div class="item">
                                    <img class="ui avatar image" src="http://semantic-ui.com/images/avatar/small/helen.jpg">
                                    <div class="content">
                                        <div class="header">Helen</div>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="ui list">
                                    <div class="item">第 1097 位会员</div>
                                    <div class="item">注册于 2年前</div>
                                    <div class="item">活跃于 2天前</div>
                                </div>
                            </div>
                            <div class="ui divider"></div>
                            <div class="ui small statistics">
                                <div class="teal statistic">
                                    <a class="value" href="#">
                                        14
                                    </a>
                                    <div class="label">
                                        关注者
                                    </div>
                                </div>
                                <div class="teal statistic">
                                    <a class="value" href="#">
                                        82
                                    </a>
                                    <div class="label">
                                        评论
                                    </div>
                                </div>
                                <div class="teal statistic">
                                    <a class="value" href="#">
                                        82
                                    </a>
                                    <div class="label">
                                        话题
                                    </div>
                                </div>
                            </div>
                            <div class="ui divider"></div>
                            <a class="ui fluid teal button"><i class="edit icon"></i> 编辑个人资料 </a>
                        </div>

                        <div class="ui centered segment">
                            <div class="ui divided very relaxed large list">
                                <a class="item"><i class="write icon"></i> 发布的话题</a>
                                <a class="item"><i class="comment icon"></i> 发表的回复</a>
                                <a class="item"><i class="unhide icon"></i> 关注的用户</a>
                                <a class="item"><i class="thumbs up icon"></i> 赞过的话题</a>
                            </div>
                        </div>
                    </div>
                    <div class="twelve wide column">
                        <!-- detail -->
                        <div class="ui secondary segment">
                            <h4>最近话题</h4>
                        </div>
                        <div class="ui large middle aligned divided relaxed list padded segment" style="margin-top: -18px;">
                            <div class="markdown-body">
                               body
                            </div>
                        </div>
                        <!-- detail -->
                        <div class="ui secondary segment">
                            <h4>最新评论</h4>
                        </div>
                        <div class="ui large middle aligned divided relaxed list padded segment" style="margin-top: -18px;">
                            <div class="markdown-body">
                                body
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