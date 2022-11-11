@extends('backend.layouts.master')

@section('title')
    Request Membership
@endsection

@section('css')
@endsection

@section('content')
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-left mb-0">Membership Requests</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="{{ route('listAdmins') }}">Membership Requests
                                            List</a>
                                    </li>
                                    <li class="breadcrumb-item active">Add
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <!-- Tooltip validations start -->
                <section id="responsive-datatable">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header border-bottom">
                                    <h4 class="card-title">Membership Requests List</h4>
                                </div>
                                <div class="card-datatable">
                                    <table class="dt-responsive1 table" class="p-2">
                                        <thead>
                                            <tr>
                                                <th>{{ __('ID') }}</th>
                                                <th>{{ __('UserName') }}</th>
                                                <th>{{ __('Description') }}</th>
                                                <th>{{ __('Account Type') }}</th>
                                                <th>{{ __('Actions') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($requests as $type)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $type->user ? $type->user->username : 'N/A' }}</td>
                                                    <td>{{ $type->description }}</td>
                                                    <td>
                                                        <select class="form-select" style="width: 100%; margin:0 auto;"
                                                            aria-label="Default select example" name="account_type"
                                                            onchange="changeStatus('{{ $type->user_id }}', this.value)">
                                                            <option value="" selected disabled> Select Account Types
                                                            </option>
                                                            @foreach ($account_types as $account_type)
                                                                <option value="{{ $account_type->id }}"
                                                                    {{ $type->user ? ($type->user->account_type == $account_type->id ? 'selected' : '') : '' }}>
                                                                    {{ $account_type->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </td>

                                                    <td>
                                                        <div class="dropdown">
                                                            <button type="button"
                                                                class="btn btn-sm dropdown-toggle hide-arrow"
                                                                data-toggle="dropdown">
                                                                <i data-feather="more-vertical"></i>
                                                            </button>
                                                            <div class="dropdown-menu">
                                                                <a class="dropdown-item" id="confirm-delete"
                                                                    style="cursor: pointer"
                                                                    onclick="deleteFunction('{{ $type->id }}')">
                                                                    <i data-feather="trash" class="mr-50"></i>
                                                                    <span>Delete</span>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        const ele = (id) => {
            return document.getElementById(id);
        }

        const deleteFunction = (id) => {
            var route = "{{ route('manage-request.destroy', 'type_id') }}";
            route = route.replace('type_id', id);
            var confirmColor = ele(`confirm-delete`);
            // Confirm Color
            if (confirmColor) {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, delete it!',
                    customClass: {
                        confirmButton: 'btn btn-primary',
                        cancelButton: 'btn btn-outline-danger ml-1'
                    },
                    buttonsStyling: false
                }).then(function(result) {
                    if (result.value) {
                        $.ajax({
                            method: "DELETE",
                            url: route,
                            data: {
                                _token: $('meta[name="csrf-token"]').attr('content'),
                                'id': id
                            },
                            success: function(response) {
                                if (response.status === 1) {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Deleted!',
                                        text: 'Your file has been deleted.',
                                        customClass: {
                                            confirmButton: 'btn btn-success'
                                        }
                                    });
                                    window.setTimeout(function() {
                                        location.reload();
                                    }, 1000);
                                } else {
                                    swal("Error While Deleting", {
                                        icon: "error",
                                    });
                                }
                            }
                        });

                    } else if (result.dismiss === Swal.DismissReason.cancel) {
                        Swal.fire({
                            title: 'Cancelled',
                            text: 'Your Data is safe!',
                            icon: 'error',
                            customClass: {
                                confirmButton: 'btn btn-success'
                            }
                        });
                    }
                });
            }
        }

        function changeStatus(id, value) {
            var route = "{{ route('userAccounttype', ':id') }}";
            route = route.replace(":id", id);
            $.ajax({
                type: 'GET',
                url: route,
                data: {
                    account_type: value,
                },
                success: function(response) {
                    if (response.success == true) {
                        toastr.success(response.message);
                        window.location = "{{ route('manage-request.index') }}"
                    } else
                        toastr.error(response.message);
                }
            })
        }
    </script>
@endsection
