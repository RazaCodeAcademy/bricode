@extends('backend.layouts.master')

@section('title')
    Create Users
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
                                    <li class="breadcrumb-item"><a
                                            href="{{ route('listAdmins') }}">Users List</a>
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
                <section class="tooltip-validations" id="tooltip-validation">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">+Add New User</h4>
                                </div>
                                <div class="card-body">

                                    <form method="POST" action="{{ route('storeUser') }}" enctype="multipart/form-data">
                                        @csrf
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label>{{ __('First_name') }} <span
                                                                class="text-danger">*</span></label>
                                                        <input type="text" name="first_name" class="form-control"
                                                            placeholder="Enter First Name" value="{{ old('Username') }}"
                                                            required>

                                                        @error('first_name')
                                                            <span class="invalid-feedback" role="alert">
                                                                {{ $message }}
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label>{{ __('Last_Name') }} <span
                                                                class="text-danger">*</span></label>
                                                        <input type="text" class="form-control"
                                                            placeholder="Enter last Name" name="last_name"
                                                            value="{{ old('last_name') }}" required />
                                                        @error('last_name')
                                                            <span class="invalid-feedback" role="alert">
                                                                {{ $message }}
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label>{{ __('Username') }} <span
                                                                class="text-danger">*</span></label>
                                                        <input type="text" class="form-control"
                                                            placeholder="Enter Username" name="username"
                                                            value="{{ old('Username') }}" required />
                                                        @error('username')
                                                            <span class="invalid-feedback" role="alert">
                                                                {{ $message }}
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label>{{ __('Email') }} <span
                                                                class="text-danger">*</span></label>
                                                        <input type="email" class="form-control" placeholder="Enter Email"
                                                            name="email" value="{{ old('email') }}" required />
                                                        @error('email')
                                                            <span class="invalid-feedback" role="alert">
                                                                {{ $message }}
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label>{{ __('Date of Birth') }} <span
                                                                class="text-danger">*</span></label>
                                                        <input type="date" class="form-control" name="date_of_birth"
                                                            value="{{ old('date_of_birth') }}" required />
                                                        @error('date_of_birth')
                                                            <span class="invalid-feedback" role="alert">
                                                                {{ $message }}
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label>{{ __('Gender') }} <span
                                                                class="text-danger">*</span></label>
                                                        <select name="gender" class="form-control" required>
                                                            <option selected="selected" disabled="disabled" value="">
                                                                {{ __('Select Gender') }}</option>
                                                            <option value='male'>Male</option>
                                                            <option value='female'>Female</option>
                                                        </select>
                                                        @error('gender')
                                                            <span class="invalid-feedback" role="alert">
                                                                {{ $message }}
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label>{{ __('Phone Number') }} <span
                                                                class="text-danger">*</span></label>
                                                        <input type="number" class="form-control"
                                                            placeholder="Enter Name" name="phone_number"
                                                            value="{{ old('phone_number') }}" required />
                                                        @error('phone_number')
                                                            <span class="invalid-feedback" role="alert">
                                                                {{ $message }}
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label>{{ __('Cnic Number') }} <span
                                                                class="text-danger">*</span></label>
                                                        <input type="number" class="form-control"
                                                            placeholder="Enter Cnic Number" name="cnic"
                                                            value="{{ old('cnic') }}" required />
                                                        @error('cnic')
                                                            <span class="invalid-feedback" role="alert">
                                                                {{ $message }}
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label>{{ __('Payment Process') }} <span
                                                                class="text-danger">*</span></label>
                                                        <select name="payment_process" class="form-control" required>
                                                            <option selected="selected" disabled="disabled"
                                                                value="">
                                                                {{ __('Select Payment Process') }}</option>
                                                            @foreach ($payment_methods as $method)
                                                                <option value="{{ $method->id }}">{{ $method->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        @error('payment_process')
                                                            <span class="invalid-feedback" role="alert">
                                                                {{ $message }}
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label>{{ __("Promo I'd") }} <span
                                                                class="text-danger">*</span></label>
                                                        <input type="text" class="form-control"
                                                            placeholder="Enter Promo I'd" name="sponser_id"
                                                            value="{{ old('sponser_id') }}" required />
                                                        @error('sponser_id')
                                                            <span class="invalid-feedback" role="alert">
                                                                {{ $message }}
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>


                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label>{{ __('Password') }}<span
                                                                class="text-danger">*</span></label>
                                                        <input type="password" class="form-control"
                                                            placeholder="Enter Password" name="password"
                                                            value="{{ old('password') }}" required />
                                                        @error('password')
                                                            <span class="invalid-feedback" role="alert">
                                                                {{ $message }}
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label>{{ __('Confirm Password') }} <span
                                                                class="text-danger">*</span></label>
                                                        <input type="password" class="form-control"
                                                            placeholder="Confirm Password" name="password_confirmation"
                                                            value="{{ old('password_confirmation') }}" required />
                                                        @error('password_confirmation')
                                                            <span class="invalid-feedback" role="alert">
                                                                {{ $message }}
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer" style="text-align: end">
                                            <button type="submit"
                                                class="btn btn-primary mr-2">{{ __('Submit') }}</button>
                                            <button type="reset" class="btn btn-secondary">{{ __('Reset') }}</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>

@endsection

@section('script')
@endsection
