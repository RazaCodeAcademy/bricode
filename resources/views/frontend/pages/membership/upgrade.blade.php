@extends('frontend.layouts.master')
@section('title')
    Upgrade Account
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
                            <h2 class="content-header-title float-left mb-0">Membership Update</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="{{ route('membership.create') }}">Membership Update
                                        </a>
                                    </li>
                                    <li class="breadcrumb-item active">List
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <div class="d-flex flex-column-fluid">
                    <div class="container">
                        <div class="card card-custom gutter-b">
                            <div class="card-header flex-wrap border-0 pt-6 pb-0">
                                <div class="card-title">
                                    <h3 class="card-label">
                                        {{ __('History') }}

                                    </h3>
                                </div>
                            </div>
                            <div class="card-body">
                                <table class="table table-striped table-bordered dynamic-height">
                                    <thead>
                                        <tr>
                                            <th>{{ __('ID') }}</th>
                                            <th>{{ __('Current Membership') }}</th>
                                            <th>{{ __('Update') }}</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>{{ Auth::user()->account_bal ? Auth::user()->account_bal->name : 'Enrollment Account' }}
                                            </td>
                                            <td>
                                                <form method="POST" action="" enctype="multipart/form-data">
                                                    @csrf
                                                    <select class="form-control" name="account_type"
                                                        onchange="changeStatus('{{ Auth::user()->id }}', this.value)">
                                                        @foreach ($types as $account_type)
                                                            <option value="{{ $account_type->id }}"
                                                                {{ Auth::user()->account_bal ? (Auth::user()->account_bal->id == $account_type->id ? 'selected' : '') : '' }}>
                                                                {{ $account_type->name }}</option>
                                                        @endforeach

                                                    </select>

                                                </form>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <script>
        function changeStatus(id, value) {
            var route = "{{ route('userAccountupdate', ':id') }}";
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
                        window.location = "{{ route('membership.create') }}"
                    } else
                        toastr.error(response.message);
                }
            })
        }
    </script>
@endsection
