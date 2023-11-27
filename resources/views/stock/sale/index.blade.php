@extends('layouts.app')

@section('title')
    فروخت اسٹاک
@endsection

@section('header')
<div class="page-header-content d-lg-flex">
    <div class="d-flex">
        <h4 class="page-title mb-0">
            <span class="fw-normal">سیل اسٹاک مینجمنٹ</span>
        </h4>
    </div>
    @can('saleStocks-create')
    <div class="d-lg-block my-lg-auto ms-lg-auto">
        <div class="d-sm-flex align-items-center mb-3 mb-lg-0 ms-lg-3">
            <a href="{{ route('sale-stocks.create') }}" class="btn btn-outline-primary btn-labeled btn-labeled-start rounded-pill">
                <span class="btn-labeled-icon bg-primary text-white rounded-pill">
                    <i class="ph-plus"></i>
                </span>
                نیا بنائیں
            </a>
        </div>
    </div>
    @endcan
</div>
@endsection

@section('content')
<div class="col-sm-12">
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">فروخت اسٹاک</h5>
        </div>
        <table class="table datatable-basic">
            <thead class="thead">
                <tr>
                    <th>نمبر</th>
    				<th>فروخت کا سامان</th>
    				<th>مقدار</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($saleStocks as $key => $saleStock)
                <tr>
                    <td>{{ ++$key }}</td>
					<td>{{ $saleStock->saleItem->name }}</td>
					<td>{{ $saleStock->quantity }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection