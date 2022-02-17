<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>

        @include('includes.auth.meta')

        <title>@yield('title') | E-Puskemas</title>

        @stack('before-style')

        @include('includes.auth.style')

        @stack('after-style')


    </head>

    <body>
        <div class="auth-page">
            <div class="container-fluid p-0">
                <div class="row g-0">

                    @yield('content')

                </div>
            </div>
        </div>


        @stack('before-script')

        @include('includes.auth.script')

        @stack('after-script')

    </body>
</html>
