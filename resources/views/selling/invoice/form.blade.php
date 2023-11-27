<div class="row">
    <div class="form-group col-lg-6 mb-3">
        {{ Form::label('صارف') }}
        {{ Form::select('customer_id', customers(), $invoice->customer_id, ['class' => 'form-control select' . ($errors->has('customer_id') ? ' is-invalid' : ''), 'placeholder' => '--منتخب کریں۔--','required']) }}
        {!! $errors->first('customer_id', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="form-group col-lg-6 mb-3">
        {{ Form::label('قسم') }}
        {{ Form::select('type', ['Fancy' => 'فینسی شے', 'Raw' => 'خام'], $invoice->type, ['class' => 'form-control form-select' . ($errors->has('type') ? ' is-invalid' : ''), 'placeholder' => '--منتخب کریں۔--','required']) }}
        {!! $errors->first('type', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="form-group col-lg-6 mb-3">
        {{ Form::label('رسید کی تاریخ') }}
        {{ Form::text('invoice_date', date('m-d-Y', $invoice->invoice_date), ['class' => 'form-control datepicker-autohide' . ($errors->has('invoice_date') ? ' is-invalid' : ''), 'placeholder' => 'رسید کی تاریخ','required']) }}
        {!! $errors->first('invoice_date', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="form-group col-lg-6 mb-3">
        {{ Form::label('اخری تاریخ') }}
        {{ Form::text('due_date', date('m-d-Y', $invoice->due_date), ['class' => 'form-control due_date' . ($errors->has('due_date') ? ' is-invalid' : ''), 'placeholder' => 'اخری تاریخ','required']) }}
        {!! $errors->first('due_date', '<div class="invalid-feedback">:message</div>') !!}
    </div>
	<div class="col-md-12 d-flex justify-content-end align-items-center mt-3">
		<button type="submit" class="btn btn-primary ms-3">
			جمع کرائیں<i class="ph-paper-plane-tilt ms-2"></i>
		</button>
	</div>
</div>