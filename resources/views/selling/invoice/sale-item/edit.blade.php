<div id="editItem{{$item->id}}" class="modal fade" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="{{ route('invoice.items.update') }}" class="validate{{$item->id}}" role="form" enctype="multipart/form-data">
                @csrf
                {{ Form::hidden('type', 'Fancy') }}
                {{ Form::hidden('id', $item->id) }}
                <div class="modal-header">
                    <h5 class="modal-title">Update Invoice Item</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group mb-3">
                            {{ Form::label('item') }}
                            {{ Form::select('sale_item_id', $items, $item->sale_item_id, ['class' => 'form-control form-select' . ($errors->has('sale_item_id') ? ' is-invalid' : ''), 'placeholder' => '--Select--','required']) }}
                            {!! $errors->first('sale_item_id', '<div class="invalid-feedback">:message</div>') !!}
                        </div>
                        <div class="form-group col-lg-6 mb-3">
                            {{ Form::label('quantity') }}
                            {{ Form::number('quantity', $item->quantity, ['class' => 'form-control' . ($errors->has('quantity') ? ' is-invalid' : ''), 'placeholder' => 'Quantity','required', 'min'=> '1']) }}
                            {!! $errors->first('quantity', '<div class="invalid-feedback">:message</div>') !!}
                        </div>
                        <div class="form-group col-lg-6 mb-3">
                            {{ Form::label('rate') }}
                            {{ Form::number('rate', $item->rate, ['class' => 'form-control' . ($errors->has('rate') ? ' is-invalid' : ''), 'placeholder' => 'Rate','required', 'min'=> '1']) }}
                            {!! $errors->first('rate', '<div class="invalid-feedback">:message</div>') !!}
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-link" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>