@extends('layouts.app')

@section('title')
    بلز
@endsection

@section('header')
<div class="page-header-content d-lg-flex">
    <div class="d-flex">
        <h4 class="page-title mb-0">
            <span class="fw-normal">بل مینجمنٹ</span>
        </h4>
    </div>
    @can('bills-create')
    <div class="d-lg-block my-lg-auto ms-lg-auto">
        <div class="d-sm-flex align-items-center mb-3 mb-lg-0 ms-lg-3">
            <a href="{{ route('bills.create') }}" class="btn btn-outline-primary btn-labeled btn-labeled-start rounded-pill">
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
            <h5 class="mb-0">بلز</h5>
        </div>
        <table class="table datatable-basic">
            <thead class="thead">
                <tr>
                    <th>نمبر</th>
                    <th>بل نمبر</th>
					<th>فروش</th>
					<th>بل کی تاریخ</th>
					<th>اخری تاریخ</th>
					<th>پیدا کیا</th>
                    <th>حالت</th>
                    <th class="text-center">اعمال</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($bills as $key => $bill)
                <tr>
                    <td>{{ ++$key }}</td>
                    <td>{{ $bill->bill_number }}</td>
					<td>{{ $bill->vendor->name }}</td>
					<td>{{ date('d-m-Y', $bill->bill_date) }}</td>
					<td>{{ date('d-m-Y', $bill->due_date) }}</td>
					<td>{{ $bill->creator->name }}</td>
                    <td>
                        <span class="badge {{ $bill->status == 'Posted' ? 'bg-success' : 'bg-secondary'}}">{{ $bill->status }}</span>
                    </td>
                    <td class="text-center">@include('purchasing.bill.actions')</td>
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