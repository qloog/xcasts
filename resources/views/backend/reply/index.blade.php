@extends('backend.layouts.master')

@section('styles')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('plugins/datatables/dataTables.bootstrap.css') }}">
@endsection

@section('page_title')
    帖子回复管理
@endsection

@section('page_description')
    回复列表
@endsection

@section('breadcrumb')
    <li>
        <i class="ace-icon fa fa-home home-icon"></i>
        <a href="/admin/dashboard">主页</a>
    </li>
    <li>
        <a>回复管理</a>
    </li>
    <li>
        列表
    </li>
@endsection

@section('content')

    <div class="row">
        <div class="col-xs-12">

            <div class="box box-success">
                <div class="box-header">
                    <div class="box-tools">
                        <!--
                        <div class="form-inline  pull-right">
                            <form action="" method="get">
                                <fieldset>
                                    <div class="input-group input-group-sm">
                                        <span class="input-group-addon"><strong>Id</strong></span>
                                        <input type="text" class="form-control" placeholder="Id" name="id" value="">
                                    </div>
                                    <div class="input-group input-group-sm">
                                        <span class="input-group-addon"><strong>用户名</strong></span>
                                        <input type="text" class="form-control" placeholder="用户名" name="name" value="">
                                    </div>
                                    <div class="input-group input-group-sm">
                                        <span class="input-group-addon"><strong>邮箱</strong></span>
                                        <input type="text" class="form-control" placeholder="邮箱" name="email" value="">
                                    </div>
                                    <div class="input-group input-group-sm">
                                        <div class="input-group-btn">
                                            <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
                                        </div>
                                    </div>
                                </fieldset>
                            </form>
                        </div>
                        -->

                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="user-table" class="table table-striped table-hover">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>关联内容标题</th>
                            <th>评论内容</th>
                            <th>评论人</th>
                            <th>投票数</th>
                            <th>创建时间</th>
                            <th>更新时间</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($replies as $item)
                            <tr>
                                <th>{{ $item->id }}</th>
                                <th>{{ $item->topic->title }}</th>
                                <th>{!! $item->body !!}</th>
                                <th>{{ $item->user['name'] }}</th>
                                <th>{{ $item->vote_count }}</th>
                                <th>{{ $item->created_at }}</th>
                                <th>{{ $item->updated_at }}</th>
                                <th>
                                    <div class="hidden-sm hidden-xs action-buttons">
                                        <a class="orange" href="{{ url('admin/comment/'.$item->id.'/edit') }}">
                                            <i class="ace-icon fa fa-ban bigger"></i>屏蔽
                                        </a>
                                        <a class="info" href="{{ url('admin/comment/'.$item->id.'/edit') }}">
                                            <i class="ace-icon fa fa-reply bigger"></i>回复
                                        </a>
                                        <a class="red" href="{{ url('admin/comment/'.$item->id.'/edit') }}">
                                            <i class="ace-icon fa fa-trash-o bigger"></i>删除
                                        </a>
                                    </div>
                                </th>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.box-body -->

                <div class="box-footer">
                    <div class="pull-right">
                        {!! $replies->render() !!}
                    </div>
                </div>
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->

@endsection
