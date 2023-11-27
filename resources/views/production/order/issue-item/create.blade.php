<div id="addItem" class="modal fade" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="{{ route('order.issue.items.store') }}" class="validate" role="form" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">آرڈر ایشو آئٹم شامل کریں۔</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        {{ Form::hidden('order_id', $order->id) }}
                        <div class="form-group mb-3">
                            {{ Form::label('آئٹم') }}
                            {{ Form::select('purchase_stock_id', $items, null, ['class' => 'form-control select' . ($errors->has('purchase_stock_id') ? ' is-invalid' : ''), 'placeholder' => '--منتخب کریں۔--','required','id'=>'purchase_stock_id']) }}
                            {!! $errors->first('purchase_stock_id', '<div class="invalid-feedback">:message</div>') !!}
                        </div>
                        <div class="form-group">
                            {{ Form::label('مقدار') }}
                            {{ Form::number('quantity', null, ['class' => 'form-control' . ($errors->has('quantity') ? ' is-invalid' : ''), 'placeholder' => 'مقدار','required', 'min'=> '1','id'=>'quantity']) }}
                            {!! $errors->first('quantity', '<div class="invalid-feedback">:message</div>') !!}
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