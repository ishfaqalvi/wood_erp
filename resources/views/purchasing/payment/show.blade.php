@extends('layouts.app')

@section('title')
    خریداری کی ادائیگی
@endsection

@section('header')
<div class="page-header-content d-lg-flex">
    <div class="d-flex">
        <h4 class="page-title mb-0">
            <span class="fw-normal">خریداری کی ادائیگی</span>
        </h4>
    </div>
    <div class="d-lg-block my-lg-auto ms-lg-auto">
        <div class="d-sm-flex align-items-center mb-3 mb-lg-0 ms-lg-3">
            <a href="{{ route('purchase-payments.index') }}" class="btn btn-outline-primary btn-labeled btn-labeled-start rounded-pill">
                <span class="btn-labeled-icon bg-primary text-white rounded-pill">
                    <i class="ph-arrow-circle-left"></i>
                </span>
                پیچھے
            </a>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">{{ __('خریداری کی ادائیگی دکھائیں۔') }}</h5>
        </div>
        <div class="card-body">
            <div class="form-group mb-3">
                <strong> ٹرانزکشن:</strong>
                {{ $purchasePayment->transaction_id }}
            </div>
            <div class="form-group mb-3">
                <strong>فروش:</strong>
                {{ $purchasePayment->vendor->name }}
            </div>
            <div class="form-group mb-3">
                <strong> قسم :</strong>
                @if($purchasePayment->type == 'Online')
                    {{ $purchasePayment->type.'('.$purchasePayment->online_type .')' }}
                @else
                    {{ $purchasePayment->type }}
                @endif
            </div>
            @if($purchasePayment->type == 'Check')
            <div class="form-group mb-3">
                <strong>اکاؤنٹ    :</strong>
                {{ $purchasePayment->account->title }}
            </div>
            <div class="form-group mb-3">
                <strong>چیک نمبر  :</strong>
                {{ $purchasePayment->check_number }}
            </div>
            @endif
            @if($purchasePayment->type == 'Online')
                @if($purchasePayment->online_type == 'Bank')
                <div class="form-group mb-3">
                    <strong>بینک   :</strong>
                    {{ $purchasePayment->bank->title }}
                </div>
                @else
                <div class="form-group mb-3">
                    <strong>اکاؤنٹ    :</strong>
                    {{ $purchasePayment->account->title }}
                </div>
                @endif
            <div class="form-group mb-3">
                <strong>سلپ  نمبر :</strong>
                {{ $purchasePayment->slip_number }}
            </div>
            @endif
            <div class="form-group mb-3">
                <strong>تاریخ:</strong>
                {{ date('d-m-Y', $purchasePayment->date) }}
            </div>
            <div class="form-group mb-3">
                <strong>رقم:</strong>
                {{ number_format($purchasePayment->amount) }}
            </div>
            <div class="form-group mb-3">
                <strong>حالت:</strong>
                {{ $purchasePayment->status }}
            </div>
            <div class="form-group mb-3">
                <strong>تفصیل   :</strong>
                {{ $purchasePayment->remarks }}
            </div>
            @if($purchasePayment->type != 'Cash')
            <div class="form-group mb-3">
                <strong> تصویر :</strong>
                <img src="{{ $purchasePayment->attachment }}">
            </div>
            @endif
        </div>
    </div>
</div>
@endsection