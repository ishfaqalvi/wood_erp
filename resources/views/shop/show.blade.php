@extends('layouts.app')

@section('title')
    {{ $shop->name ?? "ورکشاپ کی تفصیل" }}
@endsection

@section('header')
<div class="page-header-content d-lg-flex">
    <div class="d-flex">
        <h4 class="page-title mb-0">
            <span class="fw-normal">ورکشاپ کا انتظام  </span>
        </h4>
    </div>
    <div class="d-lg-block my-lg-auto ms-lg-auto">
        <div class="d-sm-flex align-items-center mb-3 mb-lg-0 ms-lg-3">
            <a href="{{ route('shops.index') }}" class="btn btn-outline-primary btn-labeled btn-labeled-start rounded-pill">
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
            <h5 class="mb-0">{{ __('ورکشاپ کی تفصیل') }}</h5>
        </div>
        <table class="table datatable-basic">
            <thead class="thead">
                <tr>
                    <th>نمبر</th>
                    <th>آئٹم</th>
                    <th>لمبائی(MM)</th>
                    <th>چوڑائی(MM)</th>
                    <th>موٹائی(MM)</th>
                    <th>تاریخ  </th>
                    <th>مقدار</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($shop->details as $key => $detail)
                <tr>
                    <td>{{ ++$key }}</td>
                    <td>{{ $detail->purchaseStock->name }}</td>
                    <td>{{ $detail->purchaseStock->length }}</td>
                    <td>{{ $detail->purchaseStock->width }}</td>
                    <td>{{ $detail->purchaseStock->thikness }}</td>
                    <td>{{ date('d M Y',$detail->quantity) }}</td>
                    <td>{{ number_format($detail->quantity) }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection