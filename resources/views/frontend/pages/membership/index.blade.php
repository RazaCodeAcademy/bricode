@extends('frontend.layouts.master')

@section('title')
    Earning History
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
                            <h2 class="content-header-title float-left mb-0">Earning History</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="{{ route('earning.history.index') }}">Earning History
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
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <span class="badge badge-pill badge-danger ml-1" style="position: absolute; margin-top:15%;">
                                 Rs.{{ Auth::user()->account_bal->price ?? 0 }}
                            </span>
                            <img class="card-img-top" src="{{ asset('public/app-assets/images/planlogo.jpg') }}" height="200" width="100" alt="Card image cap">

                            <div class="card-body">
                                <h5 class="card-title">{{ Auth::user()->account_bal->name ?? 'Enrollment Account' }}</h5>
                                <p class="card-text"></p>
                                <div class="d-flex justify-content-end ">
                                    {{--  @dd($membership)  --}}
                                    @if(!empty($membership))
                                        @if($membership->status == 1 )

                                        <button type="button" class=" btn btn-dark" disabled >Requested </button>
                                     @endif
                                    @else
                                    <button type="button" class=" btn btn-dark" data-toggle="modal" data-target="#exampleModal" data-whatever="@getbootstrap"><i class='fa fa-plus-circle'></i>Request </button>

                                    @endif
                                    &nbsp; &nbsp;
                                    <a href="#" class="btn btn-success">Active</a>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

     <!-- Modal -->

     <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Send Request For Upgradation </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('membership.store') }}" enctype="multipart/form-data" method="POST">
                        @csrf
                        <div class="row">

                            <div class="col md-4">
                                <div class="form-group">
                                    <label for="recipient-name" class="col-form-label">Description:</label>
                                    <textarea name="description" class="form-control" required placeholder="Please Enter Description" rows="4"></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Send Request</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection

@section('scripts')

@endsection
