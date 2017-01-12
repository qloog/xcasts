<div class="form-group">
    {!! Form::label('title', '商品名称', ['class' => 'col-lg-2 control-label']) !!}
    <div class="col-lg-6">
        <div class="clearfix">
            {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => '名称']) !!}
        </div>
    </div>
</div>

<div class="form-group">
    {!! Form::label('summary', '商品描述', ['class' => 'col-lg-2 control-label ']) !!}
    <div class="col-lg-6">
        {!! Form::textarea('introduction', null, ['size' => '20x5', 'class' => 'form-control', 'placeholder' => '简单描述']) !!}
    </div>
</div>

<div class="space-4"></div>

<div class="form-group">
    {!! Form::label('views', '商品价格', ['class' => 'col-lg-2 control-label']) !!}
    <div class="col-lg-6">
        {!! Form::text('price', null, ['class' => 'form-control', 'placeholder' => '99.00']) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('views', '促销价格', ['class' => 'col-lg-2 control-label']) !!}
    <div class="col-lg-6">
        {!! Form::text('promotion_price', null, ['class' => 'form-control', 'placeholder' => '69.00']) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('views', '促销时间', ['class' => 'col-lg-2 control-label']) !!}
    <div class="col-lg-3">
        {!! Form::text('promotion_time', null, ['class' => 'form-control', 'id' => 'promotion_time', 'placeholder' => '']) !!}
        {!! Form::hidden('promotion_start', null, ['id' => 'promotion_start']) !!}
        {!! Form::hidden('promotion_end', null, ['id' => 'promotion_end']) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('status', '发布状态', ['class' => 'col-lg-2 control-label']) !!}
    <div class="col-lg-3">
        {!! Form::select('status', ['0' => '草稿', '1' => '已发布'], '1', ['class' => 'form-control']) !!}
    </div>
</div>

@section('styles')
    <!-- date-range-picker -->
    <link rel="stylesheet" href="{{ asset('plugins/daterangepicker/daterangepicker.css') }}">
@endsection

@section('scripts')
    <!-- date-range-picker -->
    <script src="{{ asset('plugins/daterangepicker/moment.min.js') }}"></script>
    <script src="{{ asset('plugins/daterangepicker/daterangepicker.js') }}"></script>
    <script type="text/javascript">
        // date
        $('input[name="promotion_time"]').daterangepicker({
            timePicker: true,
            timePickerIncrement: 5,
            timePicker24Hour: true,
            timePickerSeconds: true,
            autoUpdateInput: false,
            locale: {
                applyLabel: '应用',
                cancelLabel: '清除'
            }
        });

        $('input[name="promotion_time"]').on('apply.daterangepicker', function(ev, picker) {
            $(this).val(picker.startDate.format('YYYY-MM-DD HH:mm:ss') + ' 到 ' + picker.endDate.format('YYYY-MM-DD HH:mm:ss'));
            $('#promotion_start').val(picker.startDate.format('YYYY-MM-DD HH:mm:ss'));
            $('#promotion_end').val(picker.endDate.format('YYYY-MM-DD HH:mm:ss'));
        });

        $('input[name="promotion_time"]').on('cancel.daterangepicker', function(ev, picker) {
            $(this).val('');
        });
    </script>
@endsection

