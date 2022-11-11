@extends('backend.layouts.master')

@section('title')
    List Users
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
                            <h2 class="content-header-title float-left mb-0">Users</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="{{ route('listAdmins') }}">Users List</a>
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
                                    <h4 class="card-title">Bookings List</h4>
                                </div>
                                <div class="card-datatable">
                                    <table class="dt-responsive1 table" class="p-2">
                                        <thead>
                                            <tr>
                                                <th>{{ __('ID') }}</th>
                                                <th>{{ __('Name') }}</th>
                                                <th>{{ __('Email') }}</th>
                                                <th>{{ __('Date Of Birth') }}</th>
                                                <th>{{ __('Gender') }}</th>
                                                <th>{{ __('Cnic') }}</th>
                                                <th>{{ __('Sponser_id') }}</th>
                                                <th>{{ __('Account_type') }}</th>
                                                <th>{{ __('Actions') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($users as $user)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $user->first_name . ' ' . $user->last_name }}</td>
                                                    <td>{{ $user->email }}</td>
                                                    <td>
                                                        {{ $user->date_of_birth }}
                                                    </td>
                                                    <td>
                                                        @if ($user->gender == 'male')
                                                            Male
                                                        @elseif($user->gender == 'female')
                                                            Female
                                                        @endif
                                                    </td>
                                                    <td>
                                                        {{ $user->cnic }}
                                                    </td>
                                                    <td>
                                                        {{ $user->get_sponser ? $user->get_sponser->username : 'N/A' }}
                                                    </td>
                                                    <td>
                                                        <select class="form-select" style="width: 100%; margin:0 auto;"
                                                            aria-label="Default select example" name="account_type"
                                                            onchange="changeStatus('{{ $user->id }}', this.value)">
                                                            <option value="" selected disabled> Select Account Types
                                                            </option>
                                                            @foreach ($account_types as $account_type)
                                                                <option value="{{ $account_type->id }}"
                                                                    {{ $user->account_type == $account_type->id ? 'selected' : '' }}>
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
                                                                <a class="dropdown-item"
                                                                    href="{{ route('editUser', $user->id) }}">
                                                                    <i data-feather="edit-2" class="mr-50"></i>
                                                                    <span>Edit</span>
                                                                </a>
                                                                <a class="dropdown-item" id="confirm-delete"
                                                                    style="cursor: pointer"
                                                                    onclick="deleteFunction('{{ $user->id }}')">
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
                            method: "POST",
                            url: "{{ route('deleteUser') }}",
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
                        window.location = "{{ route('listAdmins') }}"
                    } else
                        alert(response.message);
                }
            })
        }
    </script>
@endsection
