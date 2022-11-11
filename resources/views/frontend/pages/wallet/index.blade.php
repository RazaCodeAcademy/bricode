@extends('frontend.layouts.master')

@section('title')
    Wallet
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
                            <h2 class="content-header-title float-left mb-0">Wallet</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="{{ route('listAdmins') }}">Wallet
                                            </a>
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
                <div class="section-header">
                    <h1><i class="fa fa-fw fa-hand-holding-usd"></i>Wallet</h1> </div>
                <div class="section-body">
                    <input type="hidden" name="hal" value="withdrawreq">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h4>
                                Total Amount <span class=" text-info">{{ Auth::user()->account_bal->price+$direct_earning->amount+$indirect_earning->amount ?? 0 }}$</span>              </h4> </div>

                        <div class="card-footer bg-whitesmoke">
                            <div class="row">
                                <div class="col-sm-12 text-small text-danger"> You are allowed to submit a withdrawal request once a time! The system will simply ignore the request if it is do not meets the requirements. </div>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <input type="hidden" name="dosubmit" value="1"> </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')

@endsection
