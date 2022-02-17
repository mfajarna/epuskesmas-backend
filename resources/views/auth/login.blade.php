{{-- <x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>

        <x-jet-validation-errors class="mb-4" />

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div>
                <x-jet-label for="email" value="{{ __('Email') }}" />
                <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <div class="mt-4">
                <x-jet-label for="password" value="{{ __('Password') }}" />
                <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
            </div>

            <div class="block mt-4">
                <label for="remember_me" class="flex items-center">
                    <x-jet-checkbox id="remember_me" name="remember" />
                    <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

                <x-jet-button class="ml-4">
                    {{ __('Log in') }}
                </x-jet-button>
            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout> --}}


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
                                <label class="form-label">Username</label>
                                <input type="email" class="form-control" name="email" id="email" value="{{ old('email') }}" placeholder="Enter username" required autofocus>
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
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <div class="testi-contain text-white">
                                        <i class="bx bxs-quote-alt-left text-success display-6"></i>

                                        <h4 class="mt-4 fw-medium lh-base text-white">“I feel confident
                                            imposing change
                                            on myself. It's a lot more progressing fun than looking back.
                                            That's why
                                            I ultricies enim
                                            at malesuada nibh diam on tortor neaded to throw curve balls.”
                                        </h4>
                                        <div class="mt-4 pt-3 pb-5">
                                            <div class="d-flex align-items-start">
                                                <div class="flex-shrink-0">
                                                    <img src="{{ asset('/assets/images/users/avatar-1.jpg')}}" class="avatar-md img-fluid rounded-circle" alt="...">
                                                </div>
                                                <div class="flex-grow-1 ms-3 mb-4">
                                                    <h5 class="font-size-18 text-white">Richard Drews
                                                    </h5>
                                                    <p class="mb-0 text-white-50">Web Designer</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="carousel-item">
                                    <div class="testi-contain text-white">
                                        <i class="bx bxs-quote-alt-left text-success display-6"></i>

                                        <h4 class="mt-4 fw-medium lh-base text-white">“Our task must be to
                                            free ourselves by widening our circle of compassion to embrace
                                            all living
                                            creatures and
                                            the whole of quis consectetur nunc sit amet semper justo. nature
                                            and its beauty.”</h4>
                                        <div class="mt-4 pt-3 pb-5">
                                            <div class="d-flex align-items-start">
                                                <div class="flex-shrink-0">
                                                    <img src="{{ asset('/assets/images/users/avatar-2.jpg')}}" class="avatar-md img-fluid rounded-circle" alt="...">
                                                </div>
                                                <div class="flex-grow-1 ms-3 mb-4">
                                                    <h5 class="font-size-18 text-white">Rosanna French
                                                    </h5>
                                                    <p class="mb-0 text-white-50">Web Developer</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="carousel-item">
                                    <div class="testi-contain text-white">
                                        <i class="bx bxs-quote-alt-left text-success display-6"></i>

                                        <h4 class="mt-4 fw-medium lh-base text-white">“I've learned that
                                            people will forget what you said, people will forget what you
                                            did,
                                            but people will never forget
                                            how donec in efficitur lectus, nec lobortis metus you made them
                                            feel.”</h4>
                                        <div class="mt-4 pt-3 pb-5">
                                            <div class="d-flex align-items-start">
                                                <img src="{{ asset('/assets/images/users/avatar-3.jpg')}}"
                                                    class="avatar-md img-fluid rounded-circle" alt="...">
                                                <div class="flex-1 ms-3 mb-4">
                                                    <h5 class="font-size-18 text-white">Ilse R. Eaton</h5>
                                                    <p class="mb-0 text-white-50">Manager
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end carousel-inner -->
                        </div>
                        <!-- end review carousel -->
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
