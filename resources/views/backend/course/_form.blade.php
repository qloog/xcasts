                <div class="form-group">
                    {!! Form::label('name', '系列名称', ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-5">
                        <div class="clearfix">
                            {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => '']) !!}
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('name', 'slug', ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-5">
                        <div class="clearfix">
                            {!! Form::text('slug', null, ['class' => 'form-control', 'placeholder' => 'slug']) !!}
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('description', '系列描述', ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-5">
                        <div class="clearfix">
                            {!! Form::textarea('description', null, ['class' => 'form-control', 'placeholder' => '系列描述']) !!}
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('cover_image', '封面图', ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-5">
                        <div class="clearfix">
                            <input type="file" name="file" id="file"  class="form-control" />
                            <input type="hidden" name="cover_image" id="cover_image" value="{!! isset($album->cover_image) ? $album->cover_image : '' !!}" />
                        </div>
                    </div>
                </div>


@section('styles')
    <link rel="stylesheet" href="{{ asset('plugins/bootstrap-fileinput/css/fileinput.min.css') }}">
@endsection

@section('scripts')
    <script src="{{ asset('plugins/bootstrap-fileinput/js/plugins/canvas-to-blob.min.js') }}"></script>
    <script src="{{ asset('plugins/bootstrap-fileinput/js/fileinput.min.js') }}"></script>
    <script src="{{ asset('plugins/bootstrap-fileinput/js/locales/zh.js') }}"></script>

    <script type="text/javascript">
        $(function () {
            var page_img = '{!! isset($course->cover_image) ? $course->cover_image : '' !!}';

            $('#file').fileinput({
                language: 'zh',
                uploadUrl: "/admin/upload/image",
                uploadExtraData: {_token: '{{ csrf_token() }}'},
                initialCaption: "请选择一张封面图",
                allowedFileExtensions: ["jpg", "jpeg", "png", "gif"],
                maxFilePreviewSize: 10240,
                @if(isset($course->cover_image))
                initialPreview: [
                    "<img src=" + page_img + " class='file-preview-image' width='200px'/>",
                ],
                @endif
            }).on('fileuploaded', function (event, data, previewId, index) {
                var response = data.response;
                $('#cover_image').val(response.data.image_path);
            });
        });
    </script>
@endsection