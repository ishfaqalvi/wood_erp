@extends('layouts.app')

@section('title')
    انوائس کا انتظام
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
            @if($invoice->status == 'Posted')
            <a href="{{ route('invoices.print', $invoice->id) }}" class="btn btn-outline-primary btn-labeled btn-labeled-start rounded-pill ms-2">
                <span class="btn-labeled-icon bg-primary text-white rounded-pill">
                    <i class="ph-printer"></i>
                </span>
                پرنٹ کریں
            </a>
            @endif
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header d-flex align-items-center">
            <h5 class="mb-0">{{ __('انوائس دکھائیں۔') }}</h5>
            <div class="d-inline-flex ms-auto">
                <span class="badge bg-success rounded-pill">{{ $invoice->status }}</span>
            </div>
        </div>
        <div class="card-body d-sm-flex align-items-sm-center justify-content-sm-between flex-sm-wrap">
            <div class="d-flex align-items-center mb-3 mb-sm-0">
                <div class="ms-3">
                    <div class="d-flex align-items-center">
                        <h5 class="mb-0">{{ $invoice->invoice_number }}</h5>
                    </div>
                    <span class="d-inline-block bg-success rounded-pill p-1 me-1"></span>
                    <span class="text-muted">{{ date('d M Y', $invoice->invoice_date) }}:انوائس کی تاریخ   </span>
                </div>
            </div>
            <div class="d-flex align-items-center mb-3 mb-sm-0">
                <div class="ms-3">
                    <div class="d-flex align-items-center">
                        <h5 class="mb-0">{{ $invoice->customer->name }}</h5>
                    </div>
                </div>
            </div>
            @if($invoice->status !='Posted')
            <div>
                <a href="#" class="btn btn-indigo" data-bs-toggle="modal" data-bs-target="#addItem">
                    <i class="ph-plus me-2"></i>
                    آئٹم شامل کریں۔
                </a>
            </div>
            @else
                <div class="d-flex align-items-center mb-3 mb-sm-0">
                    <div class="ms-3">
                        <div class="d-flex align-items-center">
                            <h5 class="mb-0">{{ $invoice->status }}</h5>
                        </div>
                        <span class="d-inline-block bg-success rounded-pill p-1 me-1"></span>
                        <span class="text-muted">Posted By: {{ $invoice->editor->name }}</span>
                    </div>
                </div>
            @endif
        </div>
        <div class="table-responsive">
            <table class="table text-nowrap">
                <thead>
                    <tr>
                        <th>گودام  </th>
                        <th>آئٹم</th>
                        <th>مقدار (فٹ)</th>
                        <th>بنڈل کی مقدار  </th> 
                        <th>ریٹ/فی فٹ</th>
                        <th>رقم</th>
                        @if($invoice->status !='Posted')
                        <th class="text-center" style="width: 20px;">
                            <i class="ph-dots-three"></i>
                        </th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @php($total = 0)
                    @foreach($invoice->saleItems as $item)
                    <tr>
                        <td>{{ $item->warehouse->name }}</td>
                        <td>{{ $item->saleItem->name }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>{{ $item->bundle_quantity }}</td>
                        <td><span class="text-success">{{ $item->rate }}</span></td>
                        <td>
                            @php($amount = $item->quantity * $item->rate)
                            <h6 class="mb-0">{{ number_format($amount) }}</h6>
                            @php($total += $amount)
                        </td>
                        @if($invoice->status !='Posted')
                        <td class="text-center">
                            <div class="d-inline-flex">
                                <a href="#" class="btn btn-sm text-primary" data-bs-toggle="modal" data-bs-target="#editItem{{$item->id}}">
                                    <i class="ph-pen"></i>
                                </a>
                                <form action="{{ route('invoice.items.destroy',$item->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    {{ Form::hidden('type', 'Fancy') }}
                                    <button type="submit" class="btn btn-sm text-danger mx-2 sa-confirm">
                                        <span><i class="ph-trash"></i></span>
                                    </button>
                                </form>
                            </div>
                        </td>
                        @endif
                    </tr>
                    @include('selling.invoice.sale-item.edit')
                    @endforeach
                    <tr class="table-light">
                        <td colspan="{{ $invoice->status !='Posted' ? '6': '5'}}">Total</td>
                        <td class="text-end">
                            <h6 class="mb-0">{{ number_format($total) }}</h6>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@include('selling.invoice.sale-item.create')
@endsection

@section('script')
<script>
    $(function(){
        $(".select").select2({ dropdownParent: $("#addItem") });
        var _token = $("input[name='_token']").val();
        $('.validate').validate({
            errorClass: 'validation-invalid-label',
            successClass: 'validation-valid-label',
            validClass: 'validation-valid-label',
            highlight: function(element, errorClass) {
                $(element).removeClass(errorClass);
                $(element).addClass('is-invalid');
                $(element).removeClass('is-valid');
            },
            unhighlight: function(element, errorClass) {
                $(element).removeClass(errorClass);
                $(element).removeClass('is-invalid');
                $(element).addClass('is-valid');
            },
            success: function(label) {
                label.addClass('validation-valid-label').text('Success.');
            },
            errorPlacement: function(error, element) {
                if (element.hasClass('select2-hidden-accessible')) {
                    error.appendTo(element.parent());
                }else if (element.parents().hasClass('form-control-feedback') || element.parents().hasClass('form-check') || element.parents().hasClass('input-group')) {
                    error.appendTo(element.parent().parent());
                }else {
                    error.insertAfter(element);
                }
            },
            rules:{
                quantity: {
                    required: true,
                    digits: true,
                    "remote": {
                        url: "{{ route('invoice.items.checkQty') }}",
                        type: "POST",
                        data: {
                            _token: _token,
                            type: 'Sale',
                            quantity: function() {
                                return $("#quantity").val();
                            },
                            item_id: function() {
                                return $("#createItem").val();
                            },
                            warehouse_id: function() {
                                return $("#warehouseId").val();
                            }
                        },
                    }
                }
            },
            messages:{
                quantity: {
                    required: "براہ کرم ایک مقدار درج کریں۔",
                    remote: "آپ کی درج کردہ مقدار اسٹاک میں دستیاب نہیں ہے۔"
                }
            }
        });
        const swalInit = swal.mixin({
            buttonsStyling: false,
            customClass: {
                confirmButton: 'btn btn-primary',
                cancelButton: 'btn btn-light',
                denyButton: 'btn btn-light',
                input: 'form-control'
            }
        });
        $(".sa-confirm").click(function (event) {
            event.preventDefault();
            swalInit.fire({
                title: 'کیا تمہیں یقین ہے؟',
                text: "آپ اسے واپس نہیں کر سکیں گے!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'جی ہاں، اسے حذف کریں!',
                cancelButtonText: 'نہیں، منسوخ کریں!',
                buttonsStyling: false,
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                }
            }).then((result) => {
                if (result.value === true)  $(this).closest("form").submit();
            });
        });
    });
</script>
@endsection