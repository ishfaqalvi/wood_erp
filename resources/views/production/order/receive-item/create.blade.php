<div id="addItem" class="modal fade" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="{{ route('order.receive.items.store') }}" class="validate" role="form" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">آرڈر پلان آئٹم شامل کریں۔</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        {{ Form::hidden('order_id', $order->id) }}
                        <div class="form-group mb-3">
                            {{ Form::label('آئٹم') }}
                            {{ Form::select('sale_item_id', $items, null, ['class' => 'form-control select' . ($errors->has('sale_item_id') ? ' is-invalid' : ''), 'placeholder' => '--منتخب کریں۔--','required']) }}
                            {!! $errors->first('sale_item_id', '<div class="invalid-feedback">:message</div>') !!}
                        </div>
                        <div class="form-group mb-3">
                            {{ Form::label('منصوبہ بندی کی مقدار') }}
                            {{ Form::number('plan_quantity', null, ['class' => 'form-control' . ($errors->has('plan_quantity') ? ' is-invalid' : ''), 'placeholder' => 'منصوبہ بندی کی مقدار','required', 'min'=> '1']) }}
                            {!! $errors->first('plan_quantity', '<div class="invalid-feedback">:message</div>') !!}
                        </div>
                        <div class="form-group">
                            {{ Form::label('شرح') }}
                            {{ Form::number('rate', null, ['class' => 'form-control' . ($errors->has('rate') ? ' is-invalid' : ''), 'placeholder' => 'شرح','required', 'min'=> '1']) }}
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