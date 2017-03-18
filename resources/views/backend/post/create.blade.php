@extends('backend.layouts.master')

@section('title', '新建文章')

@section('styles')
  <!-- iCheck -->
  <link rel="stylesheet" href="{{ asset('plugins/iCheck/square/blue.css') }}">
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
    新建文章
  </li>
@endsection

@section('content')
  <div class="row">
    <div class="col-md-12">
      <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title">添加文章</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        {!! Form::open(['route' => 'admin.post.store', 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'post']) !!}
        <div class="box-body">
          @include('backend.post._form')
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
          <a href="{{route('admin.post.index')}}" class="btn btn-info pull-left "><i class="fa fa-arrow-left"></i> {{ trans('strings.return_button') }}</a>
          <button type="submit" class="btn btn-success pull-right"><i class='fa fa-save'></i>&nbsp;&nbsp;{{ trans('strings.save_button') }}</button>
        </div>
        <!-- /.box-footer -->
        {!! Form::close() !!}
      </div>
    </div>
  </div>
@endsection

@section('scripts')
  <!-- iCheck -->
  <script src="{{ asset('plugins/iCheck/icheck.min.js') }}"></script>
  <script>

      $(function () {
          $('input').iCheck({
              checkboxClass: 'icheckbox_square-blue',
              radioClass: 'iradio_square-blue',
              increaseArea: '20%' // optional
          });
      });
  </script>
@endsection

