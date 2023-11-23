<div class="row">
    <div class="form-group col-lg-6 mb-3">
        {{ Form::label('customer') }}
        {{ Form::select('customer_id', customers(), $invoice->customer_id, ['class' => 'form-control select' . ($errors->has('customer_id') ? ' is-invalid' : ''), 'placeholder' => '--Select--','required']) }}
        {!! $errors->first('customer_id', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="form-group col-lg-6 mb-3">
        {{ Form::label('type') }}
        {{ Form::select('type', ['Fancy' => 'Fancy', 'Raw' => 'Raw'], $invoice->type, ['class' => 'form-control form-select' . ($errors->has('type') ? ' is-invalid' : ''), 'placeholder' => '--Select--','required']) }}
        {!! $errors->first('type', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="form-group col-lg-6 mb-3">
        {{ Form::label('invoice_date') }}
        {{ Form::text('invoice_date', $invoice->invoice_date, ['class' => 'form-control datepicker-autohide' . ($errors->has('invoice_date') ? ' is-invalid' : ''), 'placeholder' => 'Invoice Date','required']) }}
        {!! $errors->first('invoice_date', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="form-group col-lg-6 mb-3">
        {{ Form::label('due_date') }}
        {{ Form::text('due_date', $invoice->due_date, ['class' => 'form-control due_date' . ($errors->has('due_date') ? ' is-invalid' : ''), 'placeholder' => 'Due Date','required']) }}
        {!! $errors->first('due_date', '<div class="invalid-feedback">:message</div>') !!}
    </div>
	<div class="col-md-12 d-flex justify-content-end align-items-center mt-3">
		<button type="submit" class="btn btn-primary ms-3">
			Submit <i class="ph-paper-plane-tilt ms-2"></i>
		</button>
	</div>
</div>