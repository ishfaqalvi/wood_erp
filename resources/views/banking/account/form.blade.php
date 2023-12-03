<div class="row">
    <div class="form-group col-lg-6 mb-3">
        {{ Form::label('بینک') }}
        {{ Form::select('bank_id', banks(), $account->bank_id, ['class' => 'form-control form-select' . ($errors->has('bank_id') ? ' is-invalid' : ''), 'placeholder' => '--منتخب کریں۔--','required']) }}
        {!! $errors->first('bank_id', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="form-group col-lg-6 mb-3">
        {{ Form::label('عنوان') }}
        {{ Form::text('title', $account->title, ['class' => 'form-control' . ($errors->has('title') ? ' is-invalid' : ''), 'placeholder' => 'عنوان'  ,'required']) }}
        {!! $errors->first('title', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="form-group col-lg-6 mb-3">
        {{ Form::label('نمبر') }}
        {{ Form::number('number', $account->number, ['class' => 'form-control' . ($errors->has('number') ? ' is-invalid' : ''), 'placeholder' => 'نمبر  ','required']) }}
        {!! $errors->first('number', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="form-group col-lg-6 mb-3">
        {{ Form::label('بیلنس') }}
        {{ Form::number('balance', $account->balance, ['class' => 'form-control' . ($errors->has('balance') ? ' is-invalid' : ''), 'placeholder' => 'بیلنس','required','min'=>'0', $account->balance > 0 ? 'disabled' : '']) }}
        {!! $errors->first('balance', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    @if(App\Models\Account::count() > 0 && $account->default == '')
    <div class="form-group col-md-12 mb-3">
        <div class="form-check form-switch">
            <input type="checkbox" class="form-check-input form-check-input-success" id="default" name="default" value="Yes" {{$account->default ? 'Checked' : ''}}>
            <label class="form-check-label" for="default">ڈیفالٹ  </label>
        </div>
    </div>
    @elseif(App\Models\Account::count() > 1 && $account->default != '')
    <div class="form-group col-md-12 mb-3">
        <div class="form-check form-switch">
            <input type="checkbox" class="form-check-input form-check-input-success" id="default" name="default" value="Yes" {{$account->default ? 'Checked' : ''}}>
            <label class="form-check-label" for="default">ڈیفالٹ  </label>
        </div>
    </div>
    @else
    <input type="hidden" name="default" value="Yes">
    @endif
    <div class="col-md-12 d-flex justify-content-end align-items-center mt-3">
        <button type="submit" class="btn btn-primary ms-3">
            جمع کرائیں<i class="ph-paper-plane-tilt ms-2"></i>
        </button>
    </div>
</div>
