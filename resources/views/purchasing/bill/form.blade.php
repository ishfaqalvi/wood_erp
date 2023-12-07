<div class="row">
    <div class="form-group col-lg-4">
        {{ Form::label('فروش') }}
        {{ Form::select('vendor_id', vendors(), $bill->vendor_id, ['class' => 'form-control select' . ($errors->has('vendor_id') ? ' is-invalid' : ''), 'placeholder' => '--منتخب کریں۔--','required']) }}
        {!! $errors->first('vendor_id', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="form-group col-lg-4">
        {{ Form::label('بل کی تاریخ') }}
        {{ Form::text('bill_date', date('m-d-Y', $bill->bill_date), ['class' => 'form-control datepicker-autohide' . ($errors->has('bill_date') ? ' is-invalid' : ''), 'placeholder' => 'بل کی تاریخ','required']) }}
        {!! $errors->first('bill_date', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="form-group col-lg-4">
        {{ Form::label('رعایت ') }}
        {{ Form::number('concession', $bill->concession, ['class' => 'form-control' . ($errors->has('concession') ? ' is-invalid' : ''), 'placeholder' => 'رعایت  ','min' => '0','required']) }}
        {!! $errors->first('concession', '<div class="invalid-feedback">:message</div>') !!}
    </div>
	<div class="col-md-12 d-flex justify-content-end align-items-center mt-3">
		<button type="submit" class="btn btn-primary ms-3">
			جمع کرائیں<i class="ph-paper-plane-tilt ms-2"></i>
		</button>
	</div>
</div>