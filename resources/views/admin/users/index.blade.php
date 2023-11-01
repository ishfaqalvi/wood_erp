@extends('admin.layout.app')

@section('title', 'Users')

@section('header')
    <div class="page-header-content d-lg-flex">
        <div class="d-flex">
            <h4 class="page-title mb-0">
                Home - <span class="fw-normal">User Managment</span>
            </h4>
        </div>
        @can('users-create')
            <div class="d-lg-block my-lg-auto ms-lg-auto">
                <div class="d-sm-flex align-items-center mb-3 mb-lg-0 ms-lg-3">
                    <button class="btn btn-outline-primary btn-labeled btn-labeled-start rounded-pill me-2 show-filter">
                        <span class="btn-labeled-icon bg-primary text-white rounded-pill">
                            <i class="ph-magnifying-glass"></i>
                        </span>
                        Filter
                    </button>

                    <a href="{{ route('users.create') }}"
                        class="btn btn-outline-primary btn-labeled btn-labeled-start rounded-pill">
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
    <div class="col-md-12 filter-wrapper d-none">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('users.index') }}">
                    <div class="row">
                        <div class="col-md-3">
                            <input type="text" class="form-control" name="name_like" placeholder="Enter name">
                        </div>
                        <div class="col-md-3">
                            <input type="text" class="form-control" name="email" placeholder="Enter email">
                        </div>
                        <div class="col-md-3">
                            <select class="form-control form-select" name="status">
                                <option value="">Select User Status</option>
                                <option value="active">Active</option>
                                <option value="in-active">In-Active</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <button type="submit" class="btn btn-primary w-100">
                                Filter <i class="ph-magnifying-glass ms-2"></i>
                            </button>
                        </div>
                    </div>


                </form>
            </div>
        </div>
    </div>

    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">User</h5>
            </div>
            <table class="table datatable-basic">
                <thead class="thead">
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $key => $user)
                        <tr>
                            <td>{{ ++$key }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                @if (!empty($user->getRoleNames()))
                                    @foreach ($user->getRoleNames() as $v)
                                        <span class="badge bg-primary rounded-pill">{{ $v }}</span>
                                    @endforeach
                                @endif
                            </td>
                            <td class="text-center">@include('admin.users.actions')</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(function() {

            $('.show-filter').click(function() {
                $('.filter-wrapper').toggleClass('d-none');
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
            $(".sa-confirm").click(function(event) {
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
                    if (result.value === true) $(this).closest("form").submit();
                });
            });
        });
    </script>
@endsection
