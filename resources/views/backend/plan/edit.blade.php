@extends('backend.layouts.master')

@section('title', '编辑商品')

@section('breadcrumb')
    <li>
        <i class="ace-icon fa fa-home home-icon"></i>
        <a href="/admin/dashboard">主页</a>
    </li>
    <li>
        <a>商品管理</a>
    </li>
    <li>
        编辑商品
    </li>
@endsection

@section('content')

    <div class="row">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">编辑商品</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    {!! Form::model($plan, ['route' => ['admin.plan.update', $plan->id], 'class' => 'form-horizontal', 'role' => 'form','files' => true]) !!}
                    {!! Form::hidden('_method', 'PUT') !!}

                    <div class="box-body">
                        @include('backend.plan._form')
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <div class="clearfix form-actions">
                            <div class="col-md-offset-3 col-md-10">
                                <button class="btn btn-info" type="submit">
                                    <i class="fa fa-save"></i>
                                    保存
                                </button>

                                <button class="btn" type="reset">
                                    <i class="fa fa-undo"></i>
                                    重置
                                </button>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-footer -->
                    {!! Form::close() !!}
                </div>
            </div>
        </div>

    </div>
@endsection
