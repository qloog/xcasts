@extends('backend.layouts.master')

@section('page_title', '七牛文件管理')

@section('breadcrumb')
    <li><i class="ace-icon fa fa-home home-icon"></i><a href="/admin/dashboard">主页</a></li>
    <li>七牛管理</li>
    <li>列表</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-xs-12">

            <div class="box box-success">
                <div class="box-header">
                    <h3 class="box-title">
                        <a href="{{ route('admin.album.create') }}" class="btn btn-sm btn-success"><i class="fa fa-plus"></i>上传文件</a>
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
                            <th>hash</th>
                            <th>图片</th>
                            <th>size</th>
                            <th>mimeType</th>
                            <th>上传时间</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(count($files))
                        @foreach ($files as $file)
                            <tr>
                                <td>{{ $file['hash'] }}</td>
                                <td><img src="{{ $file['key'] }}" width="80px"/></td>
                                <td>{{ $file['fsize'] }}</td>
                                <td>{{ $file['mimeType'] }}</td>
                                <td>{{ $file['putTime'] }}</td>
                                <td>
                                    <div class="hidden-sm hidden-xs action-buttons">
                                        <a class="green" href="{{ route('admin.album.edit', [$file['hash']]) }}">
                                            <i class="fa fa-edit text-green"></i>下载
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>
                <!-- /.box-body -->

                <div class="box-footer">
                    <div class="pull-right">
                        {{--{!! $files && $files->render() !!}--}}
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