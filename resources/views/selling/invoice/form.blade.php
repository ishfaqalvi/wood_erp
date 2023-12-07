<div class="row">
    @if($invoice->status != 'Posted')
    <div class="form-group col-lg-6 mb-3">
        {{ Form::label('صارف') }}
        {{ Form::select('customer_id', customers(), $invoice->customer_id, ['class' => 'form-control select' . ($errors->has('customer_id') ? ' is-invalid' : ''), 'placeholder' => '--منتخب کریں۔--','required']) }}
        {!! $errors->first('customer_id', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="form-group col-lg-6 mb-3">
        {{ Form::label('گودام') }}
        {{ Form::select('warehouse_id', warehouses(), $invoice->warehouse_id, ['class' => 'form-control select' . ($errors->has('warehouse_id') ? ' is-invalid' : ''), 'placeholder' => '--منتخب کریں۔--','required']) }}
        {!! $errors->first('warehouse_id', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="form-group col-lg-6 mb-3">
        {{ Form::label('قسم') }}
        {{ Form::select('type', ['Fancy' => 'فینسی شے', 'Raw' => 'خام'], $invoice->type, ['class' => 'form-control form-select' . ($errors->has('type') ? ' is-invalid' : ''), 'placeholder' => '--منتخب کریں۔--','required']) }}
        {!! $errors->first('type', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    @endif
    <div class="form-group col-lg-6 mb-3">
        {{ Form::label('رسید کی تاریخ') }}
        {{ Form::text('invoice_date', date('m-d-Y', $invoice->invoice_date), ['class' => 'form-control datepicker-autohide' . ($errors->has('invoice_date') ? ' is-invalid' : ''), 'placeholder' => 'رسید کی تاریخ','required']) }}
        {!! $errors->first('invoice_date', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="form-group col-lg-6 mb-3">
        {{ Form::label('بلٹی نمبر') }}
        {{ Form::text('bilti_number', $invoice->bilti_number, ['class' => 'form-control datepicker-autohide' . ($errors->has('bilti_number') ? ' is-invalid' : ''), 'placeholder' => 'بلٹی نمبر  ']) }}
        {!! $errors->first('bilti_number', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="form-group col-lg-6 mb-3">
        {{ Form::label('گڈذ نام  ') }}
        {{ Form::text('goods_name', $invoice->goods_name, ['class' => 'form-control' . ($errors->has('goods_name') ? ' is-invalid' : ''), 'placeholder' => 'گڈذ نام  ']) }}
        {!! $errors->first('goods_name', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    @if($invoice->status != 'Posted')
    <div class="form-group col-lg-6">
        {{ Form::label('رعایت ') }}
        {{ Form::number('concession', $invoice->concession, ['class' => 'form-control' . ($errors->has('concession') ? ' is-invalid' : ''), 'placeholder' => 'رعایت  ','min' => '0','required']) }}
        {!! $errors->first('concession', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    @endif
	<div class="col-md-12 d-flex justify-content-end align-items-center mt-3">
		<button type="submit" class="btn btn-primary ms-3">
			جمع کرائیں<i class="ph-paper-plane-tilt ms-2"></i>
		</button>
	</div>
</div>