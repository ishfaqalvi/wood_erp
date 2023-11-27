@extends('layouts.app')

@section('title')
    آرڈر ایشو میٹریل
@endsection

@section('header')
<div class="page-header-content d-lg-flex">
    <div class="d-flex">
        <h4 class="page-title mb-0">
            <span class="fw-normal">آرڈر مینجمنٹ</span>
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
            @if($order->status =='Pending' && count($order->receiveItems)>0)
            <form method="POST" action="{{ route('orders.post', $order->id) }}">
                @csrf
                {{ method_field('PATCH') }}
                <button type="submit" class="btn btn-outline-primary btn-labeled btn-labeled-start rounded-pill ms-2 sa-post">
                    <span class="btn-labeled-icon bg-primary text-white rounded-pill">
                        <i class="ph-arrow-u-up-right"></i>
                    </span>
                    پوسٹ
                </button>
            </form>
            @endif
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header d-flex align-items-center">
            <h5 class="mb-0">آرڈر ایشو میٹریل</h5>
            <div class="d-inline-flex ms-auto">
                <span class="badge bg-success rounded-pill">{{ $order->status }}</span>
            </div>
        </div>
        <div class="card-body d-sm-flex align-items-sm-center justify-content-sm-between flex-sm-wrap">
            <div class="d-flex align-items-center mb-3 mb-sm-0">
                <div class="ms-3">
                    <div class="d-flex align-items-center">
                        <h5 class="mb-0">{{ $order->shop->name }}</h5>
                    </div>
                    <span class="d-inline-block bg-success rounded-pill p-1 me-1"></span>
                    <span class="text-muted">آرڈر نمبر: {{ $order->order_number }}</span>
                </div>
            </div>

            <div class="d-flex align-items-center mb-3 mb-sm-0">
                <div class="ms-3">
                    <div class="d-flex align-items-center">
                        <h5 class="mb-0">{{ $order->worker->name }}</h5>
                    </div>
                    <span class="d-inline-block bg-danger rounded-pill p-1 me-1"></span>
                    <span class="text-muted">پلان کی تاریخ: {{ date('d M Y', $order->issue_date) }}</span>
                </div>
            </div>
            @if($order->status =='Pending')
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
                            <h5 class="mb-0">{{ $order->status }}</h5>
                        </div>
                        <span class="d-inline-block bg-success rounded-pill p-1 me-1"></span>
                        <span class="text-muted">کی طرف سے پوسٹ کیا گیا: {{ $order->editor->name }}</span>
                    </div>
                </div>
            @endif
        </div>
        <div class="table-responsive">
            <table class="table text-nowrap">
                <thead>
                    <tr>
                        <th>آئٹم</th>
                        <th>لمبائی(MM)</th>
                        <th>چوڑائی(MM)</th>
                        <th>موٹائی(MM)</th>
                        <th>مقدار</th>
                        @if($order->status =='Pending')
                        <th class="text-center" style="width: 20px;">
                            <i class="ph-dots-three"></i>
                        </th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @php($total = 0)
                    @foreach($order->issueItems as $item)
                    <tr>
                        <td>{{ $item->purchaseStock->name }}</td>
                        <td><span class="text-muted">{{ $item->purchaseStock->length }}</span></td>
                        <td><span class="text-muted">{{ $item->purchaseStock->width }}</span></td>
                        <td><span class="text-muted">{{ $item->purchaseStock->thikness }}</span></td>
                        <td>
                            <h6 class="mb-0">{{ number_format($item->quantity) }}</h6>
                            @php($total += $item->quantity)
                        </td>
                        @if($order->status =='Pending')
                        <td class="text-center">
                            <div class="d-inline-flex">
                                <form action="{{ route('order.issue.items.destroy',$item->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm text-danger mx-2 sa-confirm">
                                        <span><i class="ph-trash"></i></span>
                                    </button>
                                </form>
                            </div>
                        </td>
                        @endif
                    </tr>
                    @endforeach
                    <tr class="table-light">
                        <td colspan="{{ $order->status =='Pending' ? '5': '4'}}">کل</td>
                        <td class="text-end">
                            <h6 class="mb-0">{{ number_format($total) }}</h6>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@include('production.order.issue-item.create')
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
                        url: "{{ route('order.issue.items.checkQty') }}",
                        type: "POST",
                        data: {
                            _token: _token,
                            quantity: function() {
                                return $("#quantity").val();
                            },
                            stock_id: function() {
                                return $("#purchase_stock_id").val();
                            }
                        },
                    }
                }
            },
            messages:{
                quantity: {
                    required: "براہ کرم ایک مقدار درج کریں۔.",
                    remote: "یہ مقدار اسٹاک میں دستیاب نہیں ہے۔"
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
        $(".sa-post").click(function (event) {
            event.preventDefault();
            swalInit.fire({
                title: 'کیا تمہیں یقین ہے؟',
                text: "آپ اسے واپس نہیں کر سکیں گے!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'جی ہاں، اسے پوسٹ کریں!',
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