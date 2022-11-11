@extends('frontend.layouts.master')

@section('title')
    Withdraw
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
                            <h2 class="content-header-title float-left mb-0">Withdrawal Request</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="{{ route('withdraw.index') }}">Withdrawal Request
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
                <div class="section-body">
                    <input type="hidden" name="hal" value="withdrawreq">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h4>
                                Current Balance
                                <span class=" text-info">{{ $current_balance ?? 0 }}.Rs</span>
                            </h4>
                            <h4>
                                Hit Bonus
                                <span class=" text-info">{{ $bonus_balance }}.Rs</span>

                            </h4>
                            <h4>
                                Total Balance
                                <span class=" text-info">{{ $current_balance + $bonus_balance }}.Rs</span>
                            </h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 float-md-right">
                                    <blockquote>
                                        <p>Your amount withdraw request has been sent successfuly and is under processing.
                                            Your amount will be send to your account after approval.
                                        </p>
                                    </blockquote>
                                </div>
                                <div class="col-md-6">
                                    <form method="POST" action="{{ route('withdraw.store') }}"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group">
                                            <div class="input-group">
                                                <div class="input-group-prepend"> <span
                                                        class="input-group-text">Account</span> </div>
                                                <select name='payment_method' class="custom-select" id="inputGroupSelect05"
                                                    required="">
                                                    <option value="" disabled="" selected>Select Payment Methods
                                                    </option>
                                                    @foreach ($payment_methods as $payment_method)
                                                        <option value="{{ $payment_method->id }}"
                                                            {{ $user->payment_method == $payment_method->id ? 'selected' : '' }}>
                                                            {{ $payment_method->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="input-group">
                                                <div class="input-group-prepend"> <span class="input-group-text">Amount to
                                                        withdraw</span> </div>
                                                @if (!empty($withdraw))
                                                    <input type="number" min='5'
                                                        max="{{ $current_balance + $bonus_balance }}" step="any"
                                                        id="txamount" name="amount" class="form-control"
                                                        placeholder="0.00" required=""
                                                        oninput="amount_to_receive(this.value)">
                                                @else
                                                    <input type="number" min='5'
                                                        max="{{ $current_balance + $bonus_balance }}" step="any"
                                                        id="txamount" name="amount" class="form-control"
                                                        placeholder="0.00" required=""
                                                        oninput="amount_to_receive(this.value)">
                                                @endif
                                            </div>
                                        </div>
                                        <div class="float-md-right mt-4"> <a href="" class="btn btn-danger"><i
                                                    class="fa fa-fw fa-redo"></i> Clear</a>
                                            <button type="submit" class="btn btn-primary"><i
                                                    class="fa fa-fw fa-donate"></i> Withdraw Request...</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="card-footer bg-whitesmoke">
                                <div class="row">
                                    <div class="col-sm-12 text-small text-danger"> The system will simply ignore the amount
                                        withdraw request if it doesn't meet our requirements. </div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <input type="hidden" name="dosubmit" value="1">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
@endsection
