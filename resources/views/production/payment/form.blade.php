<div class="row">
    <div class="form-group col-lg-6 mb-3">
        {{ Form::label('کارکن') }}
        {{ Form::select('worker_id', workers(), $productionPayment->worker_id, ['class' => 'form-control select' . ($errors->has('worker_id') ? ' is-invalid' : ''), 'placeholder' => '--منتخب کریں۔--','required']) }}
        {!! $errors->first('worker_id', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="form-group col-lg-6 mb-3">
        {{ Form::label('قسم  ') }}
        {{ Form::select('type', ['Cash' => 'Cash','Online' => 'Online','Check' => 'Check'], $productionPayment->type, ['class' => 'form-control select' . ($errors->has('type') ? ' is-invalid' : ''), 'placeholder' => '--منتخب کریں۔--','required']) }}
        {!! $errors->first('type', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="form-group col-lg-6 mb-3 bank" style="display: none;">
        {{ Form::label('بینک  ') }}
        {{ Form::text('bank', $productionPayment->bank, ['class' => 'form-control' . ($errors->has('bank') ? ' is-invalid' : ''), 'placeholder' => 'بینک  ']) }}
        {!! $errors->first('bank', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="form-group col-lg-6 mb-3 slipNumber" style="display: none;">
        {{ Form::label('سلپ  نمبر') }}
        {{ Form::text('slip_number', $productionPayment->slip_number, ['class' => 'form-control' . ($errors->has('slip_number') ? ' is-invalid' : ''), 'placeholder' => 'سلپ  نمبر ']) }}
        {!! $errors->first('slip_number', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="form-group col-lg-6 mb-3 checkNumber" style="display: none;">
        {{ Form::label('چیک نمبر  ') }}
        {{ Form::text('check_number', $productionPayment->check_number, ['class' => 'form-control' . ($errors->has('check_number') ? ' is-invalid' : ''), 'placeholder' => 'چیک نمبر  ']) }}
        {!! $errors->first('check_number', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="form-group col-lg-6 mb-3">
        {{ Form::label('تاریخ') }}
        {{ Form::text('date', date('m-d-Y',$productionPayment->date), ['class' => 'form-control date' . ($errors->has('date') ? ' is-invalid' : ''), 'placeholder' => 'تاریخ','required']) }}
        {!! $errors->first('date', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="form-group col-lg-6 mb-3">
        {{ Form::label('رقم') }}
        {{ Form::number('amount', $productionPayment->amount, ['class' => 'form-control' . ($errors->has('amount') ? ' is-invalid' : ''), 'placeholder' => 'رقم','required','min' => '0']) }}
        {!! $errors->first('amount', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="form-group col-lg-12 mb-3 attachment" style="display:none;">
        {{ Form::label('تصویر  ') }}
        {{ Form::file('attachment', ['class' => 'form-control dropify' . ($errors->has('attachment') ? ' is-invalid' : ''),'accept' => 'image/png,image/jpg,image/jpeg','data-default-file' => $productionPayment->attachment ? $productionPayment->attachment : '','data-height' => '200']) }}
        {!! $errors->first('attachment', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="col-md-12 d-flex justify-content-end align-items-center mt-3">
        <button type="submit" class="btn btn-primary ms-3">
            جمع کرائیں<i class="ph-paper-plane-tilt ms-2"></i>
        </button>
    </div>
</div>