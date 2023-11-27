<div class="row">
    <div class="form-group col-lg-6 mb-3">
        {{ Form::label('کارکن') }}
        {{ Form::select('worker_id', workers(), $productionPayment->worker_id, ['class' => 'form-control select' . ($errors->has('worker_id') ? ' is-invalid' : ''), 'placeholder' => '--منتخب کریں۔--','required']) }}
        {!! $errors->first('worker_id', '<div class="invalid-feedback">:message</div>') !!}
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
    <div class="col-md-12 d-flex justify-content-end align-items-center mt-3">
        <button type="submit" class="btn btn-primary ms-3">
            جمع کرائیں<i class="ph-paper-plane-tilt ms-2"></i>
        </button>
    </div>
</div>