@extends('layouts.app')

@section('title')
    فروش کی تفصیل
@endsection

@section('header')
<div class="page-header-content d-lg-flex">
    <div class="d-flex">
        <h4 class="page-title mb-0">
            <span class="fw-normal"> وینڈر مینجمنٹ </span>
        </h4>
    </div>
    <div class="d-lg-block my-lg-auto ms-lg-auto">
        <div class="d-sm-flex align-items-center mb-3 mb-lg-0 ms-lg-3">
            <a href="{{ route('vendors.index') }}" class="btn btn-outline-primary btn-labeled btn-labeled-start rounded-pill">
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
            <h5 class="mb-0">{{ __('فروش کی تفصیل') }}</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-sm-6 col-xl-4">
                    <div class="card card-body bg-primary text-white">
                        <div class="d-flex align-items-center">
                            <i class="ph-arrow-fat-left ph-2x opacity-75 me-3"></i>
                            <div class="flex-fill text-end">
                                <h4 class="mb-0">
                                    {{ number_format($vendor->details()->where('type','Received')->sum('amount') )}}
                                </h4>
                                ٹوٹل موصول
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-xl-4">
                    <div class="card card-body bg-danger text-white">
                        <div class="d-flex align-items-center">
                            <i class="ph-arrow-fat-right ph-2x opacity-75 me-3"></i>
                            <div class="flex-fill text-end">
                                <h4 class="mb-0">
                                    {{ number_format($vendor->details()->where('type','Paid')->sum('amount') )}}
                                </h4>
                                مکمل ادائیگی
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-xl-4">
                    <div class="card card-body bg-success text-white">
                        <div class="d-flex align-items-center">
                            <i class="ph-currency-dollar ph-2x opacity-75 me-3"></i>
                            <div class="flex-fill text-end">
                                <h4 class="mb-0">
                                    {{ number_format($vendor->details()->where('type','Received')->sum('amount') - $vendor->details()->where('type','Paid')->sum('amount') )}}
                                </h4>
                                موجودہ توازن
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="table-responsive border rounded">
                <table class="table">
                    <thead class="thead">
                        <tr>
                            <th>نمبر</th>
                            <th>حوالہ</th>
                            <th>تفصیل</th>
                            <th>تاریخ</th>
                            <th>قسم</th>
                            <th>رقم</th>
                            <th>بقیہ</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($vendor->details()->latest('id')->get() as $key => $vendorDetail)
                        <tr>
                            <td>{{ ++$key }}</td>
                            <td>{{ $vendorDetail->reference }}</td>
                            <td>{{ $vendorDetail->detail }}</td>
                            <td>{{ date('d M Y', $vendorDetail->date) }}</td>
                            <td>
                                <span class="badge {{ $vendorDetail->type == 'Paid' ? 'bg-success' : 'bg-secondary'}}">{{ $vendorDetail->type }}</span>
                            </td>
                            <td>{{ number_format($vendorDetail->amount) }}</td>
                            <td>{{ number_format($vendorDetail->balance) }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection