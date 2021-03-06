                <div class="form-group">
                    {!! Form::label('title', '标题', ['class' => 'col-lg-2 control-label']) !!}
                    <div class="col-lg-8">
                        {!! Form::text('title', null, ['class' => 'form-control', 'placeholder' => '']) !!}
                    </div>
                </div><!--form control-->

                <div class="form-group">
                    {!! Form::label('slug', 'slug', ['class' => 'col-lg-2 control-label']) !!}
                    <div class="col-lg-8">
                        {!! Form::text('slug', null, ['class' => 'form-control', 'placeholder' => '']) !!}
                    </div>
                </div><!--form control-->

                <div class="form-group">
                    {!! Form::label('summary', '摘要', ['class' => 'col-lg-2 control-label']) !!}
                    <div class="col-lg-8">
                        {!! Form::textarea('summary', null, ['cols' => 100, 'rows' => 5, 'class' => 'form-control', 'placeholder' => '']) !!}
                    </div>
                </div><!--form control-->

                <div class="form-group">
                    {!! Form::label('origin_content', '正文', ['class' => 'col-lg-2 control-label']) !!}
                    <div class="col-lg-8">
                        {!! Form::textarea('origin_content', null, ['cols' => 100, 'rows' => 10, 'class' => 'form-control', 'placeholder' => '']) !!}
                    </div>
                </div><!--form control-->

                <div class="form-group">
                    {!! Form::label('status', '状态', ['class' => 'col-lg-2 control-label']) !!}
                    <div class="col-lg-3">
                        {!! Form::radio('status', 0, false) !!}草稿
                        {!! Form::radio('status', 1) !!}发布
                    </div>
                </div><!--form control-->

                @section('scripts')
                    <!-- iCheck -->
                    <script src="{{ asset('plugins/iCheck/icheck.min.js') }}"></script>
                    <script src="{{ asset('simplemde/simplemde.min.js') }}"></script>
                    <script type="text/javascript">
                        $(document).ready(function () {
                            $('input').iCheck({
                                checkboxClass: 'icheckbox_square-blue',
                                radioClass: 'iradio_square-blue',
                                increaseArea: '20%' // optional
                            });

                            $('.ui.dropdown').dropdown();

                            var simplemde = new SimpleMDE({
                                element: document.getElementById("origin_content"),
                                spellChecker: false,
                                showIcons: ["code", "table"],
                                forceSync: true,
                                promptURLs: true
                            });
                        });
                    </script>
                @endsection