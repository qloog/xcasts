@extends('backend.layouts.master')

@section('page_title', '订单管理')

@section('breadcrumb')
    <li><i class="ace-icon fa fa-home home-icon"></i><a href="/admin/dashboard">主页</a></li>
    <li>订单管理</li>
    <li>列表</li>
@endsection

@section('content')

    <div class="row">
        <div class="col-xs-12">

            <div class="box box-success">
                <div class="box-header">
                    <h3 class="box-title">
                        {{--<a href="{{ route('admin.course.create') }}" class="btn btn-sm btn-success"><i class="fa fa-plus"></i>添加系列</a>--}}
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
                            <th>订单号</th>
                            <th>商品信息</th>
                            <th>支付金额</th>
                            <th>购买方式</th>
                            <th>是否支付</th>
                            <th>支付时间</th>
                            <th>订单状态</th>
                            <th>买家uid</th>
                            <th>创建时间</th>
                            <th>更新时间</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($orders as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->goodsInfo }}</td>
                                <td>{{ $item->pay_amount }}</td>
                                <td>{{ $item->pay_method }}</td>
                                <td>{{ $item->is_paid }}</td>
                                <td>{{ $item->paid_at }}</td>
                                <td>{{ $item->status }}</td>
                                <td>{{ $item->user_id }}</td>
                                <td>{{ $item->created_at }}</td>
                                <td>{{ $item->updated_at }}</td>
                                <td>
                                    {{--<div class="hidden-sm hidden-xs action-buttons">--}}
                                        {{--<a href="{{ route('admin.course.edit', [$item->id]) }}">--}}
                                            {{--<i class="fa fa-edit text-green"></i>编辑--}}
                                        {{--</a>--}}
                                    {{--</div>--}}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.box-body -->

                <div class="box-footer">
                    <div class="pull-right">
                        {!! $orders->render() !!}
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

