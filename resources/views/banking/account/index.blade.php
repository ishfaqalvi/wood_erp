@extends('layouts.app')

@section('title')
    اکاؤنٹ کا انتظام  
@endsection

@section('header')
<div class="page-header-content d-lg-flex">
    <div class="d-flex">
        <h4 class="page-title mb-0">
            <span class="fw-normal">اکاؤنٹ کا انتظام  </span>
        </h4>
    </div>
    @can('accounts-create')
    <div class="d-lg-block my-lg-auto ms-lg-auto">
        <div class="d-sm-flex align-items-center mb-3 mb-lg-0 ms-lg-3">
            <a href="{{ route('accounts.create') }}" class="btn btn-outline-primary btn-labeled btn-labeled-start rounded-pill">
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
            <h5 class="mb-0">اکاؤنٹ    </h5>
        </div>
        <table class="table datatable-basic">
            <thead class="thead">
                <tr>
                    <th>نمبر</th>
					<th>بینک</th>
					<th>عنوان</th>
					<th>نمبر</th>
					<th>بیلنس</th>
					<th>پیدا کیا</th>
                    <th class="text-center">اعمال</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($accounts as $key => $account)
                <tr>
                    <td>{{ ++$key }}</td>
					<td>{{ $account->bank->title }}</td>
					<td>
                        {{ $account->title }}
                        @if($account->default == 'Yes')
                            <span class="badge bg-success rounded-pill">ڈیفالٹ  </span>
                        @endif
                    </td>
					<td>{{ $account->number }}</td>
					<td>{{ number_format($account->balance) }}</td>
					<td>{{ $account->creator->name }}</td>
                    <td class="text-center">@include('banking.account.actions')</td>
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