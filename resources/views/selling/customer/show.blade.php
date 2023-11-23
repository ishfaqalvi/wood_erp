@extends('layouts.app')

@section('title')
    {{ $customer->name ?? "Show Customer" }}
@endsection

@section('header')
<div class="page-header-content d-lg-flex">
    <div class="d-flex">
        <h4 class="page-title mb-0">
            Home - <span class="fw-normal">Customer Managment</span>
        </h4>
    </div>
    <div class="d-lg-block my-lg-auto ms-lg-auto">
        <div class="d-sm-flex align-items-center mb-3 mb-lg-0 ms-lg-3">
            <a href="{{ route('customers.index') }}" class="btn btn-outline-primary btn-labeled btn-labeled-start rounded-pill">
                <span class="btn-labeled-icon bg-primary text-white rounded-pill">
                    <i class="ph-arrow-circle-left"></i>
                </span>
                Back
            </a>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">{{ __('Show') }} Customer</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-sm-6 col-xl-4">
                    <div class="card card-body bg-primary text-white">
                        <div class="d-flex align-items-center">
                            <i class="ph-arrow-fat-left ph-2x opacity-75 me-3"></i>
                            <div class="flex-fill text-end">
                                <h4 class="mb-0">
                                    {{ number_format($customer->details()->where('type','Received')->sum('amount') )}}
                                </h4>
                                Total Received
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
                                    {{ number_format($customer->details()->where('type','Paid')->sum('amount') )}}
                                </h4>
                                Total Paid
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
                                    {{ number_format($customer->details()->where('type','Received')->sum('amount') - $customer->details()->where('type','Paid')->sum('amount') )}}
                                </h4>
                                Current Balance
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="table-responsive border rounded">
                <table class="table">
                    <thead class="thead">
                        <tr>
                            <th>No</th>
                            <th>Reference</th>
                            <th>Detail</th>
                            <th>Date</th>
                            <th>Type</th>
                            <th>Amount</th>
                            <th>Balance</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($customer->details()->latest('id')->get() as $key => $customerDetail)
                        <tr>
                            <td>{{ ++$key }}</td>
                            <td>{{ $customerDetail->reference }}</td>
                            <td>{{ $customerDetail->detail }}</td>
                            <td>{{ date('d M Y', $customerDetail->date) }}</td>
                            <td>
                                <span class="badge {{ $customerDetail->type == 'Paid' ? 'bg-success' : 'bg-secondary'}}">{{ $customerDetail->type }}</span>
                            </td>
                            <td>{{ number_format($customerDetail->amount) }}</td>
                            <td>{{ number_format($customerDetail->balance) }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection