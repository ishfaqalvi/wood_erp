@extends('layouts.app')

@section('title')
    {{ $warehouse->name ?? "گودام کی تفصیل" }}
@endsection

@section('header')
<div class="page-header-content d-lg-flex">
    <div class="d-flex">
        <h4 class="page-title mb-0">
            <span class="fw-normal">گوداموں کا انتظام  </span>
        </h4>
    </div>
    <div class="d-lg-block my-lg-auto ms-lg-auto">
        <div class="d-sm-flex align-items-center mb-3 mb-lg-0 ms-lg-3">
            <a href="{{ route('warehouses.index') }}" class="btn btn-outline-primary btn-labeled btn-labeled-start rounded-pill me-2">
                <span class="btn-labeled-icon bg-primary text-white rounded-pill">
                    <i class="ph-arrow-circle-left"></i>
                </span>
                پیچھے
            </a>
            <a href="{{ route('warehouse.reset',$warehouse->id) }}" class="btn btn-outline-primary btn-labeled btn-labeled-start rounded-pill">
                <span class="btn-labeled-icon bg-primary text-white rounded-pill">
                    <i class="ph-arrows-clockwise"></i>
                </span>
                Reset
            </a>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">{{ __('گودام کی تفصیل') }}</h5>
        </div>
        <table class="table datatable-basic">
            <thead class="thead">
                <tr>
                    <th>نمبر</th>
                    <th>شے کا نام  </th>
                    <th>مقدار  </th>
                </tr>
            </thead>
            <tbody>
            @foreach ($warehouse->details()->where('quantity','>', 0)->get() as $key => $detail)
                <tr>
                    <td>{{ ++$key }}</td>
                    <td>{{ $detail->saleItem->name }}</td>
                    <td>{{ $detail->quantity }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection