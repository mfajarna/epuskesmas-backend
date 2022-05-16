@extends('layouts.auth.app')

@section('title', 'Login')

@section('content')

<div class="col-xxl-3 col-lg-4 col-md-5">
    <div class="auth-full-page-content d-flex p-sm-5 p-4">
        <div class="w-100">
            <div class="d-flex flex-column h-100">
                <div class="mb-4 mb-md-5 text-center">
                    <a href="index.html" class="d-block auth-logo">
                        <img src="assets/images/logo-sm.svg" alt="" height="28"> <span class="logo-txt">E-Puskesmas</span>
                    </a>
                </div>
                <div class="auth-content my-auto">
                    <div class="text-center">
                        <div class="avatar-lg mx-auto">
                            <div class="avatar-title rounded-circle bg-light">
                                <i class="bx bx-check h2 mb-0 text-primary"></i>
                            </div>
                        </div>
                        <div class="p-2 mt-4">
                            <h4>Cek Antrian</h4>
                            <p class="text-muted">Mohon untuk cek antrian pada setiap poli untuk melihat nomer antrian yang sedang berjalan!</p>
                            <div class="mt-4">
                                <a href="{{ url('/') }}" class="btn btn-primary w-100">Back to Home</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-4 mt-md-5 text-center">
                    <p class="mb-0">© <script>document.write(new Date().getFullYear())</script> E-Puskesmas   . Crafted with <i class="mdi mdi-heart text-danger"></i> </p>
                </div>
            </div>
        </div>
    </div>
    <!-- end auth full page content -->
</div>

<div class="col-xxl-9 col-lg-8 col-md-7">
    <div class="auth-bg pt-md-5 p-4 d-flex">
        <div class="bg-overlay bg-primary"></div>
        <ul class="bg-bubbles">
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
        </ul>
        <!-- end bubble effect -->
        <div class="row">
            <div class="col-lg-6">
                <div class="card border border-success">
                    <div class="card-header bg-transparent border-success">
                        <h5 class="my-0 text-success"><i class="mdi mdi-check-all me-3"></i>Success Card</h5>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">card title</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="card border border-success">
                    <div class="card-header bg-transparent border-success">
                        <h5 class="my-0 text-success"><i class="mdi mdi-check-all me-3"></i>Success Card</h5>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">card title</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    </div>
                </div>
            </div>


        </div>
    </div>
</div>


@endsection