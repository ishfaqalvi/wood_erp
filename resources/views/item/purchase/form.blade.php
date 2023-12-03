<div class="row">
    <div class="form-group col-lg-6 mb-3">
        {{ Form::label('نام ') }}
        {{ Form::text('name', $purchaseItem->name, ['class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : ''), 'placeholder' => 'نام ','required']) }}
        {!! $errors->first('name', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="form-group col-lg-6 mb-3">
        {{ Form::label('لمبائی  ') }}
        {{ Form::number('length', $purchaseItem->length, ['class' => 'form-control' . ($errors->has('length') ? ' is-invalid' : ''), 'placeholder' => 'لمبائی  ','required','min' => '0']) }}
        {!! $errors->first('length', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="form-group col-lg-6 mb-3">
        {{ Form::label('چوڑائی ') }}
        {{ Form::number('width', $purchaseItem->width, ['class' => 'form-control' . ($errors->has('width') ? ' is-invalid' : ''), 'placeholder' => 'چوڑائی ','required','min' => '0']) }}
        {!! $errors->first('width', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="form-group col-lg-6 mb-3">
        {{ Form::label('موٹائی ') }}
        {{ Form::number('thikness', $purchaseItem->thikness, ['class' => 'form-control' . ($errors->has('thikness') ? ' is-invalid' : ''), 'placeholder' => 'موٹائی ','required','min' => '0']) }}
        {!! $errors->first('thikness', '<div class="invalid-feedback">:message</div>') !!}
    </div>
	<div class="col-md-12 d-flex justify-content-end align-items-center mt-3">
		<button type="submit" class="btn btn-primary ms-3">
			جمع کرائیں<i class="ph-paper-plane-tilt ms-2"></i>
		</button>
	</div>
</div>