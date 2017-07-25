@extends('backend.layouts.master')

@section('title', '博客管理')

@section('styles')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('plugins/datatables/dataTables.bootstrap.css') }}">
@endsection

@section('page_title')
    文章管理
@endsection

@section('page_description')
    文章列表
@endsection

@section('breadcrumb')
    <li>
        <i class="ace-icon fa fa-home home-icon"></i>
        <a href="/admin/dashboard">主页</a>
    </li>
    <li>
        <a>博客管理</a>
    </li>
    <li>
        文章列表
    </li>
@endsection

@section('content')

    <div class="row">
        <div class="col-xs-12">

            <div class="box box-success">
                <div class="box-header">
                    <h3 class="box-title">
                        <a href="{{ route('admin.post.create') }}" class="btn btn-sm btn-success"><i class="fa fa-plus"></i> 添加文章</a>
                    </h3>
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
                            <th>标题</th>
                            <th>slug</th>
                            <th>摘要</th>
                            <th>状态</th>
                            <th>创建时间</th>
                            <th>更新时间</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($posts as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td><a href="{{ route('blog.show', ['slug' => $item->slug]) }}" target="_blank">{{ $item->title }}</a></td>
                                <td>{{ $item->slug }}</td>
                                <td>{{ $item->summary }}</td>
                                <td>{{ $item->status ? '已发布' : '草稿' }}</td>
                                <td>{{ $item->created_at }}</td>
                                <td>{{ $item->updated_at }}</td>
                                <td>
                                    <div class="hidden-sm hidden-xs action-buttons">
                                        <a href="{{ route('admin.post.edit', [$item->id]) }}">
                                            <i class="fa fa-edit text-green fa-lg"></i>
                                        </a>
                                        <a href="javascript:;" data-id="{{ $item->id }}" class="_delete">
                                            <i class="fa fa-trash-o text-red fa-lg"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.box-body -->

                <div class="box-footer">

                    <div class="pull-right">
                        {!! $posts->render() !!}
                    </div>
                </div>
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->

@endsection

