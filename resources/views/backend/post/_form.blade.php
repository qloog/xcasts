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