@extends('backend.layouts.master')

@section('title', '管理首页 - 后台')

@section('page_title')
    Dashboard
@stop

@section('breadcrumb')
    <li>
        <a href="{{ url('admin/dashboard') }}">主页</a>
    </li>
    <li>
        <a>仪表盘</a>
    </li>
@endsection

@section('content')
    <!-- Info boxes -->
    <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-aqua"><i class="ion ion-ios-gear-outline"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">总注册用户数</span>
                    <span class="info-box-number">{{ $totalUserCount }}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-red"><i class="fa fa-google-plus"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">总注册用户激活数</span>
                    <span class="info-box-number">{{ $totalActivatedUserCount }}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>

        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-green"><i class="ion ion-ios-cart-outline"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">今日注册用户</span>
                    <span class="info-box-number">{{ $todayRegisteredUserCount }}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-yellow"><i class="ion ion-ios-people-outline"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">今日注册并激活用户</span>
                    <span class="info-box-number">{{ $todayActivatedUserCount }}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-aqua"><i class="ion ion-ios-gear-outline"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">今日登录过的用户</span>
                    <span class="info-box-number">{{ $todayLoginUserCount }}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->

    <!-- Main row -->
    <div class="row">
        <!-- Left col -->
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-7">
                    <!-- TABLE: LATEST ORDERS -->
                    <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title">最新帖子列表Top8</h3>

                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <table class="table no-margin">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>标题</th>
                                        <th>发帖人</th>
                                        <th>回复数</th>
                                        <th>发帖时间</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($lastTopics as $topic)
                                        <tr>
                                            <td><a href="{{ route('topics.show', ['id' => $topic->id]) }}" target="_blank">{{ $topic->id }}</a></td>
                                            <td><a href="{{ route('topics.show', ['id' => $topic->id]) }}" target="_blank">{{ $topic->title }}</a></td>
                                            <td>{{ $topic->user->name }}</td>
                                            <td>
                                                <div class="sparkbar" data-color="#00a65a" data-height="20">
                                                    <canvas width="34" height="20" style="display: inline-block; width: 34px; height: 20px; vertical-align: top;"></canvas>
                                                    {{ $topic->reply_count }}
                                                </div>
                                            </td>
                                            <td>{{ $topic->created_at }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer clearfix">
                            <a href="{{ route('admin.topics.index') }}" class="btn btn-sm btn-default btn-flat pull-right">查看所有帖子</a>
                        </div>
                        <!-- /.box-footer -->
                    </div>
                    <!-- /.box -->
                </div>
                <!-- /.col -->

                <div class="col-md-5">
                    <!-- USERS LIST -->
                    <div class="box box-danger">
                        <div class="box-header with-border">
                            <h3 class="box-title">最新注册用户 top 8</h3>

                            {{--<div class="box-tools pull-right">--}}
                            {{--<span class="label label-danger">8 New Members</span>--}}
                            {{--<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>--}}
                            {{--</button>--}}
                            {{--<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>--}}
                            {{--</button>--}}
                            {{--</div>--}}
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body no-padding" style="display: block;">
                            <ul class="users-list clearfix">
                                @foreach($lastRegisteredUsers as $user)
                                    <li>
                                        <img src="{{ get_avatar_url($user) }}" alt="User Image" width="48px;" height="48px;">
                                        <a class="users-list-name" href="{{ route('user.show', ['id' => $user->id]) }}" target="_blank">{{ $user->name }}</a>
                                        <span class="users-list-date">{{ $user->created_at }}</span>
                                    </li>
                                @endforeach
                            </ul>
                            <!-- /.users-list -->
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer text-center" style="display: block;">
                            <a href="{{ route('admin.admin.user') }}" class="uppercase">查看所有用户</a>
                        </div>
                        <!-- /.box-footer -->
                    </div>
                    <!--/.box -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->

    <!-- Main row -->
    <div class="row">
        <!-- Left col -->
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-7">
                    <!-- TABLE: LATEST ORDERS -->
                    <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title">视频/文章评论列表 Top5</h3>

                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <table class="table no-margin">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>类型</th>
                                        <th>关联id</th>
                                        <th>评论内容</th>
                                        <th>评论人</th>
                                        <th>时间</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($lastComments as $comment)
                                        <tr>
                                            <td>{{ $comment->id }}</td>
                                            <td>{{ $comment->type }}</td>
                                            <td>{{ $comment->relation_id }}</td>
                                            <td>{!! $comment->content !!}</td>
                                            <td>{{ $comment->user->name }}</td>
                                            <td>{{ $comment->created_at }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer clearfix">
                            <a href="{{ route('admin.topics.index') }}" class="btn btn-sm btn-default btn-flat pull-right">查看所有帖子</a>
                        </div>
                        <!-- /.box-footer -->
                    </div>
                    <!-- /.box -->
                </div>
                <!-- /.col -->

                <div class="col-md-5">
                    <!-- TABLE: LATEST ORDERS -->
                    <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title">反馈Top5</h3>

                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <table class="table no-margin">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>反馈内容</th>
                                        <th>反馈者</th>
                                        <th>时间</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($feedbacks as $feedback)
                                        <tr>
                                            <td>{{ $feedback->id }}</td>
                                            <td>{!! $feedback->content !!}</td>
                                            <td>{{ $feedback->user ? $feedback->user->name : '未登录用户' }}</td>
                                            <td>{{ $feedback->created_at }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer clearfix">
                            <a href="{{ route('admin.feedback.index') }}" class="btn btn-sm btn-default btn-flat pull-right">查看所有反馈</a>
                        </div>
                        <!-- /.box-footer -->
                    </div>
                    <!-- /.box -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->

    <!-- Main row -->
    <div class="row">
        <!-- Left col -->
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-7">
                    <!-- TABLE: LATEST ORDERS -->
                    <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title">帖子回复列表Top5</h3>

                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <table class="table no-margin">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>回复内容</th>
                                        <th>所属帖子</th>
                                        <th>回复者</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($lastReplies as $reply)
                                        <tr>
                                            <td>{{ $reply->id }}</td>
                                            <td>{!! $reply->body !!}</td>
                                            <td><a href="{{ route('topics.show', ['id' => $reply->topic_id]) }}" target="_blank">{{ $reply->topic->title }}</a></td>
                                            <td>{{ $topic->user->name }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer clearfix">
                            <a href="{{ route('admin.topics.index') }}" class="btn btn-sm btn-default btn-flat pull-right">查看所有帖子</a>
                        </div>
                        <!-- /.box-footer -->
                    </div>
                    <!-- /.box -->
                </div>
                <!-- /.col -->

            </div>
            <!-- /.row -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
@endsection

