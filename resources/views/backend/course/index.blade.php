@extends('backend.layouts.master')

@section('title', '课程管理')

@section('breadcrumb')
    <li><i class="ace-icon fa fa-home home-icon"></i><a href="/admin/dashboard">主页</a></li>
    <li>课程管理</li>
    <li>列表</li>
@endsection

@section('content')

    <div class="row">
        <div class="col-xs-12">

            <div class="box box-success">
                <div class="box-header">
                    <h3 class="box-title">
                        <a href="{{ route('admin.course.create') }}" class="btn btn-sm btn-success"><i class="fa fa-plus"></i>添加课程</a>
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
                            <th>id</th>
                            <th>名称</th>
                            <th>分类</th>
                            <th>封面</th>
                            <th>slug</th>
                            <th>是否发布</th>
                            <th>创建者</th>
                            <th>创建时间</th>
                            <th>更新时间</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($courses as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->type }}</td>
                                <td><img src="{{ $item->cover_image ? thumb($item->cover_image, 100, 67) : thumb('/blog-default-post-cover.jpeg', 100, 67) }}" width="100px"></td>
                                <td>{{ $item->slug }}</td>
                                <td>{!! $item->is_publish ? '<span class="label label-success">已发布</span>' : '<span class="label label-warning">未发布</span>' !!}</td>
                                <td>{{ $item->user_id }}</td>
                                <td>{{ $item->created_at }}</td>
                                <td>{{ $item->updated_at }}</td>
                                <td>
                                    <div class="hidden-sm hidden-xs action-buttons">
                                        <a href="{{ route('admin.course.edit', [$item->id]) }}">
                                            <i class="fa fa-edit text-green"></i>编辑
                                        </a>
                                    </div>
                                    <div class="hidden-sm hidden-xs action-buttons">
                                        <a href="{{ route('admin.section.index', ['course_id' => $item->id]) }}">
                                            <i class="fa fa-list"></i>管理section
                                        </a>
                                    </div>
                                    <div class="hidden-sm hidden-xs action-buttons">
                                        <a href="{{ route('admin.video.index', ['course_id' => $item->id]) }}">
                                            <i class="fa fa-file-video-o text-orange"></i>管理视频
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
                        {!! $courses->render() !!}
                    </div>
                </div>
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->

    <div class="clearfix"></div>
@endsection

