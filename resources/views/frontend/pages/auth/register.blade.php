@extends('frontend.pages.auth.layouts.master')

@section('title')
    {{ __('REGISTER') }}
@endsection

@section('content')
    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <div class="auth-wrapper auth-v2">
                    <div class="auth-inner row m-0">
                        <!-- Brand logo--><a class="brand-logo" href="javascript:void(0);">
                            <img src="{{ asset('public/app-assets/images/logo/bricode-logo.png') }}" width="170px"/>
                        </a>
                        <!-- /Brand logo-->
                        <!-- Left Text-->
                        <div class="d-none d-lg-flex col-lg-6 align-items-center p-5">
                            <div class="w-100 d-lg-flex align-items-center justify-content-center px-5"><img
                                    class="img-fluid" src="{{ asset('public/app-assets/images/pages/register-v2.svg') }}"
                                    alt="Register V2" /></div>
                        </div>
                        <!-- /Left Text-->
                        <!-- Register-->
                        <div class="d-flex col-lg-6 align-items-center auth-bg px-2 p-lg-5 pt-5 pt-md-0">
                            <div class="col-12 col-sm-8 col-md-6 col-lg-12 px-xl-2 mx-auto mt-5 mt-md-0">
                                <h2 class="card-title font-weight-bold mb-1">Bricode Sign Up</h2>
                                <p class="card-text mb-2">Create your account with bricode!</p>
                                @if (session()->has('error'))
                                    <div class="alert alert-danger">
                                        {{ session()->get('error') }}
                                    </div>
                                @endif
                                @if (count($errors) > 0)
                                    <div class="alert alert-danger">
                                        <ul>

                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <form method="POST" action="{{ route('user.register') }}" enctype="multipart/form-data">
                                    @csrf
                                        <div class="row">
                                            <div class="col-md-6 col-sm-12 col-12">
                                                <div class="form-group">
                                                    <label>{{ __('First_name') }} <span class="text-danger">*</span></label>
                                                    <input type="text" name="first_name" class="form-control"
                                                        placeholder="Enter First Name" value="{{ old('first_name') }}">

                                                </div>
                                            </div>

                                            <div class="col-md-6 col-sm-12 col-12">
                                                <div class="form-group">
                                                    <label>{{ __('Last_Name') }} <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" placeholder="Enter last Name"
                                                        name="last_name" value="{{ old('last_name') }}" />
                                                    @error('last_name')
                                                        <span class="invalid-feedback" role="alert">
                                                            {{ $message }}
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-12 col-12">
                                                <div class="form-group">
                                                    <label>{{ __('Username') }} <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control"
                                                        placeholder="Enter Username" name="username"
                                                        value="{{ old('username') }}" />
                                                    @error('username')
                                                        <span class="invalid-feedback" role="alert">
                                                            {{ $message }}
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-12 col-12">
                                                <div class="form-group">
                                                    <label>{{ __('Email') }} <span class="text-danger">*</span></label>
                                                    <input type="email" class="form-control" placeholder="Enter Email"
                                                        name="email" value="{{ old('email') }}" />
                                                    @error('email')
                                                        <span class="invalid-feedback" role="alert">
                                                            {{ $message }}
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-12 col-12">
                                                <div class="form-group">
                                                    <label>{{ __('Date of Birth') }} <span
                                                            class="text-danger">*</span></label>
                                                    <input type="date" class="form-control" name="date_of_birth"
                                                        value="{{ old('date_of_birth') }}" />
                                                    @error('date_of_birth')
                                                        <span class="invalid-feedback" role="alert">
                                                            {{ $message }}
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-12 col-12">
                                                <div class="form-group">
                                                    <label>{{ __('Gender') }} <span class="text-danger">*</span></label>
                                                    <select name="gender" class="form-control">
                                                        <option disabled="disabled" value="">
                                                            {{ __('Select Gender') }}</option>
                                                        <option value='male'
                                                            {{ old('gender') == 'male' ? 'selected' : '' }}>Male
                                                        </option>
                                                        <option value='female'
                                                            {{ old('gender') == 'female' ? 'selected' : '' }}>Female
                                                        </option>
                                                    </select>
                                                    @error('gender')
                                                        <span class="invalid-feedback" role="alert">
                                                            {{ $message }}
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-12 col-12">
                                                <div class="form-group">
                                                    <label>{{ __('Phone Number') }} <span
                                                            class="text-danger">*</span></label>
                                                    <input type="number" class="form-control" placeholder="Enter Name"
                                                        name="phone_number" value="{{ old('phone_number') }}" />
                                                    @error('phone_number')
                                                        <span class="invalid-feedback" role="alert">
                                                            {{ $message }}
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-12 col-12">
                                                <div class="form-group">
                                                    <label>{{ __('Cnic Number') }} <span
                                                            class="text-danger">*</span></label>
                                                    <input type="number" class="form-control"
                                                        placeholder="Enter Cnic Number" name="cnic"
                                                        value="{{ old('cnic') }}" />
                                                    @error('cnic')
                                                        <span class="invalid-feedback" role="alert">
                                                            {{ $message }}
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-12 col-12">
                                                <div class="form-group">
                                                    <label>{{ __('Payment Process') }} <span
                                                            class="text-danger">*</span></label>
                                                    <select name="payment_process" class="form-control">
                                                        <option selected="" disabled="disabled" value="">
                                                            {{ __('Select Payment Process') }}</option>
                                                        @foreach ($payment_methods as $method)
                                                            <option value="{{ $method->id }}"
                                                                {{ old('payment_process') == $method->id ? 'selected' : '' }}>
                                                                {{ $method->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('payment_process')
                                                        <span class="invalid-feedback" role="alert">
                                                            {{ $message }}
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-12 col-12">
                                                <div class="form-group">
                                                    <label>{{ __("Promo I'd") }} <span
                                                            class="text-danger">*</span></label>
                                                    @if (current_route() == 'user.register.form')
                                                        <input type="text" class="form-control"
                                                            placeholder="Enter Promo I'd" name="sponser_id" required />
                                                    @elseif(current_route() == 'user-profile')
                                                        <input type="text" class="form-control"
                                                            placeholder="Enter Promo I'd" name="sponser_id"
                                                            value="{{ $username }}" readonly />
                                                    @endif
                                                    @error('sponser_id')
                                                        <span class="invalid-feedback" role="alert">
                                                            {{ $message }}
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>


                                            <div class="col-md-6 col-sm-12 col-12">
                                                <div class="form-group">
                                                    <label>{{ __('Password') }}<span class="text-danger">*</span></label>
                                                    <input type="password" class="form-control"
                                                        placeholder="Enter Password" name="password"
                                                        value="{{ old('password') }}" />
                                                    <small class="text-danger">Password must contain 8 characters Atleast
                                                        One
                                                        Capital &
                                                        small letter number or special character </small>
                                                    @error('password')
                                                        <span class="invalid-feedback" role="alert">
                                                            {{ $message }}
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-sm-12 col-12">
                                                <div class="form-group">
                                                    <label>{{ __('Confirm Password') }} <span
                                                            class="text-danger">*</span></label>
                                                    <input type="password" class="form-control"
                                                        placeholder="Confirm Password" name="password_confirmation"
                                                        value="{{ old('password_confirmation') }}" />
                                                    @error('password')
                                                        <span class="invalid-feedback" role="alert">
                                                            {{ $message }}
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                        </div>
                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox">
                                            <input class="custom-control-input" id="register-privacy-policy"
                                                type="checkbox" tabindex="4" value="{{ old('term&condition') }}" required/>
                                            <label class="custom-control-label" for="register-privacy-policy">Terms & Conditions</label>
                                            <a type="button" data-toggle="modal" data-target="#exampleModal">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9 5.25h.008v.008H12v-.008z" />
                                                    </svg>
                                              </a>
                                        </div>
                                    </div>

                                    <button class="btn btn-primary btn-block" tabindex="5">Sign up</button>
                                </form>
                                <p class="text-center mt-2"><span>Already have an account?</span><a
                                        href="{{ route('login') }}"><span>&nbsp;Sign in instead</span></a></p>
                                <div class="divider my-2">
                                    <div class="divider-text">or</div>
                                </div>
                                <div class="auth-footer-btn d-flex justify-content-center"><a class="btn btn-facebook"
                                        href="javascript:void(0)"><i data-feather="facebook"></i></a><a
                                        class="btn btn-twitter white" href="javascript:void(0)"><i
                                            data-feather="twitter"></i></a><a class="btn btn-google"
                                        href="javascript:void(0)"><i data-feather="mail"></i></a><a
                                        class="btn btn-github" href="javascript:void(0)"><i
                                            data-feather="github"></i></a></div>

                            </div>
                        </div>
                        <!-- /Register-->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade text-left" id="defaultSize" tabindex="-1" role="dialog" aria-labelledby="myModalLabel18" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel18">Default Modal</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    I love candy candy cake powder I love icing ice cream pastry. Biscuit lemon drops sesame snaps.
                    Topping biscuit croissant gummi bears jelly beans cake cake bear claw muffin. Lemon drops oat cake
                    pastry bear claw liquorice lemon drops.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Accept</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Terms & Conditions </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <ol>
                        <li>👍Bricode international have its all right reserved.</li>
                        <li>👍Bricode international take strict legal action again misuse of its accets.</li>
                        <li>👍Minimum deposit is 3K and minimum withdraw is 500.</li>
                        <li>👍Withdraw receive time is 24 hours Approximately.</li>
                        <li>👍Activation balance isn't refundable and only be use for shopping.</li>
                        <li>👍For complain and suggestions contact us.</li>
                    </ol>
                    <a href="mailto:info@bricodeinternational.com">info@bricodeinternational.com</a>
                    <br>
                    <a href="tel:+923156835905">+923-156835905</a>
                </div>

            </div>
        </div>
    </div>
    <!-- END: Content-->
@endsection

@section('scripts')
@endsection
