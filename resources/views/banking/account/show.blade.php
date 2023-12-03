@extends('layouts.app')

@section('title')
    {{ $account->name ?? "اکاؤنٹ دکھائیں۔  " }}
@endsection

@section('header')
<div class="page-header-content d-lg-flex">
    <div class="d-flex">
        <h4 class="page-title mb-0">
            <span class="fw-normal">اکاؤنٹ کا انتظام  </span>
        </h4>
    </div>
    <div class="d-lg-block my-lg-auto ms-lg-auto">
        <div class="d-sm-flex align-items-center mb-3 mb-lg-0 ms-lg-3">
            <a href="{{ route('accounts.index') }}" class="btn btn-outline-primary btn-labeled btn-labeled-start rounded-pill">
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
            <h5 class="mb-0">{{ __('اکاؤنٹ دکھائیں۔  ') }}</h5>
        </div>
        <div class="card-body">
            <div class="form-group mb-3">
                <strong> بینک :</strong>
                {{ $account->bank->title }}
            </div>
            <div class="form-group mb-3">
                <strong>عنوان  :</strong>
                {{ $account->title }}
            </div>
            <div class="form-group mb-3">
                <strong>نمبر  :</strong>
                {{ $account->number }}
            </div>
            <div class="form-group mb-3">
                <strong>بیلنس  :</strong>
                {{ number_format($account->balance) }}
            </div>
            <div class="form-group mb-3">
                <strong>ڈیفالٹ  :</strong>
                {{ $account->default }}
            </div>
            <div class="form-group mb-3">
                <strong>تخلیق کردہ  :</strong>
                {{ $account->creator?->name }}
            </div>
            <div class="form-group mb-3">
                <strong>اپ ڈیٹ کیا گیا  :</strong>
                {{ $account->editor?->name }}
            </div>
        </div>
    </div>
</div>
@endsection