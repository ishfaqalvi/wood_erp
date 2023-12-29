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
        <div class="card-body" id="print">
            <div class="row">
                <div class="col-sm-4">
                    <ul class="list list-unstyled mb-0">
                        <li class="mt-0">
                            <b>{{ settings('first_contact_person_mobile_number') }}</b>
                            : {{ settings('first_contact_person_name') }}
                        </li>
                        <li>
                            <b>{{ settings('second_contact_person_mobile_number') }}</b>
                            : {{ settings('second_contact_person_name') }}
                        </li>
                        <li>
                            <b>{{ settings('third_contact_person_mobile_number') }}</b>
                            : {{ settings('third_contact_person_name') }}
                        </li>
                        <li>
                            <b>{{ settings('fourth_contact_person_mobile_number') }}</b>
                            : {{ settings('fourth_contact_person_name') }}
                        </li>
                        <li>
                            <b>{{ settings('fifth_contact_person_mobile_number') }}</b>
                            : {{ settings('fifth_contact_person_name') }}
                        </li>
                        <li class="mt-1">
                            <b>{{ $invoice->invoice_number }}</b>
                            : بل نمبر
                        </li>
                        <li class="mt-1">
                            <b>{{ date('d-m-Y',$invoice->invoice_date) }}</b>
                            :تاریخ 
                        </li>
                    </ul>
                </div>
                <div class="col-sm-2">
                    
                </div>
                <div class="col-sm-6">
                    <div class="text-sm-end">
                        <div class="d-inline-flex align-items-center">
                            <h3 class="d-none d-sm-inline-block text-body mb-0 ms-2" style="font-size: 43px;">
                                <b>{{ settings('business_name') }}</b>
                            </h3>
                            <h1 class="d-none d-sm-inline-block text-body mb-0 ms-2 fw-bold" style="font-size: 44px;">
                                <b>{{ settings('company_name') }}</b>
                            </h1>
                        </div>
                        <ul class="list list-unstyled mb-0">
                            <li> پروپرائیٹر  :
                                <b>{{ settings('owner_name') }}</b>
                            </li>
                            <li><b>{{ settings('business_heading') }}</b></li>
                            <li><b>{{ settings('business_detail') }}</b></li>
                            <li><b>{{ settings('address') }}</b></li>
                            <li>گڈز کا نام   : <b>{{ $invoice->goods_name }}</b></li>
                            <li><b>{{ $invoice->bilti_number }}</b> :  بلٹی نمبر </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 text-sm-center">
                    <h4 class="d-none d-sm-inline-block text-body" style="font-size: 24px;"> 
                     دکاندار کا نام  : {{ $invoice->customer->name }}
                    </h4>
                </div>
            </div>
            <div class="table-responsive border rounded">
                <table class="table-xs table-bordered text-sm-center" width="100%" align="center">
                    <thead>
                        <tr>
                            <th>رقم</th>
                            <th>ریٹ  </th>
                            <th>تفصیل  </th>
                            <th>فٹ </th>
                            <th> بنڈل تعداد </th>
                            <th># </th>
                        </tr>
                    </thead>
                    <tbody>
                        @php($total = 0)
                        @php($totalQty = 0)
                        @php($count = 0)
                        @if($invoice->type == 'Fancy')
                            @php($count = count($invoice->saleItems))
                            @foreach($invoice->saleItems as $key => $item)
                            <tr>
                               <td width="15%">
                                    @php($amount = $item->rate * $item->quantity)
                                    <span class="fw-semibold">
                                        {{ number_format($amount) }}
                                    </span>
                                </td>
                                <td width="15%">
                                    <span class="fw-semibold">
                                        {{ $item->rate }}
                                    </span>
                                </td>
                                <td width="35%"><div class="fw-bold">{{ $item->saleItem->name }}</div></td>
                                <td width="15%">
                                    <span class="fw-semibold">
                                        {{ number_format($item->quantity) }}
                                    </span>
                                </td>
                                <td width="15%"><div class="fw-bold">{{ $item->bundle_quantity }}</div></td>
                                <td width="5%">{{ ++$key }}</td>
                                @php($total += $amount)
                            </tr>
                            @endforeach
                        @else
                            @php($count = count($invoice->purchaseItems))
                            @foreach($invoice->purchaseItems as $key => $item)
                            <tr>
                                <td width="15%">
                                    @php($amount = ($item->rate * $item->quantity))
                                    <span class="fw-semibold">
                                        {{ number_format($amount) }}
                                    </span>
                                </td>
                                <td width="15%">
                                    <span class="fw-semibold">
                                        {{ $item->rate }}
                                    </span>
                                </td>
                                <td width="35%"><div class="fw-bold">{{ $item->description }}</div></td>
                                <td width="15%">
                                    <span class="fw-semibold">
                                        {{ number_format($item->quantity) }}
                                    </span>
                                </td>
                                <td width="15%"><div class="fw-bold">{{ $item->bundle_quantity }}</div></td>
                                <td width="5%">{{ ++$key }}</td>
                                @php($total += $amount)
                            </tr>
                            @endforeach
                        @endif
                        @for($empty= $count + 1; $empty < 16; ++$empty)
                        <tr>
                            <td></td>
                            <td> </td>
                            <td> </td>
                            <td> </td>
                            <td> </td>
                            <td>{{ $empty}}</td>
                        </tr> 
                        @endfor  
                    </tbody>
                    <tfoot>
                        <tr>
                            <td>
                                {{ number_format($total) }}
                            </td>
                            <td>@if($invoice->return  == 'Yes')
                                واپسی
                                @endifمال  ٹوٹل رقم  </td>
                            <td colspan="4" rowspan="3">
                                <div class="text-sm-center">
                                    <div class="mb-3">دستخط  </div>
                                    <div class="mb-3">_______________________</div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            @php($previous = $invoice->getCustomerLastBalance())
                            <td>{{ number_format(-($previous)) }}</td>
                            <td>سابقہ رقم  </td>
                        </tr>
                        <tr>
                            <td>
                                @if($invoice->return  == 'Yes')
                                {{ number_format($total + ($previous)) }}
                                @else
                                {{ number_format($total -($previous)) }}
                                @endif
                            </td>
                            <td>میزان  </td>
                        </tr>
                    </tfoot>
                </table>
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