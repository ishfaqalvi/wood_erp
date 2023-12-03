@extends('layouts.app')

@section('title')
    {{ "انوائس پرنٹ کریں  " }}
@endsection

@section('header')
<div class="page-header-content d-lg-flex">
    <div class="d-flex">
        <h4 class="page-title mb-0">
            <span class="fw-normal">انوائس کا انتظام</span>
        </h4>
    </div>
    <div class="d-lg-block my-lg-auto ms-lg-auto">
        <div class="d-sm-flex align-items-center mb-3 mb-lg-0 ms-lg-3">
            <a href="{{ route('invoices.index') }}" class="btn btn-outline-primary btn-labeled btn-labeled-start rounded-pill">
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
            <h5 class="py-3 mb-0">{{ __('انوائس پرنٹ دکھائیں۔') }}</h5>
            @if($invoice->status == 'Posted')
            <div class="d-inline-flex ms-auto">
                <button type="button" class="btn btn-light ms-3"  onclick="printContent('print');">
                    <i class="ph-printer me-2"></i> پرنٹ کریں
                </button>
            </div>
            @endif
        </div>
        <div id="print">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="mb-4" dir="rtl">
                            <ul class="list list-unstyled mb-0">
                                <li class="text-primary">بل نمبر  :   
                                    <span class="fw-semibold">
                                        {{ $invoice->invoice_number }}
                                    </span>
                                </li>
                                <li>تاریخ:  
                                    <span class="fw-semibold">
                                        {{ date('d-m-Y',$invoice->invoice_date) }}
                                    </span>
                                </li>
                                <li>  دکاندار کا نام:
                                    <span class="fw-semibold">
                                        {{ $invoice->customer->name }}
                                    </span>
                                </li>
                                <li>دکاندار رابطہ نمبر: 
                                    <span class="fw-semibold">
                                        {{ $invoice->customer->phone }}
                                    </span>
                                </li>
                                <li><span>دکاندار کا پتہ:</span>
                                    <span class="fw-semibold">
                                        {{ $invoice->customer->address }}
                                    </span>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="mb-4 text-sm-center">
                            <ul class="list list-unstyled mb-0">
                                <li>{{ settings('first_contact_person_name') }}</li>
                                <li>{{ settings('first_contact_person_mobile_number') }}</li>
                                <li>{{ settings('second_contact_person_name') }}</li>
                                <li>{{ settings('second_contact_person_mobile_number') }}</li>
                                <li>{{ settings('third_contact_person_name') }}</li>
                                <li>{{ settings('third_contact_person_mobile_number') }}</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="mb-4 text-sm-end">
                            <div class="d-inline-flex align-items-center mt-2 mb-3">
                                <h3 class="d-none d-sm-inline-block text-body mb-0 ms-2" style="font-size: 28px;">
                                    <b>{{ settings('business_name') }}</b>
                                </h3>
                                <h1 class="d-none d-sm-inline-block text-body mb-0 ms-2 fw-bold" style="font-size: 32px;">
                                    <b>{{ settings('company_name') }}</b>
                                </h1>
                            </div>
                            <ul class="list list-unstyled mb-0">
                                <li><b>مالک:   {{ settings('owner_name') }}</b></li>
                                <li><b>{{ settings('address') }}</b></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-sm-8">
                        <div class="text-sm-end"> __________________________________________________ گڈز کا نام  </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="text-sm-end"> ______________________ بلٹی نمبر   </div>
                    </div>
                </div>
            </div>
            <div class="table-responsive px-1 text-sm-end" dir="rtl" style="font-size:18px">
                <table class="table table-bordered table-xs">
                    <thead>
                        <tr>
                            <th>آئٹم</th>
                            <th>مقدار</th>
                            <th>شرح</th>
                            <th>رقم</th>
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
                                    {{ number_format($amount) }}
                                </span>
                            </td>
                            @php($total += $amount)
                            @php($totalQty += $item->quantity)
                        </tr>
                        @endforeach
                        @else
                        @foreach($invoice->purchaseItems as $item)
                        <tr>
                            <td><div class="fw-bold">{{ $item->purchaseStock->name }}</div></td>
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
                                @php($amount = ($item->rate * $item->quantity))
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
            <div class="row mt-2">
                <div class="col-sm-4">
                    <div class="table-responsive text-sm-end" dir="rtl">
                        <table class="table table-xs">
                            <tbody>
                                <tr>
                                    <th>کل مقدار:</th>
                                    <td class="text-end">{{ $totalQty }}</td>
                                </tr>
                                <tr>
                                    <th> موجودہ رقم:</th>
                                    <td class="text-end">{{ number_format($total) }}</td>
                                </tr>
                                <tr>
                                    <th>گزشتہ رقم: </th>
                                    @php($previous = getCustomerLastBalance($invoice->customer))
                                    <td class="text-end">{{ number_format(-($previous)) }}</td>
                                </tr>
                                <tr>
                                    <th>کل رقم:</th>
                                    <td class="text-end"> {{ number_format($total -($previous)) }} </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-sm-4"></div>
                <div class="col-sm-4">
                    <div class="text-sm-center">
                        <div class="pt-2 mt-5">
                            <div class="mb-3">دستخط  </div>
                            <div class="mb-3">_______________________</div>
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