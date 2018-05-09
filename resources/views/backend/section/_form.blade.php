<div class="form-group">
    <label for="title" class="col-lg-2 control-label">所属课程:</label>
    <div class="col-lg-6">
        <div class="clearfix">
            {{ $course->name }}
        </div>
    </div>
</div>

<div class="form-group">
    {!! Form::label('title', '名称', ['class' => 'col-lg-2 control-label']) !!}
    <div class="col-lg-6">
        <div class="clearfix">
            <input type="hidden" name="course_id" value="{{ $course->id }}" >
            {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => '名称']) !!}
        </div>
    </div>
</div>

<div class="form-group">
    {!! Form::label('order', '排序', ['class' => 'col-lg-2 control-label']) !!}
    <div class="col-lg-6">
        <div class="clearfix">
            {!! Form::text('order', null, ['class' => 'form-control', 'placeholder' => '1']) !!}
        </div>
    </div>
</div>

@section('scripts')
    <script type="text/javascript">

    </script>
@endsection

