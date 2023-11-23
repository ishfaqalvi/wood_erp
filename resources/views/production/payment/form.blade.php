<div class="row">
    <div class="form-group col-lg-6 mb-3">
        {{ Form::label('worker') }}
        {{ Form::select('worker_id', workers(), $productionPayment->worker_id, ['class' => 'form-control select' . ($errors->has('worker_id') ? ' is-invalid' : ''), 'placeholder' => '--Select--','required']) }}
        {!! $errors->first('worker_id', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="form-group col-lg-6 mb-3">
        {{ Form::label('date') }}
        {{ Form::text('date', $productionPayment->date, ['class' => 'form-control date' . ($errors->has('date') ? ' is-invalid' : ''), 'placeholder' => 'Date','required']) }}
        {!! $errors->first('date', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="form-group col-lg-6 mb-3">
        {{ Form::label('amount') }}
        {{ Form::number('amount', $productionPayment->amount, ['class' => 'form-control' . ($errors->has('amount') ? ' is-invalid' : ''), 'placeholder' => 'Amount','required','min' => '0']) }}
        {!! $errors->first('amount', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="col-md-12 d-flex justify-content-end align-items-center mt-3">
        <button type="submit" class="btn btn-primary ms-3">
            Submit <i class="ph-paper-plane-tilt ms-2"></i>
        </button>
    </div>
</div>