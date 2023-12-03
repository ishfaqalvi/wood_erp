@extends('layouts.app')

@section('title')
    {{ "سیل آئٹم کا انتظام  " }}
@endsection

@section('header')
<div class="page-header-content d-lg-flex">
    <div class="d-flex">
        <h4 class="page-title mb-0">
            <span class="fw-normal">سیل آئٹم کا انتظام  </span>
        </h4>
    </div>
    <div class="d-lg-block my-lg-auto ms-lg-auto">
        <div class="d-sm-flex align-items-center mb-3 mb-lg-0 ms-lg-3">
            <a href="{{ route('sale-items.index') }}" class="btn btn-outline-primary btn-labeled btn-labeled-start rounded-pill">
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
            <h5 class="mb-0">سٹاک کی تفصیلات   {{ $saleItem->name }}</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-sm-6 col-xl-4">
                    <div class="card card-body bg-primary text-white">
                        <div class="d-flex align-items-center">
                            <i class="ph-arrow-fat-left ph-2x opacity-75 me-3"></i>
                            <div class="flex-fill text-end">
                                <h4 class="mb-0">
                                    {{ number_format($saleItem->details()->where('type','In')->sum('quantity') )}}
                                </h4>
                                کل اسٹاک وصولی
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
                                    {{ number_format($saleItem->details()->where('type','Out')->sum('quantity') )}}
                                </h4>
                                کل اسٹاک آؤٹ
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
                                    {{ number_format($saleItem->details()->where('type','In')->sum('quantity') - $saleItem->details()->where('type','Out')->sum('quantity') )}}
                                </h4>
                                موجودہ اسٹاک
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
                            <th>قسم</th>
                            <th>تاریخ</th>
                            <th>مقدار</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($saleItem->details()->latest('id')->get() as $key => $detail)
                        <tr>
                            <td>{{ ++$key }}</td>
                            <td>
                                <span class="badge {{ $detail->type == 'In' ? 'bg-success' : 'bg-secondary'}}">{{ $detail->type }}</span>
                            </td>
                            <td>{{ date('d M Y', $detail->date) }}</td>
                            <td>{{ number_format($detail->quantity) }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection