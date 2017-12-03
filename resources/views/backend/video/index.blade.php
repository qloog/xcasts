@extends('backend.layouts.master')

@section('page_title', '视频管理')

@section('breadcrumb')
    <li><i class="ace-icon fa fa-home home-icon"></i><a href="/admin/dashboard">主页</a></li>
    <li>课程管理</li>
    <li>视频列表</li>
@endsection

@section('content')

    <div class="row">
        <div class="col-xs-12">

            <div class="box box-success">
                <div class="box-header">
                    <h3 class="box-title">
                        <a href="{{ route('admin.video.create') }}" class="btn btn-sm btn-success"><i
                                    class="fa fa-plus"></i>添加课程</a>
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
                            <th>视频名称</th>
                            <th>所属课程</th>
                            <th>长度</th>
                            <th>是否免费</th>
                            <th>发布状态</th>
                            <th>发布时间</th>
                            <th>创建者</th>
                            <th>创建时间</th>
                            <th>更新时间</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(count($videos))
                            @foreach ($videos as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>
                                        <a href="{{ route('video.show',['slug'=>$item->course->slug, 'episodes' => $item->episode_id]) }}"
                                           target="_blank">{{ $item->name }}</a></td>
                                    <td><a href="{{ route('courses.show',['slug'=>$item->course->slug]) }}"
                                           target="_blank">{{ $item->course->name }}</a></td>
                                    <td>{{ $item->length }}</td>
                                    <td>{!! $item->is_free == 1 ? '<span class="label label-success">免费视频</span>' : '<span class="label label-danger">收费</span>' !!} </td>
                                    <td>{!! $item->is_publish == 1 ? '<span class="label label-success">已发布</span>' : '<span class="label label-warning">未发布</span>' !!} </td>
                                    <td>{{ $item->published_at }}</td>
                                    <td>{{ $item->user->name }}</td>
                                    <td>{{ $item->created_at }}</td>
                                    <td>{{ $item->updated_at }}</td>
                                    <td>
                                        <div class="hidden-sm hidden-xs action-buttons">
                                            <a class="green" href="{{ route('admin.video.edit', [$item->id]) }}">
                                                <i class="fa fa-edit text-green"></i>编辑
                                            </a>
                                            <a class="green video-publish" href="javascript:void(0);"
                                               video_id="{{ $item->id }}"
                                               url="{{ route('admin.video.publish', $item->id) }}"
                                            >
                                                <i class="fa fa-edit text-green"></i>发布
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
                        {!! $videos->render() !!}
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

@section('scripts')
    <script type="text/javascript">

        $(function () {
            // 点赞
            $('.video-publish').click(function () {
                var video_id = $(this).attr('video_id');
                if (!video_id) {
                    alert('视频操作错误');
                    return false;
                }

                $.ajax({
                    type: 'POST',
                    url: $(this).attr('url'),
                    data: {'_token': '{{ csrf_token() }}', '_method': 'post'},
                    dataType: 'json',
                    success: function (data) {
                        console.log(data);
                        if (data.ret == 1) {
                            alert('发布成功');
                            window.location.reload();
                        }
                    }
                });
            });
        });
    </script>
@endsection

