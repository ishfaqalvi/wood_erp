@extends('layouts.app')

@section('title')
    پیداوار کی ادائیگی دکھائیں۔
@endsection

@section('header')
<div class="page-header-content d-lg-flex">
    <div class="d-flex">
        <h4 class="page-title mb-0">
            <span class="fw-normal">پیداوار کی ادائیگی کا انتظام</span>
        </h4>
    </div>
    <div class="d-lg-block my-lg-auto ms-lg-auto">
        <div class="d-sm-flex align-items-center mb-3 mb-lg-0 ms-lg-3">
            <a href="{{ route('production-payments.index') }}" class="btn btn-outline-primary btn-labeled btn-labeled-start rounded-pill">
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
            <h5 class="mb-0">{{ __('پیداوار کی ادائیگی دکھائیں۔') }}</h5>
        </div>
        <div class="card-body">
           <div class="form-group mb-3">
                <strong>ورکر:</strong>
                {{ $productionPayment->worker->name }}
            </div>
            <div class="form-group mb-3">
                <strong>تاریخ:</strong>
                {{ date('d-m-Y', $productionPayment->date) }}
            </div>
            <div class="form-group mb-3">
                <strong>رقم:</strong>
                {{ number_format($productionPayment->amount) }}
            </div>
            <div class="form-group mb-3">
                <strong>حالت:</strong>
                {{ $productionPayment->status }}
            </div>
        </div>
    </div>
</div>
@endsection