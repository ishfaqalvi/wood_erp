<div class="row">
	
    <div class="form-group col-lg-6 mb-3">
        {{ Form::label('purchase_item_id') }}
        {{ Form::text('purchase_item_id', $purchaseStock->purchase_item_id, ['class' => 'form-control' . ($errors->has('purchase_item_id') ? ' is-invalid' : ''), 'placeholder' => 'Purchase Item Id','required']) }}
        {!! $errors->first('purchase_item_id', '<div class="invalid-feedback">:message</div>') !!}
    </div>    <div class="form-group col-lg-6 mb-3">
        {{ Form::label('type') }}
        {{ Form::text('type', $purchaseStock->type, ['class' => 'form-control' . ($errors->has('type') ? ' is-invalid' : ''), 'placeholder' => 'Type','required']) }}
        {!! $errors->first('type', '<div class="invalid-feedback">:message</div>') !!}
    </div>    <div class="form-group col-lg-6 mb-3">
        {{ Form::label('date') }}
        {{ Form::text('date', $purchaseStock->date, ['class' => 'form-control' . ($errors->has('date') ? ' is-invalid' : ''), 'placeholder' => 'Date','required']) }}
        {!! $errors->first('date', '<div class="invalid-feedback">:message</div>') !!}
    </div>    <div class="form-group col-lg-6 mb-3">
        {{ Form::label('quantity') }}
        {{ Form::text('quantity', $purchaseStock->quantity, ['class' => 'form-control' . ($errors->has('quantity') ? ' is-invalid' : ''), 'placeholder' => 'Quantity','required']) }}
        {!! $errors->first('quantity', '<div class="invalid-feedback">:message</div>') !!}
    </div>
	<div class="col-md-12 d-flex justify-content-end align-items-center mt-3">
		<button type="submit" class="btn btn-primary ms-3">
			Submit <i class="ph-paper-plane-tilt ms-2"></i>
		</button>
	</div>
</div>