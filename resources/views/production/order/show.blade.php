@extends('layouts.app')

@section('title')
    {{ $order->name ?? "Show Order" }}
@endsection

@section('header')
<div class="page-header-content d-lg-flex">
    <div class="d-flex">
        <h4 class="page-title mb-0">
            Home - <span class="fw-normal">Order Managment</span>
        </h4>
    </div>
    <div class="d-lg-block my-lg-auto ms-lg-auto">
        <div class="d-sm-flex align-items-center mb-3 mb-lg-0 ms-lg-3">
            <a href="{{ route('orders.index') }}" class="btn btn-outline-primary btn-labeled btn-labeled-start rounded-pill">
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
        <div class="card-header d-flex align-items-center py-0">
            <h5 class="py-3 mb-0">{{ __('Show') }} Order</h5>
            @if($order->status == 'Posted')
            <div class="d-inline-flex ms-auto">
                <button type="button" class="btn btn-light ms-3"  onclick="printContent('print');">
                    <i class="ph-printer me-2"></i> Print
                </button>
            </div>
            @endif
        </div>
        <div id="print">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-6">
                    <div class="mb-4">
                        <div class="d-inline-flex align-items-center mt-2 mb-3">
                            <img src="https://demo.interface.club/limitless/demo/template/assets/images/logo_icon.svg" class="h-24px" alt="">
                            <h4 class="d-none d-sm-inline-block text-body mb-0 ms-2">New Pine Woods</h4>
                        </div>
                        <ul class="list list-unstyled mt-2 mb-0">
                            <li>2269 Elba Lane</li>
                            <li>Paris, France</li>
                            <li>888-555-2311</li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="text-sm-end mb-4">
                        <h4 class="text-primary mb-2 mt-lg-2">
                            Order # {{ $order->order_number }}
                        </h4>
                        <ul class="list list-unstyled mb-0">
                            <li>Issue Date: 
                                <span class="fw-semibold">
                                    {{ date('d M Y',$order->issue_date) }}
                                </span>
                            </li>
                            <li>Receive Date: 
                                <span class="fw-semibold">
                                    {{ date('d M Y',$order->receive_date) }}
                                </span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="d-lg-flex flex-lg-wrap">
                <div class="mb-4 mb-lg-2">
                    <span class="text-muted">Order To:</span>
                    <ul class="list list-unstyled mb-0">
                        <li><h5 class="my-2">{{ $order->worker->name }}</h5></li>
                        <li><span class="fw-semibold">{{ $order->worker->phone }}</span></li>
                        <li>{{ $order->worker->address }}</li>
                    </ul>
                </div>
                <div class="mb-2 ms-auto">
                    <span class="text-muted">Shop Details:</span>
                    <div class="d-flex flex-wrap wmin-lg-400">
                        <ul class="list list-unstyled mb-0">
                            <li><h5 class="my-2">Shop Name:</h5></li>
                            <li>Owner name:</li>
                            <li>Phone:</li>
                            <li>Address:</li>
                        </ul>
                        <ul class="list list-unstyled text-end mb-0 ms-auto">
                            <li><h5 class="my-2">{{ $order->shop->name }}</h5></li>
                            <li><span class="fw-semibold">{{ $order->shop->owner_name }}</span></li>
                            <li>{{ $order->shop->mobile_number }}</li>
                            <li>{{ $order->shop->address }}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body d-sm-flex align-items-sm-center justify-content-sm-between flex-sm-wrap">
            <div class="d-flex align-items-center mb-3 mb-sm-0">
                <div class="ms-3">
                    <div class="d-flex align-items-center">
                        <h5 class="mb-0">Issue Stock Items</h5>
                    </div>
                </div>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-lg">
                <thead>
                    <tr>
                        <th>Item</th>
                        <th>Lenght(MM)</th>
                        <th>Width(MM)</th>
                        <th>Thikness(MM)</th>
                        <th>Quantity</th>
                    </tr>
                </thead>
                <tbody>
                    @php($issueTotal = 0)
                    @php($issueMeasurement = 0)
                    @foreach($order->issueItems as $item)
                    <tr>
                        <td><div class="fw-bold">{{ $item->purchaseItem->name }}</div></td>
                        <td><span class="text-muted">{{ $item->purchaseItem->length }}</span></td>
                        <td><span class="text-muted">{{ $item->purchaseItem->width }}</span></td>
                        <td><span class="text-muted">{{ $item->purchaseItem->thikness }}</span></td>
                        <td>
                            <span class="fw-semibold">
                                {{ number_format($item->quantity) }}
                            </span>
                            @php($issueTotal += $item->quantity)
                            @php($issueMeasurement += getMeasurement($item->purchaseItem,$item->quantity))
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-body border-top">
            <div class="d-lg-flex flex-lg-wrap">
                <div class="pt-2 mb-3">
                    <h6 class="mb-3">Stock Incharge Signature</h6>
                    <div class="mb-3"></div>
                </div>
                <div class="pt-2 mb-3 wmin-lg-400 ms-auto">
                    <h6 class="mb-3">Total Detail</h6>
                    <div class="table-responsive">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <th>Total Bundle:</th>
                                    <td class="text-end">{{ count($order->issueItems) }}</td>
                                </tr>
                                <tr>
                                    <th>Total Quantity:</th>
                                    <td class="text-end">{{ $issueTotal }}</td>
                                </tr>
                                <tr>
                                    <th>Total Measurment(CM):</th>
                                    <td class="text-end text-primary">
                                        <h5 class="fw-semibold">{{ $issueMeasurement }}</h5>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body d-sm-flex align-items-sm-center justify-content-sm-between flex-sm-wrap">
            <div class="d-flex align-items-center mb-3 mb-sm-0">
                <div class="ms-3">
                    <div class="d-flex align-items-center">
                        <h5 class="mb-0">Plan Receive Items</h5>
                    </div>
                </div>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-lg">
                <thead>
                    <tr>
                        <th>Item</th>
                        <th>Plan Quantity</th>
                        <th>Product Quantity</th>
                    </tr>
                </thead>
                <tbody>
                    @php($planTotal = 0)
                    @foreach($order->receiveItems as $item)
                    <tr>
                        <td><div class="fw-bold">{{ $item->saleItem->name }}</div></td>
                        <td>{{ $item->plan_quantity }}</td>
                        <td></td>
                        @php($planTotal += $item->plan_quantity)
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-body border-top">
            <div class="d-lg-flex flex-lg-wrap">
                <div class="pt-2 mb-3">
                    <h6 class="mb-3">Stock Incharge Signature</h6>
                    <div class="mb-3"></div>
                </div>
                <div class="pt-2 mb-3 wmin-lg-400 ms-auto">
                    <h6 class="mb-3">Total Detail</h6>
                    <div class="table-responsive">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <th>Total Item:</th>
                                    <td class="text-end">{{ count($order->receiveItems) }}</td>
                                </tr>
                                <tr>
                                    <th>Total Plan Quantity:</th>
                                    <td class="text-end text-primary">
                                        <h5 class="fw-semibold">{{ $planTotal }}</h5>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    function printContent(el){
        var restorepage = $('body').html();
        var printcontent = $('#' + el).clone();
        $('body').empty().html(printcontent);
        window.print();
        $('body').html(restorepage);
    }
</script>
@endsection