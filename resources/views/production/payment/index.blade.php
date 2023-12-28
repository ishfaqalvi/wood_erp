@extends('layouts.app')

@section('title')
    پیداوار کی ادائیگی
@endsection

@section('header')
<div class="page-header-content d-lg-flex">
    <div class="d-flex">
        <h4 class="page-title mb-0">
            <span class="fw-normal">پیداوار کی ادائیگی کا انتظام</span>
        </h4>
    </div>
    @can('productionPayments-create')
    <div class="d-lg-block my-lg-auto ms-lg-auto">
        <div class="d-sm-flex align-items-center mb-3 mb-lg-0 ms-lg-3">
            <a href="{{ route('production-payments.create') }}" class="btn btn-outline-primary btn-labeled btn-labeled-start rounded-pill">
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
            <h5 class="mb-0">پیداوار کی ادائیگی</h5>
        </div>
        <table class="table datatable-basic">
            <thead class="thead">
                <tr>
                    <th>ٹرانزکشن  </th>
                    <th>ورکر</th>
                    <th>قسم</th>
                    <th>تاریخ</th>
                    <th>رقم</th>
                    <th>پیدا کیا</th>
                    <th>ترمیم</th>
                    <th>حالت</th>
                    <th class="text-center">اعمال</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($productionPayments as $key => $productionPayment)
                <tr>
                    <td>{{ $productionPayment->transaction_id }}</td>
                    <td>{{ $productionPayment->worker->name }}</td>
                    <td>{{ $productionPayment->type }}</td>
                    <td>{{ date('d-m-Y',$productionPayment->date) }}</td>
                    <td>{{ number_format($productionPayment->amount) }}</td>
                    <td>{{ $productionPayment->creator?->name }}</td>
                    <td>{{ $productionPayment->editor?->name }}</td>
                    <td>
                        <span class="badge {{ $productionPayment->status == 'Pending' ? 'bg-secondary' : 'bg-success'}}">{{ $productionPayment->status }}</span>
                    </td>
                    <td class="text-center">@include('production.payment.actions')</td>
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
        $(".sa-approve").click(function (event) {
            event.preventDefault();
            swalInit.fire({
                title: 'کیا تمہیں یقین ہے؟',
                text: "آپ اسے واپس نہیں کر سکیں گے!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'ہاں، اسے منظور کرو!',
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