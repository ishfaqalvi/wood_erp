<div class="row">
    <div class="form-group col-lg-6 mb-3">
        {{ Form::label('نام') }}
        {{ Form::text('name', $warehouse->name, ['class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : ''), 'placeholder' => 'نام','required']) }}
        {!! $errors->first('name', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="form-group col-lg-6 mb-3">
        {{ Form::label('مالک کا نام') }}
        {{ Form::text('owner_name', $warehouse->owner_name, ['class' => 'form-control' . ($errors->has('owner_name') ? ' is-invalid' : ''), 'placeholder' => 'مالک کا نام','required']) }}
        {!! $errors->first('owner_name', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="form-group col-lg-6 mb-3">
        {{ Form::label('فون نمبر') }}
        {{ Form::text('mobile_number', $warehouse->mobile_number, ['class' => 'form-control' . ($errors->has('mobile_number') ? ' is-invalid' : ''), 'placeholder' => 'فون نمبر','required']) }}
        {!! $errors->first('mobile_number', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="form-group col-lg-6 mb-3">
        {{ Form::label('پتہ') }}
        {{ Form::text('address', $warehouse->address, ['class' => 'form-control' . ($errors->has('address') ? ' is-invalid' : ''), 'placeholder' => 'پتہ','required']) }}
        {!! $errors->first('address', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="col-md-12 d-flex justify-content-end align-items-center mt-3">
        <button type="submit" class="btn btn-primary ms-3">
            جمع کرائیں<i class="ph-paper-plane-tilt ms-2"></i>
        </button>
    </div>
</div>