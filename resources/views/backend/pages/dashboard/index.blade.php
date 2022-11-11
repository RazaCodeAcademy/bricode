@extends('backend.layouts.master')

@section('title')
    {{ __('Dashboard') }}
@endsection

@section('content')
    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <!-- Line Chart Card -->
                <div class="row">
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="card">
                            <div class="card-header align-items-start pb-0">
                                <div>
                                    <h2 class="font-weight-bolder">{{ $transactions }}</h2>
                                    <p class="card-text">Wallet Amount</p>
                                </div>
                                <div class="avatar bg-light-primary p-50">
                                    <div class="avatar-content">
                                        <i data-feather="monitor" class="font-medium-5"></i>
                                    </div>
                                </div>
                            </div>
                            <div id="line-area-chart-1"></div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="card">
                            <div class="card-header align-items-start pb-0">
                                <div>
                                    <h2 class="font-weight-bolder">{{ $users }}</h2>
                                    <p class="card-text">Total Members</p>
                                </div>
                                <div class="avatar bg-light-success p-50">
                                    <div class="avatar-content">
                                        <i data-feather="user-check" class="font-medium-5"></i>
                                    </div>
                                </div>
                            </div>
                            <div id="line-area-chart-2"></div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="card">
                            <div class="card-header align-items-start pb-0">
                                <div>
                                    <h2 class="font-weight-bolder">{{ $payments }}</h2>
                                    <p class="card-text">Total Payment Method</p>
                                </div>
                                <div class="avatar bg-light-danger p-50">
                                    <div class="avatar-content">
                                        <i data-feather="user-check" class="font-medium-5"></i>
                                    </div>
                                </div>
                            </div>
                            <div id="line-area-chart-3"></div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="card">
                            <div class="card-header align-items-start pb-0">
                                <div>
                                    <h2 class="font-weight-bolder">{{ $accounts }}</h2>
                                    <p class="card-text">Total Account Types</p>
                                </div>
                                <div class="avatar bg-light-warning p-50">
                                    <div class="avatar-content">
                                        <i data-feather="server" class="font-medium-5"></i>
                                    </div>
                                </div>
                            </div>
                            <div id="line-area-chart-4"></div>
                        </div>
                    </div>
                </div>
                <!--/ Line Chart Card -->

            </div>
        </div>
    </div>
    <!-- END: Content-->
@endsection

@section('scripts')
    <script>
    </script>
@endsection
