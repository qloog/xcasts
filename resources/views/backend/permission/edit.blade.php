@extends('backend.layouts.master')

@section('title', '编辑权限')

@section('breadcrumb')
    <li><i class="ace-icon fa fa-home home-icon"></i><a href="/admin/dashboard">主页</a></li>
    <li><a>用户管理</a></li>
    <li>编辑角色</li>
@endsection

@section('content')
    <div class="row">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">编辑权限</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    {!! Form::model($permission, ['route' => ['admin.auth.permission.update', $permission->id], 'class' => 'form-horizontal', 'role' => 'form']) !!}
                    {!! Form::hidden('_method', 'PUT') !!}
                    <div class="box-body">
                        @include('backend.permission._form')
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        {{--<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-delete">删除</button>--}}
                        <a href="{{route('admin.auth.permission.index')}}" class="btn btn-info"><i class="fa fa-arrow-left"></i>{{ trans('strings.return_button') }}</a>
                        <button type="submit" class="btn btn-success pull-right"><i class='fa fa-save'></i>&nbsp;&nbsp;{{ trans('strings.save_button') }}</button>
                    </div>
                    <!-- /.box-footer -->
                    {!! Form::close() !!}
                </div>
            </div>
        </div>

        {{-- Confirm Delete --}}
        @include('backend.layouts.partials.delete_modal', array('action' => route('admin.auth.permission.destroy', $permission->id)))
    </div>
@endsection

@section('scripts')

@endsection

