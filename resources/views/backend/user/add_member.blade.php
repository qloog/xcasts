@extends('backend.layouts.master')

@section('title', '新建用户')

@section('styles')
    <!-- bootstrap datepicker -->
    <link rel="stylesheet" href="{{ asset('plugins/datepicker/datepicker3.css') }}">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('plugins/select2/select2.min.css') }}">
@endsection

@section('breadcrumb')
    <li>
        <i class="ace-icon fa fa-home home-icon"></i>
        <a href="/admin/dashboard">主页</a>
    </li>
    <li>
        <a>用户管理</a>
    </li>
    <li>
        新建用户
    </li>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">开通会员</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                {!! Form::open(['route' => 'admin.user.open_vip', 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'post']) !!}
                <div class="box-body">
                    <div class="form-group">
                        {!! Form::label('name', '用户名', ['class' => 'col-lg-2 control-label']) !!}
                        <div class="col-lg-3">
                            {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => '用户名']) !!}
                        </div>
                    </div><!--form control-->
                    <div class="form-group">
                        {!! Form::label('pay_amount', '应付总金额', ['class' => 'col-lg-2 control-label']) !!}
                        <div class="col-lg-6">
                            {!! Form::text('pay_amount', null, ['class' => 'form-control', 'placeholder' => '应付总金额']) !!}
                        </div>
                    </div><!--form control-->
                    <div class="form-group">
                        {!! Form::label('pay_amount', '订单总金额', ['class' => 'col-lg-2 control-label']) !!}
                        <div class="col-lg-6">
                            {!! Form::text('order_amount', null, ['class' => 'form-control', 'placeholder' => '订单总金额']) !!}
                        </div>
                    </div><!--form control-->
                    <div class="form-group">
                        {!! Form::label('plan_type', '会员类型', ['class' => 'col-lg-2 control-label']) !!}
                        <div class="col-lg-6">
                            <input type="radio" name="plan_type" value="1" checked="">月付
                            <input type="radio" name="plan_type" value="2">季付
                            <input type="radio" name="plan_type" value="3">半年付
                            <input type="radio" name="plan_type" value="4">年付
                        </div>
                    </div><!--form control-->
                    <div class="form-group">
                        {!! Form::label('pay_method', '支付方式', ['class' => 'col-lg-2 control-label']) !!}
                        <div class="col-lg-3">
                            <input type="radio" name="pay_method" id="wepay" value="wechat" checked="checked" class="from-control">微信支付
                            <input type="radio" name="pay_method" id="alipay" value="alipay" class="from-control">支付宝支付
                        </div>
                    </div><!--form control-->
                    <div class="form-group">
                        {!! Form::label('paid_at', '支付时间', ['class' => 'col-lg-2 control-label']) !!}
                        <div class="col-lg-6">
                            {!! Form::text('paid_at', null, ['class' => 'form-control', 'placeholder' => '支付时间','id'=>'datepicker']) !!}
                        </div>
                    </div><!--form control-->
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <a href="{{route('admin.auth.user.index')}}" class="btn btn-info">{{ trans('strings.return_button') }}</a>
                    <input type="submit" class="btn btn-success pull-right" value="{{ trans('strings.save_button') }}" />
                </div>
                <!-- /.box-footer -->
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('plugins/datepicker/bootstrap-datepicker.js') }}"></script>
    <!-- Select2 -->
    <script src="{{ asset('plugins/select2/select2.full.min.js') }}"></script>
    <script>
        $(function () {
            $(".role-select").select2({
                placeholder: "请选择至少一个角色"
            });

            //Date picker
            $('#datepicker').datepicker({
                autoclose: true,
                format: 'yyyy-mm-dd',
                language: 'zh-CN'
            });
        });

    </script>
@endsection

