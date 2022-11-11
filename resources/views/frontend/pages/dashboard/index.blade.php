@extends('frontend.layouts.master')

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
                    <div class="col-lg-2 col-sm-2 col-12"></div>
                    <div class="col-lg-8 col-sm-8 col-12">
                        <div class="card">
                            <div class="card-header align-items-start pb-0">
                                <div class="d-flex">
                                    <div>
                                        <h2 class="font-weight-bolder">
                                            @if ($withdraw_amount > 0)
                                                <span class=" text-danger">Rs.{{ $current_earning ?? 0 }}</span>
                                            @else
                                                <span class=" text-danger">Rs.{{ $current_earning ?? 0 }}</span>
                                            @endif
                                        </h2>
                                        <p class="card-text">Current Earning</p>
                                    </div>
                                    <div class="ml-4">
                                        <h2 class="font-weight-bolder">
                                            <span class="success text-success">Rs.{{ $total_earning ?? 0 }}</span>
                                        </h2>
                                        <p class="card-text">Total Earning</p>
                                    </div>
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
                </div>
                <div class="row">
                    <div class="col-lg-2 col-sm-2 col-12"></div>
                    <div class="col-lg-8 col-sm-8 col-12">
                        <div class="card">
                            <div class="card-header align-items-start pb-0">
                                <div class="d-flex">
                                    <div>
                                        <h2 class="font-weight-bolder">{{ $hits ?? 0 }}</h2>
                                        <p class="card-text">Total Tips</p>
                                    </div>
                                    <div class="ml-4">
                                        <h2 class="font-weight-bolder">Rs.{{ $hit_bonus ?? 0 }}</h2>
                                        <p class="card-text">Earning</p>
                                    </div>
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
                </div>
                <div class="row">
                    <div class="col-lg-2 col-sm-2 col-12"></div>
                    <div class="col-lg-8 col-sm-8 col-12">
                        <div class="card">
                            <div class="card-header align-items-start pb-0">
                                <div class="d-flex">
                                    <div>
                                        <h2 class="font-weight-bolder">
                                            {{ $today_earn_points ? $today_earn_points->number : 0 }}</h2>
                                        <p class="card-text">Recent Points</p>
                                    </div>
                                    <div class="ml-4">
                                        <h2 class="font-weight-bolder">{{ $earn_points ?? 0 }}</h2>
                                        <p class="card-text">Total Points</p>
                                    </div>
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
                </div>
                <div class="row">
                    <div class="col-lg-2 col-sm-2 col-12"></div>
                    <div class="col-lg-8 col-sm-8 col-12">
                        <div class="card">
                            <div class="card-header align-items-start pb-0">
                                <div>
                                    <h2 class="font-weight-bolder">
                                        @if (!empty($transaction))
                                            @if ($transaction->status == 1)
                                                <h3 class="success">
                                                    Rs.{{ Auth::user()->account_bal ? Auth::user()->account_bal->price : 0 }}
                                                </h3>
                                            @endif
                                        @else
                                            <h3 class="success">
                                                Rs.{{ Auth::user()->account_bal ? Auth::user()->account_bal->price : 0 }}
                                            </h3>
                                        @endif
                                    </h2>
                                    <p class="card-text">Pouch</p>
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

                {{-- alert area --}}
                <div class="row">
                    <div class="col-xl-2 col-lg-2 col-12">
                    </div>
                    <div class="col-lg-8 col-md-12 col-12 col-sm-12">
                        @if (empty(Auth::user()->account_bal))
                            <div class="alert alert-danger" role="alert" id="succMsg">
                                <button type="button" class="close " data-dismiss="alert" aria-label="Close">

                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <p> Account registered Successfully
                                    Please upgrade your account in 24 hours otherwise your account will be deleted
                                </p>
                                <a href="{{ route('membership.index') }}"><u>Click Here To Upgrade your Account</u></a>

                            </div>
                        @elseif (!empty($transaction) && Auth::user()->account_bal->id != 4)
                            <div class="alert alert-success" role="alert" id="succMsg">
                                <button type="button" class="close " data-dismiss="alert" aria-label="Close">

                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <p>Successfully Upgraded Your Account </p>
                                <p> Want to Change Membership <a href="{{ route('membership.create') }}"><u>make a request
                                            for
                                            upgradation</u></a> </p>

                            </div>
                        @elseif(!empty(Auth::user()->account_bal) && empty($transaction))
                            <div class="alert alert-warning" role="alert" id="succMsg">
                                <button type="button" class="close " data-dismiss="alert" aria-label="Close">

                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <p>Congratulations your activation balance for
                                    <b>({{ Auth::user()->account_bal ? Auth::user()->account_bal->name : 'n/a' }})</b> has
                                    been
                                    transferred
                                    in your account wallet.
                                </p>
                                <a href="{{ route('transaction.create') }}"><u>Click here to upgrade your account.</u></a>

                            </div>
                        @endif
                    </div>
                </div>

                {{-- account overview --}}
                <div class="row">
                    <div class="col-xl-2 col-lg-2 col-12">
                    </div>
                    <div class="col-lg-8 col-md-12 col-12 col-sm-12">

                        <div class="card">
                            <div class="card-header">
                                <h4>Account Overview</h4>
                                <div class="card-header-action">
                                    @if (!empty($transaction))
                                        <div class='badge badge-success'>Active</div>
                                    @else
                                        <div class='badge badge-success'>InActive</div>
                                    @endif
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="summary-item">
                                    <ul class="list-unstyled list-unstyled-border">
                                        <li class="media">
                                            <div class="media-body">
                                                <div class="text-small">Registered</div>
                                                <div class="media-title">{{ Auth::user()->created_at }}</div>
                                            </div>
                                        </li>
                                        <li class="media">
                                            <div class="media-body">
                                                <div class="text-small">Name</div>
                                                <div class="media-title">{{ Auth::user()->username }}
                                                    ({{ Auth::user()->email }})</div>
                                            </div>
                                        </li>
                                        <li class="">
                                            <div class="media-body">
                                                <div class="text-small">
                                                    Promo URL
                                                </div>
                                                <div
                                                    style="white-space: nowrap; overflow-x:scroll; border: 1px solid black;">
                                                    <a id="referal_link" class=""
                                                        href="{{ route('user-profile', Auth::user()->id) }}"
                                                        target="_blank" title="">
                                                        {{ url()->route('user-profile', Auth::user()->id) }}
                                                    </a>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- performance chart --}}

                <div class="row">
                    <div class="col-xl-2 col-lg-2 col-12">
                    </div>

                    <div class="col-lg-8 col-md-12 col-12 col-sm-12">
                        <div class="card">
                            <div
                                class="card-header d-flex flex-sm-row flex-column justify-content-md-between align-items-start justify-content-start">
                                <div>
                                    <h4 class="card-title mb-50">Performance</h4>
                                    <p class="mb-0">Rs.{{ $seven_day_earn }}</p>
                                </div>
                                <div class="d-flex align-items-center mt-md-0 mt-1">
                                    <i class="font-medium-2" data-feather="calendar"></i>
                                    <input type="text"
                                        class="form-control flat-picker bg-transparent border-0 shadow-none"
                                        placeholder="YYYY-MM-DD" />
                                </div>
                            </div>
                            <div class="card-body">
                                <div id="chartContainer"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END: Content-->
@endsection

@section('scripts')
    <script>
        window.onload = function() {

            var total_earning_analytics = <?php echo json_encode($total_earning_analytics, true); ?>;
            total_earning_analytics.forEach(ele => {
                ele.x = new Date(ele.x);
            });


            var options = {
                series: [{
                    data: total_earning_analytics
                }],
                chart: {
                    type: 'candlestick',
                    height: 350,
                    toolbar: {
                    show: false,
                }
                },
                // title: {
                //     text: 'CandleStick Chart',
                //     align: 'left'
                // },
                xaxis: {
                    type: 'datetime',
                    tooltip: {
                        enabled: false
                    }
                },
                yaxis: {
                    tooltip: {
                        enabled: true
                    }
                },

            };

            var chart = new ApexCharts(document.querySelector("#chartContainer"), options);
            chart.render();

        }
    </script>
@endsection
