@extends('layouts.app')

@section('title')
    فروخت کی ادائیگی
@endsection

@section('header')
<div class="page-header-content d-lg-flex">
    <div class="d-flex">
        <h4 class="page-title mb-0">
            <span class="fw-normal">فروخت کی ادائیگی</span>
        </h4>
    </div>
    <div class="d-lg-block my-lg-auto ms-lg-auto">
        <div class="d-sm-flex align-items-center mb-3 mb-lg-0 ms-lg-3">
            <a href="{{ route('sale-payments.index') }}" class="btn btn-outline-primary btn-labeled btn-labeled-start rounded-pill">
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
            <h5 class="mb-0">{{ __('فروخت کی ادائیگی دکھائیں۔') }}</h5>
        </div>
        <div class="card-body">
            <div class="form-group mb-3">
                <strong>فروش:</strong>
                {{ $salePayment->customer->name }}
            </div>
            <div class="form-group mb-3">
                <strong> قسم :</strong>
                {{ $salePayment->type }}
            </div>
            @if($salePayment->type == 'Check')
            <div class="form-group mb-3">
                <strong>بینک   :</strong>
                {{ $salePayment->bank }}
            </div>
            <div class="form-group mb-3">
                <strong>چیک نمبر  :</strong>
                {{ $salePayment->check_number }}
            </div>
            @endif
            @if($salePayment->type == 'Online')
            <div class="form-group mb-3">
                <strong>بینک   :</strong>
                {{ $salePayment->bank }}
            </div>
            <div class="form-group mb-3">
                <strong>سلپ  نمبر :</strong>
                {{ $salePayment->slip_number }}
            </div>
            @endif
            <div class="form-group mb-3">
                <strong>تاریخ:</strong>
                {{ date('d-m-Y', $salePayment->date) }}
            </div>
            <div class="form-group mb-3">
                <strong>رقم:</strong>
                {{ number_format($salePayment->amount) }}
            </div>
            <div class="form-group mb-3">
                <strong>حالت:</strong>
                {{ $salePayment->status }}
            </div>
            @if($salePayment->type != 'Cash')
            <div class="form-group mb-3">
                <strong> تصویر :</strong>
                <img src="{{ $salePayment->attachment }}">
            </div>
            @endif
        </div>
    </div>
</div>
@endsection