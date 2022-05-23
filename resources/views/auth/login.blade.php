@extends('layouts.auth.app')

@section('title', 'Login')

@section('content')

    <div class="col-xxl-3 col-lg-4 col-md-5">
        <div class="auth-full-page-content d-flex p-sm-5 p-4">
            <div class="w-100">
                <div class="d-flex flex-column h-100">
                    <div class="mb-4 mb-md-5 text-center">
                        <a href="index.html" class="d-block auth-logo">
                            <img src="{{ asset('/assets/images/logo-sm.svg')}}" alt="" height="28"> <span class="logo-txt">E-Puskesmas</span>
                        </a>
                    </div>
                    <div class="auth-content my-auto">
                        <div class="text-center">
                            <h5 class="mb-0">Welcome Back !</h5>
                            <p class="text-muted mt-2">Sign in to continue to E-Puskesmas.</p>
                        </div>


                        @if ($errors->any())
                            @foreach ($errors->all() as $error)
                                    <div class="alert alert-danger alert-border-left alert-dismissible fade show" role="alert">
                                        <i class="mdi mdi-block-helper me-3 align-middle"></i><strong>Error</strong> - {{ $error }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                            @endforeach
   
                        @endif

                        

                        @if (session('status'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <i class="mdi mdi-check-all me-2"></i>
                                        {{ session('status') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                        @endif

                        <form class="mt-4 pt-2" action="{{ route('login') }}" method="POST">
                            @csrf

                            
                            <div class="mb-3">
                                <label class="form-label">Username / Email</label>
                                <input type="text" class="form-control"name="auth" :value="old('auth')" placeholder="Enter username" required autofocus>
                            </div>
                            <div class="mb-3">
                                <div class="d-flex align-items-start">
                                    <div class="flex-grow-1">
                                        <label class="form-label">Password</label>
                                    </div>
                                    <div class="flex-shrink-0">
                                        <div class="">
                                            <a href="{{ route('password.request') }}" class="text-muted">Forgot password?</a>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="input-group auth-pass-inputgroup">
                                    <input type="password" class="form-control " name="password" placeholder="Enter password" aria-label="Password" aria-describedby="password-addon" required autocomplete="current-password">
                                    <button class="btn btn-light shadow-none ms-0" type="button" id="password-addon"><i class="mdi mdi-eye-outline"></i></button>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="remember-check">
                                        <label class="form-check-label" for="remember-check">
                                            Remember me
                                        </label>
                                    </div>  
                                </div>
                                
                            </div>
                            <div class="mb-3">
                                <button class="btn btn-primary w-100 waves-effect waves-light" type="submit">Log In</button>
                            </div>
                        </form>

                    </div>
                    <div class="mt-4 mt-md-5 text-center">
                        <p class="mb-0">© <script>document.write(new Date().getFullYear())</script>Crafted with <i class="mdi mdi-heart text-danger"></i> by E-Puskesmas</p>
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
            <div class="row justify-content-center align-items-center">
                <div class="col-xl-7">
                    <div class="p-0 p-sm-4 px-xl-0">
                        <div id="reviewcarouselIndicators" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-indicators carousel-indicators-rounded justify-content-start ms-0 mb-0">
                                <button type="button" data-bs-target="#reviewcarouselIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                                <button type="button" data-bs-target="#reviewcarouselIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                                <button type="button" data-bs-target="#reviewcarouselIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                            </div>
                            <!-- end carouselIndicators -->
                            <!-- end carousel-inner -->
                        </div>
                        <!-- end review carousel -->
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
