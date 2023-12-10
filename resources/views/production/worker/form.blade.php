<div class="row">
    <div class="col-md-6">
        <div class="row">
            <div class="form-group mb-3">
                {{ Form::label('نام') }} 
                {{ Form::text('name', $worker->name, ['class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : ''), 'placeholder' => 'نام','required']) }}
                {!! $errors->first('name', '<div class="invalid-feedback">:message</div>') !!}
            </div>
            @if(empty($worker->name))
            <div class="form-group mb-3">
                {{ Form::label('پچھلا حساب  ') }} 
                {{ Form::select('type',['Plus' => 'جمع  ','Minus' => 'بنام  '] ,null, ['class' => 'form-control' . ($errors->has('type') ? ' is-invalid' : ''), 'placeholder' => '--منتخب کریں۔--','id' => 'selectField']) }}
                {!! $errors->first('type', '<div class="invalid-feedback">:message</div>') !!}
            </div>
            <div class="form-group">
                {{ Form::label('رقم  ') }} 
                {{ Form::number('amount', $worker->amount, ['class' => 'form-control' . ($errors->has('amount') ? ' is-invalid' : ''), 'placeholder' => ' رقم ','required']) }}
                {!! $errors->first('amount', '<div class="invalid-feedback">:message</div>') !!}
            </div>
            @endif
        </div>
    </div>
    <div class="form-group col-md-6">
        {{ Form::label('تصویر') }}
        {{ Form::file('image', ['class' => 'form-control dropify' . ($errors->has('image') ? ' is-invalid' : ''), 'placeholder' => 'Image', 'accept' => 'image/png,image/jpg,image/jpeg','data-default-file' => $worker->image ? $worker->image : '','data-height' => '200']) }}
        {!! $errors->first('image', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="col-md-12 d-flex justify-content-end align-items-center mt-3">
        <button type="submit" class="btn btn-primary ms-3">
            جمع کرائیں <i class="ph-paper-plane-tilt ms-2"></i>
        </button>
    </div>
</div>