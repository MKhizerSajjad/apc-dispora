@extends('admin.layouts.app')

@section('content')



<div class="auth-page-wrapper pt-5">
    <!-- auth page bg -->
    <div class="auth-one-bg-position auth-one-bg" id="auth-particles">
        <div class="bg-overlay"></div>

        <div class="shape">
            <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 1440 120">
                <path d="M 0,36 C 144,53.6 432,123.2 720,124 C 1008,124.8 1296,56.8 1440,40L1440 140L0 140z"></path>
            </svg>
        </div>
    </div>

    <!-- auth page content -->
    <div class="auth-page-content">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-center mb-4 text-white-50">
                        <div>
                            <a href="index.html" class="d-inline-block auth-logo">
                                <img src="{{asset('assets/images/logo-light.png')}}" alt="" height="20">
                            </a>
                        </div>
                        {{-- <p class="fs-15 fw-medium">Premium Investments</p> --}}
                    </div>
                </div>
            </div>
            <!-- end row -->

            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-5">
                    <div class="card mt-4">

                        <div class="card-body p-4">
                            <div class="text-center mt-2">
                                <h5 class="text-primary">{{ __('Welcome Back !') }}</h5>
                                <p class="text-muted">{{ __('Sign in to continue to portal') }}</p>
                            </div>
                            <div class="p-2 mt-4">
                                <form method="post" action="{{ route('login') }}">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="email" class="form-label">{{ __('Email')}}</label>
                                        <input type="text" class="form-control" id="email" name="email" placeholder="Enter email" @error('email') is-invalid @enderror value="{{ old('email') }}" autocomplete="email" autofocus>
                                        @error('email')
                                            <span class="text text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        {{-- <div class="float-end">
                                            <a href="auth-pass-reset-basic.html" class="text-muted">Forgot password?</a>
                                        </div> --}}
                                        <label class="form-label" for="password-input">{{ __('Password')}}</label>
                                        <div class="position-relative auth-pass-inputgroup mb-3">
                                            <input type="password" class="form-control pe-5 password-input" placeholder="Enter password" id="password-input" name="password" @error('password') is-invalid @enderror autocomplete="current-password">
                                            {{-- <button class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon" type="button" id="password-addon"><i class="ri-eye-fill align-middle"></i></button> --}}
                                            @error('password')
                                                <span class="text text-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="mt-4">
                                        <button class="btn btn-success w-100 hover-up" type="submit" name="login">{{ __('Login') }}</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="text-center" bis_skin_checked="1">
                        <p class="mb-0">Don't have an account ? <a href="{{route('register')}}" class="fw-semibold text-primary text-decoration-underline"> Signup </a> </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-center">
                        <p class="mb-0 text-muted">&copy;
                            <script>document.write(new Date().getFullYear())</script> all rights reserved APC - Diaspora.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</div>

@endsection
