<div id="addItem" class="modal fade" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="{{ route('invoice.items.store') }}" class="validate" role="form" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">انوائس آئٹم شامل کریں۔</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        {{ Form::hidden('type', 'Fancy') }}
                        {{ Form::hidden('invoice_id', $invoice->id) }}
                        <div class="form-group mb-3">
                            {{ Form::label('آئٹم') }}
                            {{ Form::select('sale_item_id', $items, null, ['class' => 'form-control select' . ($errors->has('sale_item_id') ? ' is-invalid' : ''), 'placeholder' => '--منتخب کریں۔--','required','id'=>'createItem']) }}
                            {!! $errors->first('sale_item_id', '<div class="invalid-feedback">:message</div>') !!}
                        </div>
                        <div class="form-group col-lg-6 mb-3">
                            {{ Form::label('گودام') }}
                            {{ Form::select('warehouse_id', warehouses(), $invoice->warehouse_id, ['class' => 'form-control select' . ($errors->has('warehouse_id') ? ' is-invalid' : ''), 'placeholder' => '--منتخب کریں۔--','required','id' => 'warehouseId']) }}
                            {!! $errors->first('warehouse_id', '<div class="invalid-feedback">:message</div>') !!}
                        </div>
                        <div class="form-group col-lg-6 mb-3">
                            {{ Form::label('مقدار') }}
                            {{ Form::number('quantity', null, ['class' => 'form-control' . ($errors->has('quantity') ? ' is-invalid' : ''), 'placeholder' => 'مقدار','required', 'min'=> '1','id' => 'quantity']) }}
                            {!! $errors->first('quantity', '<div class="invalid-feedback">:message</div>') !!}
                        </div>
                        <div class="form-group col-lg-6 mb-3">
                            {{ Form::label('بنڈل کی مقدار') }}
                            {{ Form::number('bundle_quantity', null, ['class' => 'form-control' . ($errors->has('bundle_quantity') ? ' is-invalid' : ''), 'placeholder' => 'بنڈل کی مقدار  ','required', 'min'=> '1']) }}
                            {!! $errors->first('bundle_quantity', '<div class="invalid-feedback">:message</div>') !!}
                        </div>
                        <div class="form-group col-lg-6">
                            {{ Form::label('ریٹ  ') }}
                            {{ Form::number('rate', null, ['class' => 'form-control' . ($errors->has('rate') ? ' is-invalid' : ''), 'placeholder' => 'ریٹ  ','required', 'min'=> '0']) }}
                            {!! $errors->first('rate', '<div class="invalid-feedback">:message</div>') !!}
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-link" data-bs-dismiss="modal">بند کریں</button>
                    <button type="submit" class="btn btn-primary">تبدیلیاں محفوظ کرو</button>
                </div>
            </form>
        </div>
    </div>
</div>