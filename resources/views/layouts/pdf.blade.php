<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
    
        @include('includes.dashboard.meta')

        <title>@yield('title') | E-Puskemas</title>

        @stack('before-style')

        @include('includes.dashboard.style')

        @stack('after-style')

    </head>
        <body>
            <div id="layout-wrapper">
                <div class="main-content">
                    <div class="page-content">

                        @yield('content')
                    
                    </div>


                    @include('includes.dashboard.footer')
                </div>

                

            </div>

                @include('includes.dashboard.rightbar')


            @stack('before-script')

            @include('includes.dashboard.script')
    
            @stack('after-script')
        </body>
    </html>