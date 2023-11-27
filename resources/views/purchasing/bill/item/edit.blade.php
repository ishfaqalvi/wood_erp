<div id="editItem{{$item->id}}" class="modal fade" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="{{ route('bill.items.update', $item->id) }}" class="validate{{$item->id}}" role="form" enctype="multipart/form-data">
                @csrf
                {{ method_field('PATCH') }}
                <div class="modal-header">
                    <h5 class="modal-title">بل آئٹم کو اپ ڈیٹ کریں۔</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-lg-6 mb-3">
                            {{ Form::label('نام') }}
                            {{ Form::text('name', $item->name, ['class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : ''), 'placeholder' => 'نام','required']) }}
                            {!! $errors->first('name', '<div class="invalid-feedback">:message</div>') !!}
                        </div>
                        <div class="form-group col-lg-6 mb-3">
                            {{ Form::label('لمبائی') }}
                            {{ Form::number('length', $item->length, ['class' => 'form-control' . ($errors->has('length') ? ' is-invalid' : ''), 'placeholder' => 'لمبائی','required','min' => '0']) }}
                            {!! $errors->first('length', '<div class="invalid-feedback">:message</div>') !!}
                        </div>
                        <div class="form-group col-lg-6 mb-3">
                            {{ Form::label('چوڑائی') }}
                            {{ Form::number('width', $item->width, ['class' => 'form-control' . ($errors->has('width') ? ' is-invalid' : ''), 'placeholder' => 'چوڑائی','required','min' => '0']) }}
                            {!! $errors->first('width', '<div class="invalid-feedback">:message</div>') !!}
                        </div>
                        <div class="form-group col-lg-6 mb-3">
                            {{ Form::label('موٹائی') }}
                            {{ Form::number('thikness', $item->thikness, ['class' => 'form-control' . ($errors->has('thikness') ? ' is-invalid' : ''), 'placeholder' => 'موٹائی','required','min' => '0']) }}
                            {!! $errors->first('thikness', '<div class="invalid-feedback">:message</div>') !!}
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
                    <button type="button" class="btn btn-link" data-bs-dismiss="modal">بند کریں</button>
                    <button type="submit" class="btn btn-primary">تبدیلیاں محفوظ کرو</button>
                </div>
            </form>
        </div>
    </div>
</div>
