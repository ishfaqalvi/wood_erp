@extends('admin.layout.app')

@section('title')
    Vendor Detail
@endsection

@section('header')
<div class="page-header-content d-lg-flex">
    <div class="d-flex">
        <h4 class="page-title mb-0">
            Home - <span class="fw-normal">Vendor Detail Managment</span>
        </h4>
    </div>
    @can('vendor-details-create')
    <div class="d-lg-block my-lg-auto ms-lg-auto">
        <div class="d-sm-flex align-items-center mb-3 mb-lg-0 ms-lg-3">
            <a href="{{ route('vendor-details.create') }}" class="btn btn-outline-primary btn-labeled btn-labeled-start rounded-pill">
                <span class="btn-labeled-icon bg-primary text-white rounded-pill">
                    <i class="ph-plus"></i>
                </span>
                Create New
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
            <h5 class="mb-0">Vendor Detail</h5>
        </div>
        <table class="table datatable-basic">
            <thead class="thead">
                <tr>
                    <th>No</th>
                    
										<th>Vendor Id</th>
										<th>Reference</th>
										<th>Detail</th>
										<th>Date</th>
										<th>Type</th>
										<th>Amount</th>
										<th>Balance</th>

                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($vendorDetails as $key => $vendorDetail)
                <tr>
                    <td>{{ ++$key }}</td>
                    
											<td>{{ $vendorDetail->vendor_id }}</td>
											<td>{{ $vendorDetail->reference }}</td>
											<td>{{ $vendorDetail->detail }}</td>
											<td>{{ $vendorDetail->date }}</td>
											<td>{{ $vendorDetail->type }}</td>
											<td>{{ $vendorDetail->amount }}</td>
											<td>{{ $vendorDetail->balance }}</td>

                    <td class="text-center">@include('admin.vendor-detail.actions')</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
@canany(['vendor-details-view', 'vendor-details-edit', 'vendor-details-delete'])
<div class="d-inline-flex">
    <div class="dropdown">
        <a href="#" class="text-body" data-bs-toggle="dropdown">
            <i class="ph-list"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-end">
            <form action="{{ route('vendor-details.destroy',$vendorDetail->id) }}" method="POST">
                @csrf
                @method('DELETE')
                @can('vendor-details-view')
                    <a href="{{ route('vendor-details.show',$vendorDetail->id) }}" class="dropdown-item">
                        <i class="ph-eye me-2"></i>{{ __('Show') }}
                    </a>
                @endcan
                @can('vendor-details-edit')
                    <a href="{{ route('vendor-details.edit',$vendorDetail->id) }}" class="dropdown-item">
                        <i class="ph-note-pencil me-2"></i>{{ __('Edit') }}
                    </a>
                @endcan
                @can('vendor-details-delete')
                    <button type="submit" class="dropdown-item sa-confirm">
                        <i class="ph-trash me-2"></i>{{ __('Delete') }}
                    </button>
                @endcan
            </form>
        </div>
    </div>
</div>
@endcanany
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
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
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