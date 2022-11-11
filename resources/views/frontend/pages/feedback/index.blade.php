@extends('frontend.layouts.master')

@section('title')
    Feedback
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
                            <h2 class="content-header-title float-left mb-0">Feedback Request</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="{{ route('feedback.create') }}">Feedback Request
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

                <div class="d-flex flex-column-fluid">
                    <div class="container">
                        <div class="col-12">
                            <div class="card ">
                                <div class="section-header m-2">
                                    <h1><i class="fa fa-fw fa-cash-register"></i> Feedback Form</h1>
                                </div>
                                    <form method="POST" action="{{ route('feedback.store') }}" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group mx-2">
                                            <label for="fsubject">Subject</label>
                                            <input type="text" name="subject" id="fsubject" class="form-control" value="" placeholder="Subject" required>
                                        </div>
                                        <div class="form-group mx-2">
                                            <label for="fsubject">Message</label>
                                            <textarea class="form-control" rows="5" name="message" placeholder="Enter your Message"></textarea>
                                        </div>
                                        <div class="form-group mx-2">
                                            <label for="fsubject">Attach File</label>
                                            <input type="file" name="image"  class="form-control" value="">
                                        </div>
                                        <div class="form-group mx-2">
                                            <button type="submit" name="submit" value="submit" id="submit" class="btn" style="background: #7367f0; color: white">
                                                 Send Message
                                            </button>
                                        </div>

                                    </form>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')

@endsection
