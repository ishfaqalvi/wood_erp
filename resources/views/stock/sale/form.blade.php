<div class="row">
    <div class="form-group col-lg-6 mb-3">
        {{ Form::label('گودام') }}
        {{ Form::select('warehouse_id', warehouses(), $saleStock->warehouse_id, ['class' => 'form-control select' . ($errors->has('warehouse_id') ? ' is-invalid' : ''), 'placeholder' => '--منتخب کریں۔--','required']) }}
        {!! $errors->first('warehouse_id', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="form-group col-lg-6 mb-3">
        {{ Form::label('آئٹم') }}
        {{ Form::select('sale_item_id', saleItems(), $saleStock->sale_item_id, ['class' => 'form-control select' . ($errors->has('sale_item_id') ? ' is-invalid' : ''), 'placeholder' => '--منتخب کریں۔--','required']) }}
        {!! $errors->first('sale_item_id', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="form-group col-lg-6 mb-3">
        {{ Form::label('مقدار') }}
        {{ Form::text('quantity', $saleStock->quantity, ['class' => 'form-control' . ($errors->has('quantity') ? ' is-invalid' : ''), 'placeholder' => 'مقدار','required']) }}
        {!! $errors->first('quantity', '<div class="invalid-feedback">:message</div>') !!}
    </div>
	<div class="col-md-12 d-flex justify-content-end align-items-center mt-3">
		<button type="submit" class="btn btn-primary ms-3">
			جمع کرائیں<i class="ph-paper-plane-tilt ms-2"></i>
		</button>
	</div>
</div>