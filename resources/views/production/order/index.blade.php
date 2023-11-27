@extends('layouts.app')

@section('title')
    آرڈر
@endsection

@section('header')
<div class="page-header-content d-lg-flex">
    <div class="d-flex">
        <h4 class="page-title mb-0">
            <span class="fw-normal">آرڈر مینجمنٹ</span>
        </h4>
    </div>
    @can('orders-create')
    <div class="d-lg-block my-lg-auto ms-lg-auto">
        <div class="d-sm-flex align-items-center mb-3 mb-lg-0 ms-lg-3">
            <a href="{{ route('orders.create') }}" class="btn btn-outline-primary btn-labeled btn-labeled-start rounded-pill">
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
            <h5 class="mb-0">آرڈر </h5>
        </div>
        <table class="table datatable-basic">
            <thead class="thead">
                <tr>
                    <th>نمبر</th>
                    <th>آرڈر  #</th>
					<th>دکان</th>
					<th>ورکر</th>
					<th>تاریخ اجراء</th>
					<th>تاریخ وصول کریں۔</th>
					<th>حالت</th>
					<th>پیدا کیا</th>
                    <th class="text-center">اعمال</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($orders as $key => $order)
                <tr>
                    <td>{{ ++$key }}</td>
                    <td>{{ $order->order_number }}</td>
					<td>{{ $order->shop->name }}</td>
					<td>{{ $order->worker->name }}</td>
					<td>{{ date('d-m-Y', $order->issue_date) }}</td>
					<td>{{ date('d-m-Y', $order->receive_date) }}</td>
					<td>
                        @if($order->status == 'Received')
                            @php($bg = 'bg-success')
                        @elseif($order->status == 'Posted')
                            @php($bg = 'bg-info')
                        @else
                            @php($bg = 'bg-secondary')
                        @endif
                        <span class="badge {{ $bg }}">{{ $order->status }}</span>
                    </td>
					<td>{{ $order->creator?->name }}</td>
                    <td class="text-center">@include('production.order.actions')</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

@section('script')
<script>
    $(function () {
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