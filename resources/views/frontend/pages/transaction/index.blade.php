@extends('frontend.layouts.master')

@section('title')
    Account Upgrade
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
                            <h2 class="content-header-title float-left mb-0">Account Upgrade</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="{{ route('listAdmins') }}">Account Upgrade
                                            </a>
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <span class="badge badge-pill badge-danger ml-1" style="position: absolute; margin-top:15%;">
                                Rs.{{ Auth::user()->account_bal->price ?? 0 }}
                            </span>
                            <img class="card-img-top" src="{{ asset('public/app-assets/images/planlogo.jpg') }}" height="200" width="100" alt="Card image cap">

                            <div class="card-body">
                                <h5 class="card-title">{{ Auth::user()->account_bal->name ?? 'Membership Enrollment' }}</h5>
                                <p class="card-text"></p>
                                <div class="d-flex justify-content-end ">
                                    {{--  @dd($membership)  --}}
                                    @if(!empty($transaction))
                                        @if($transaction->status == 1 )
                                            <button type="button" class=" btn btn-success" disabled >Sended </button>
                                        @endif
                                    @else
                                    <button type="button" class=" btn btn-success" data-toggle="modal" data-target="#exampleModal" data-whatever="@getbootstrap"><i class='fa fa-plus-circle'></i>Confirm </button>

                                    @endif



                                    &nbsp; &nbsp;
                                    <a href="#" class="btn btn-dark">Close</a>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Please Confirm for account upgradation. </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('transaction.store') }}" enctype="multipart/form-data" method="POST">
                        @csrf
                        <div class="row">

                            <div class="col md-4">
                                <div class="form-group">
                                    <label for="recipient-name" class="col-form-label">Amount:</label>
                                    <input name="" type="text" class="form-control" value="{{ Auth::user()->account_bal->price ?? 0 }}.Rs" required placeholder="Enter Amount" readonly>
                                    <input name="amount" type="hidden" class="form-control" value="{{ Auth::user()->account_bal->price ?? 0 }}" required placeholder="Enter Amount" readonly>
                                    <small class="text-danger">Amount must be Equivalent to wallet amount </small>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Confirm Now!</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection

@section('scripts')

@endsection
