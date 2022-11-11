@extends('frontend.pages.auth.layouts.master')

@section('title')
    {{ __('RESET PASSWORD') }}
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
                        <div class="d-none d-lg-flex col-lg-8 align-items-center p-5">
                            <div class="w-100 d-lg-flex align-items-center justify-content-center px-5"><img
                                    class="img-fluid" src="{{ asset('public/app-assets/images/pages/login-v2.svg') }}"
                                    alt="Login V2" /></div>
                        </div>
                        <!-- /Left Text-->
                        <!-- Login-->
                        <div class="d-flex col-lg-4 align-items-center auth-bg px-2 p-lg-5">
                            <div class="col-12 col-sm-8 col-md-6 col-lg-12 px-xl-2 mx-auto">
                                <h2 class="card-title font-weight-bold mb-1">Welcome to Bricode! 👋</h2>
                                <div class="main-content">

                                    <h6>Recover Your Account</h6>

                                    <form class="main-form" action="{{ route('ForgetPasswordPost') }}"
                                        method="POST">
                                        @csrf

                                        <input type="text" id="email_address" class="form-control" name="email"
                                            required autofocus placeholder="E-Mail Address">
                                        @if ($errors->has('email'))
                                            <span class="text-danger">{{ $errors->first('email') }}</span>
                                        @endif

                                        <button type="submit" class="btn btn-primary mt-2">
                                            Send Reset Password Link
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- /Login-->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END: Content-->
@endsection

@section('scripts')
    <script></script>
@endsection
