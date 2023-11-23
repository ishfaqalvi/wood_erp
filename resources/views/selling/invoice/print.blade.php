@extends('layouts.app')

@section('title')
    {{ "Pirnt Invoice" }}
@endsection

@section('header')
<div class="page-header-content d-lg-flex">
    <div class="d-flex">
        <h4 class="page-title mb-0">
            Home - <span class="fw-normal">Invoice Managment</span>
        </h4>
    </div>
    <div class="d-lg-block my-lg-auto ms-lg-auto">
        <div class="d-sm-flex align-items-center mb-3 mb-lg-0 ms-lg-3">
            <a href="{{ route('invoices.index') }}" class="btn btn-outline-primary btn-labeled btn-labeled-start rounded-pill">
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
        <div class="card-header d-flex align-items-center py-0">
            <h5 class="py-3 mb-0">{{ __('Show') }} Invoice Print</h5>
            @if($invoice->status == 'Posted')
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
                            Invoice # {{ $invoice->invoice_number }}
                        </h4>
                        <ul class="list list-unstyled mb-0">
                            <li>Invoice Date: 
                                <span class="fw-semibold">
                                    {{ date('d M Y',$invoice->invoice_date) }}
                                </span>
                            </li>
                            <li>Due Date: 
                                <span class="fw-semibold">
                                    {{ date('d M Y',$invoice->due_date) }}
                                </span>
                            </li>
                            <li>Meterial Type: 
                                <span class="fw-semibold">
                                    {{ $invoice->type }}
                                </span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="d-lg-flex flex-lg-wrap">
                <div class="mb-4 mb-lg-2">
                    <span class="text-muted">Invoice To:</span>
                    <ul class="list list-unstyled mb-0">
                        <li><h5 class="my-2">{{ $invoice->customer->name }}</h5></li>
                        <li><span class="fw-semibold">{{ $invoice->customer->phone }}</span></li>
                        <li>{{ $invoice->customer->address }}</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-lg">
                <thead>
                    <tr>
                        <th>Item</th>
                        <th>Quantity</th>
                        <th>Rate</th>
                        <th>Amount</th>
                    </tr>
                </thead>
                <tbody>
                    @php($total = 0)
                    @php($totalQty = 0)
                    @if($invoice->type == 'Fancy')
                    @foreach($invoice->saleItems as $item)
                    <tr>
                        <td><div class="fw-bold">{{ $item->saleItem->name }}</div></td>
                        <td>
                            <span class="fw-semibold">
                                {{ number_format($item->quantity) }}
                            </span>
                        </td>
                        <td>
                            <span class="fw-semibold">
                                {{ number_format($item->rate) }}
                            </span>
                        </td>
                        <td>
                            @php($amount = $item->rate * $item->quantity)
                            <span class="fw-semibold">
                                {{ number_format($item->rate) }}
                            </span>
                        </td>
                        @php($total += $amount)
                        @php($totalQty += $item->quantity)
                    </tr>
                    @endforeach
                    @else
                    @foreach($invoice->purchaseItems as $item)
                    <tr>
                        <td><div class="fw-bold">{{ $item->purchaseItem->name }}</div></td>
                        <td>
                            <span class="fw-semibold">
                                {{ number_format($item->quantity) }}
                            </span>
                        </td>
                        <td>
                            <span class="fw-semibold">
                                {{ number_format($item->rate) }}
                            </span>
                        </td>
                        <td>
                            @php($amount = $item->rate * $item->quantity)
                            <span class="fw-semibold">
                                {{ number_format($amount) }}
                            </span>
                        </td>
                        @php($total += $amount)
                        @php($totalQty += $item->quantity)
                    </tr>
                    @endforeach
                    @endif
                </tbody>
            </table>
        </div>
        <div class="card-body binvoice-top">
            <div class="d-lg-flex flex-md-wrap">
                <div class="pt-2 mb-3">
                    <h6 class="mb-3">Signature</h6>
                    <div class="mb-3">_______________________</div>
                </div>
                <div class="pt-2 mb-3 wmin-lg-400 ms-auto">
                    <h6 class="mb-3">Total Detail</h6>
                    <div class="table-responsive">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <th>Total Quantity:</th>
                                    <td class="text-end">{{ $totalQty }}</td>
                                </tr>
                                <tr>
                                    <th>Total Amount:</th>
                                    <td class="text-end text-primary">
                                        <h5 class="fw-semibold">{{ $total }}</h5>
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