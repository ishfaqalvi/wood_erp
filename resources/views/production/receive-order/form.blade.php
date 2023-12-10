<div class="row">
    <div class="form-group col-lg-4 mb-3">
        {{ Form::label('گودام') }}
        {{ Form::select('warehouse_id', warehouses(), $receiveOrder->warehouse_id, ['class' => 'form-control form-select' . ($errors->has('warehouse_id') ? ' is-invalid' : ''), 'placeholder' => '--منتخب کریں۔--','required']) }}
        {!! $errors->first('warehouse_id', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="form-group col-lg-4 mb-3">
        {{ Form::label('ورکر ') }}
        {{ Form::select('worker_id', workers(),$receiveOrder->worker_id, ['class' => 'form-control  form-select' . ($errors->has('worker_id') ? ' is-invalid' : ''), 'placeholder' => '--منتخب کریں۔--','required']) }}
        {!! $errors->first('worker_id', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="form-group col-lg-4 mb-3">
        {{ Form::label('پرچی نمبر  ') }}
        {{ Form::text('slip_number', $receiveOrder->slip_number, ['class' => 'form-control' . ($errors->has('slip_number') ? ' is-invalid' : ''), 'placeholder' => 'پرچی نمبر  ','required']) }}
        {!! $errors->first('slip_number', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="form-group col-lg-4 mb-3">
        {{ Form::label('تاریخ  ') }}
        {{ Form::text('date', date('m-d-Y',$receiveOrder->date), ['class' => 'form-control datepicker-autohide' . ($errors->has('date') ? ' is-invalid' : ''), 'placeholder' => 'تاریخ  ','required']) }}
        {!! $errors->first('date', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="col-md-12 d-flex justify-content-end align-items-center mt-3">
        <button type="submit" class="btn btn-primary ms-3">
            Submit <i class="ph-paper-plane-tilt ms-2"></i>
        </button>
    </div>
</div>