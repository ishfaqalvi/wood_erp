<div class="row">
    <div class="col-md-6">
        <div class="form-group mb-3">
            {{ Form::label('نام') }} 
            {{ Form::text('name', $customer->name, ['class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : ''), 'placeholder' => 'نام','required']) }}
            {!! $errors->first('name', '<div class="invalid-feedback">:message</div>') !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            {{ Form::label('تصویر') }}
            {{ Form::file('image', ['class' => 'form-control dropify' . ($errors->has('image') ? ' is-invalid' : ''), 'placeholder' => 'Image', 'accept' => 'image/png,image/jpg,image/jpeg','data-default-file' => $customer->image ? $customer->image : '','data-height' => '200']) }}
            {!! $errors->first('image', '<div class="invalid-feedback">:message</div>') !!}
        </div>
    </div>
    <div class="col-md-12 d-flex justify-content-end align-items-center mt-3">
        <button type="submit" class="btn btn-primary ms-3">
            جمع کرائیں <i class="ph-paper-plane-tilt ms-2"></i>
        </button>
    </div>
</div>