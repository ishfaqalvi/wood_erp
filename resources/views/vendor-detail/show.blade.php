@extends('admin.layout.app')

@section('title')
    {{ $vendorDetail->name ?? "Show Vendor Detail" }}
@endsection

@section('header')
<div class="page-header-content d-lg-flex">
    <div class="d-flex">
        <h4 class="page-title mb-0">
            Home - <span class="fw-normal">Vendor Detail Managment</span>
        </h4>
    </div>
    <div class="d-lg-block my-lg-auto ms-lg-auto">
        <div class="d-sm-flex align-items-center mb-3 mb-lg-0 ms-lg-3">
            <a href="{{ route('vendor-details.index') }}" class="btn btn-outline-primary btn-labeled btn-labeled-start rounded-pill">
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
            <h5 class="mb-0">{{ __('Show') }} Vendor Detail</h5>
        </div>
        <div class="card-body">
            
                        <div class="form-group mb-3">
                            <strong>Vendor Id:</strong>
                            {{ $vendorDetail->vendor_id }}
                        </div>
                        <div class="form-group mb-3">
                            <strong>Reference:</strong>
                            {{ $vendorDetail->reference }}
                        </div>
                        <div class="form-group mb-3">
                            <strong>Detail:</strong>
                            {{ $vendorDetail->detail }}
                        </div>
                        <div class="form-group mb-3">
                            <strong>Date:</strong>
                            {{ $vendorDetail->date }}
                        </div>
                        <div class="form-group mb-3">
                            <strong>Type:</strong>
                            {{ $vendorDetail->type }}
                        </div>
                        <div class="form-group mb-3">
                            <strong>Amount:</strong>
                            {{ $vendorDetail->amount }}
                        </div>
                        <div class="form-group mb-3">
                            <strong>Balance:</strong>
                            {{ $vendorDetail->balance }}
                        </div>

        </div>
    </div>
</div>
@endsection