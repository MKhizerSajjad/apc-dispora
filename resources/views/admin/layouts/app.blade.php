<!doctype html>
{{-- <html lang="{{ config('app.locale')}}"> --}}
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable">
<head>
    <meta charset="utf-8" />
    {{-- <title>Dashboard</title> --}}
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="author" content="potenzaglobalsolutions.com" />
    <meta name="keywords" content="{{ config('app.name', 'Laravel') }}" />
    <meta name="description" content="{{ config('app.name', 'Laravel') }}" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('admin/images/favicon.webp') }}" />

    @include('admin.includes.css')

    <!-- include custom css -->
    @stack('css')

</head>

<body>
    {{-- @if(Route::currentRouteName() == 'login' || Route::currentRouteName() == 'register' || Route::currentRouteName() == 'password.request' || Route::currentRouteName() == 'password.reset' || Route::currentRouteName() == 'no-access') --}}

    <!-- Begin page -->
    <div id="layout-wrapper">


        @if(Route::currentRouteName() != 'login' && Route::currentRouteName() != 'register')
            @include('admin.common.topbar')
            @include('admin.common.leftbar')

            <!-- Vertical Overlay-->
            <div class="vertical-overlay"></div>

            <div class="main-content">
                @yield('content')
            </div>
        @else
            @yield('content')
        @endif

    </div>
    <!-- END layout-wrapper -->

    <!--start back-to-top-->
    <button onclick="topFunction()" class="btn btn-danger btn-icon" id="back-to-top">
        <i class="ri-arrow-up-line"></i>
    </button>
    <!--end back-to-top-->

    <!--preloader-->
    {{-- <div id="preloader">
        <div id="status">
            <div class="spinner-border text-primary avatar-sm" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
    </div> --}}

    @include('admin.includes.js')

    <!-- include custom scripts -->
    @stack('script')
</body>
</html>
