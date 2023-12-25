@extends('layouts.app')

@section('title', 'ڈیش بورڈ ')

@section('header')
<div class="page-header-content d-lg-flex">
    <div class="d-flex">
        <h4 class="page-title mb-0">
            <span class="fw-normal">ڈیش بورڈ </span>
        </h4>
        <a href="#page_header" class="btn btn-light align-self-center collapsed d-lg-none border-transparent rounded-pill p-0 ms-auto" data-bs-toggle="collapse">
            <i class="ph-caret-down collapsible-indicator ph-sm m-1"></i>
        </a>
    </div>
</div>
@endsection

@section('content')
<div class="row">
    <div class="col-4">
        <div class="card card-body bg-primary text-white">
            <div class="d-flex align-items-center">
                <i class="ph-users-three ph-2x opacity-75 me-3"></i>
                <div class="flex-fill text-end">
                    <h4 class="mb-0">{{ number_format($data['vendors']) }}</h4>
                    Total Vendors
                </div>
            </div>
        </div>
    </div>
    <div class="col-4">
        <div class="card card-body bg-primary text-white">
            <div class="d-flex align-items-center">
                <i class="ph-users-three ph-2x opacity-75 me-3"></i>
                <div class="flex-fill text-end">
                    <h4 class="mb-0">{{ number_format($data['workers']) }}</h4>
                    Total Worker
                </div>
            </div>
        </div>
    </div>
    <div class="col-4">
        <div class="card card-body bg-primary text-white">
            <div class="d-flex align-items-center">
                <i class="ph-users-three ph-2x opacity-75 me-3"></i>
                <div class="flex-fill text-end">
                    <h4 class="mb-0">{{ number_format($data['customers']) }}</h4>
                    Total Customer
                </div>
            </div>
        </div>
    </div>
    <div class="col-4">
        <div class="card card-body bg-success text-white">
            <div class="d-flex align-items-center">
                <i class="ph-currency-dollar ph-2x opacity-75 me-3"></i>
                <div class="flex-fill text-end">
                    <h4 class="mb-0">{{ number_format($data['vendorBalance']) }}</h4>
                    Vendor Balance
                </div>
            </div>
        </div>
    </div>
    <div class="col-4">
        <div class="card card-body bg-success text-white">
            <div class="d-flex align-items-center">
                <i class="ph-currency-dollar ph-2x opacity-75 me-3"></i>
                <div class="flex-fill text-end">
                    <h4 class="mb-0">{{ number_format($data['workerBalance']) }}</h4>
                    Worker Balance
                </div>
            </div>
        </div>
    </div>
    <div class="col-4">
        <div class="card card-body bg-success text-white">
            <div class="d-flex align-items-center">
                <i class="ph-currency-dollar ph-2x opacity-75 me-3"></i>
                <div class="flex-fill text-end">
                    <h4 class="mb-0">{{ number_format($data['customerBalance']) }}</h4>
                    Customer Balance
                </div>
            </div>
        </div>
    </div>
    <div class="col-4">
        <div class="card card-body bg-indigo text-white">
            <div class="d-flex align-items-center">
                <i class="ph-bank ph-2x opacity-75 me-3"></i>
                <div class="flex-fill text-end">
                    <h4 class="mb-0">{{ $data['accounts'] }}</h4>
                    Total Bank Accounts
                </div>
            </div>
        </div>
    </div>
    <div class="col-4">
        <div class="card card-body bg-indigo text-white">
            <div class="d-flex align-items-center">
                <i class="ph-bank ph-2x opacity-75 me-3"></i>
                <div class="flex-fill text-end">
                    <h4 class="mb-0">{{ $data['accountBalance'] }}</h4>
                    All Account Balance
                </div>
            </div>
        </div>
    </div>
    <div class="col-4">
        <div class="card card-body bg-indigo text-white">
            <div class="d-flex align-items-center">
                <i class="ph-bank ph-2x opacity-75 me-3"></i>
                <div class="flex-fill text-end">
                    <h4 class="mb-0">{{ $data['defaultAccountBalance'] }}</h4>
                    Default Account Balance
                </div>
            </div>
        </div>
    </div>
</div>
@endsection