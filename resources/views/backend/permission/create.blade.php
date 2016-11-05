@extends('backend.layouts.master')

@section('title', '新建权限')

@section('breadcrumb')
    <li>
        <i class="ace-icon fa fa-home home-icon"></i>
        <a href="/admin/dashboard">主页</a>
    </li>
    <li>
        <a>用户管理</a>
    </li>
    <li>
        新建权限
    </li>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">添加权限</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                {!! Form::open(['route' => 'admin.auth.permission.store', 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'post']) !!}
                <div class="box-body">
                    @include('backend.permission._form')
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <a href="{{route('admin.auth.permission.index')}}" class="btn btn-info pull-left "><i class="fa fa-arrow-left"></i> {{ trans('strings.return_button') }}</a>
                    <button type="submit" class="btn btn-success pull-right"><i class='fa fa-save'></i>&nbsp;&nbsp;{{ trans('strings.save_button') }}</button>
                </div>
                <!-- /.box-footer -->
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection

@section('scripts')

@endsection

