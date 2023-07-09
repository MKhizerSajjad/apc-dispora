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
                <div class="col-md-8 col-lg-8 col-xl-8">
                    <div class="card">
                        {{-- <div class="card-header">{{ __('Register') }}</div> --}}

                        <div class="card-body">
                            
                            <div class="text-center mt-2">
                                <h5 class="text-primary">{{ __('Welcome !') }}</h5>
                                <p class="text-muted">{{ __('Sign up to continue to portal') }}</p>
                            </div>
                            
                            {!! Form::open(['route' => 'register', 'method' => 'POST', 'files' => true]) !!}

                                {!! Form::hidden('user_type', 2, ['value' => 2]) !!}

                                <div class="row">
                                    <div class="offset-xs-4 offset-sm-4 offset-md-4 col-xs-4 col-sm-4 col-md-4 col-offset-4 mb-2">
                                        <div class="form-group">
                                            <strong>Picture</strong>
                                            <input type="file" class="form-control" id="picture" name="picture" placeholder="Icon"  accept="image/*">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-xs-4 col-sm-4 col-md-4">
                                        <div class="form-group">
                                            <strong>Title</strong>
                                            {!! Form::select('title', userTitles(), [], ['class' => 'form-select', 'placeholder' => 'Select Title']) !!}
                                        </div>
                                    </div>
                                    <div class="col-xs-4 col-sm-4 col-md-4">
                                        <div class="form-group">
                                            <strong>First Name</strong>
                                            {!! Form::text('first_name', null, ['placeholder' => 'First Name', 'class' => 'form-control']) !!}
                                        </div>
                                    </div>
                                    <div class="col-xs-4 col-sm-4 col-md-4">
                                        <div class="form-group">
                                            <strong>Last Name</strong>
                                            {!! Form::text('last_name', null, ['placeholder' => 'Last Name', 'class' => 'form-control']) !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-xs-4 col-sm-4 col-md-4">
                                        <div class="form-group">
                                            <strong>Email</strong>
                                            {!! Form::text('email', null, ['placeholder' => 'Email', 'class' => 'form-control']) !!}
                                        </div>
                                    </div>
                                    <div class="col-xs-4 col-sm-4 col-md-4">
                                        <div class="form-group">
                                            <strong>Mobile Number</strong>
                                            {!! Form::tel('mobile_number', null, ['placeholder' => 'Mobile Number', 'class' => 'form-control']) !!}
                                        </div>
                                    </div>
                                    <div class="col-xs-4 col-sm-4 col-md-4">
                                        <div class="form-group">
                                            <strong>Emergency Number </strong>
                                            {!! Form::tel('emergency_number', null, ['placeholder' => 'Emergency Number', 'class' => 'form-control']) !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-xs-4 col-sm-4 col-md-4">
                                        <div class="form-group">
                                            <strong>Date of birth</strong>
                                            {!! Form::date('date_of_birth', null, ['placeholder' => 'Date of birth', 'class' => 'form-control']) !!}
                                        </div>
                                    </div>
                                    <div class="col-xs-4 col-sm-4 col-md-4">
                                        <div class="form-group">
                                            <strong>Registration date</strong>
                                            {!! Form::date('registration_date', null, ['placeholder' => 'Registration date', 'class' => 'form-control']) !!}
                                        </div>
                                    </div>
                                    <div class="col-xs-4 col-sm-4 col-md-4">
                                        <div class="form-group">
                                            <strong>Occupation</strong>
                                            {!! Form::text('occupation', null, ['placeholder' => 'Occupation', 'class' => 'form-control']) !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-xs-4 col-sm-4 col-md-4">
                                        <div class="form-group">
                                            <strong>Party Position</strong>
                                            {!! Form::text('party_position', null, ['placeholder' => 'Party Position', 'class' => 'form-control']) !!}
                                        </div>
                                    </div>
                                    <div class="col-xs-4 col-sm-4 col-md-4">
                                        <div class="form-group">
                                            <strong>Branch</strong>
                                            {!! Form::text('branch', null, ['placeholder' => 'Branch', 'class' => 'form-control']) !!}
                                        </div>
                                    </div>
                                    <div class="col-xs-4 col-sm-4 col-md-4">
                                        <div class="form-group">
                                            <strong>Chapter</strong>
                                            {!! Form::text('chapter', null, ['placeholder' => 'Chapter', 'class' => 'form-control']) !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-xs-4 col-sm-4 col-md-4">
                                        <div class="form-group">
                                            <strong>Membership Type</strong>
                                            {!! Form::select('membership_type', membershipType(), [], ['class' => 'form-select', 'placeholder' => 'Select Membership Type']) !!}
                                        </div>
                                    </div>
                                    <div class="col-xs-4 col-sm-4 col-md-4">
                                        <div class="form-group">
                                            <strong>Membership Status</strong>
                                            {!! Form::select('status', membershipStatus(), [], ['class' => 'form-select', 'placeholder' => 'Select Membership Status']) !!}
                                        </div>
                                    </div>
                                    <div class="col-xs-4 col-sm-4 col-md-4">
                                        <div class="form-group">
                                            <strong>Is Volunteer</strong>
                                            {!! Form::select('volunteer', status(), [], ['class' => 'form-select', 'placeholder' => 'Select Option']) !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-xs-8 col-sm-8 col-md-8">
                                        <div class="form-group">
                                            <strong>Address</strong>
                                            {!! Form::text('address', null, ['placeholder' => 'Address', 'class' => 'form-control']) !!}
                                        </div>
                                    </div>
                                    <div class="col-xs-4 col-sm-4 col-md-4">
                                        <div class="form-group">
                                            <strong>City</strong>
                                            {!! Form::tel('city', null, ['placeholder' => 'Mobile Number', 'class' => 'form-control']) !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                <div class="col-xs-4 col-sm-4 col-md-4">
                                    <div class="form-group">
                                        <strong>State </strong>
                                        {!! Form::text('state', null, ['placeholder' => 'State', 'class' => 'form-control']) !!}
                                    </div>
                                </div>
                                    <div class="col-xs-4 col-sm-4 col-md-4">
                                        <div class="form-group">
                                            <strong>Zip Code</strong>
                                            {!! Form::text('zipcode', null, ['placeholder' => 'zip Code', 'class' => 'form-control']) !!}
                                        </div>
                                    </div>
                                    <div class="col-xs-4 col-sm-4 col-md-4">
                                        <div class="form-group">
                                            <strong>Country</strong>
                                            {!! Form::text('country', 1, ['placeholder' => 'zip Code', 'class' => 'form-control']) !!}

                                            {{-- {!! Form::select('country', $countries->pluck('name', 'id'), null, ['placeholder' => 'Select Country','class' => 'form-control form-select', 'required']) !!} --}}
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <strong>Password</strong>
                                            {!! Form::password('password', ['placeholder' => 'Password', 'class' => 'form-control']) !!}
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <strong>Confirm Password</strong>
                                            {!! Form::password('password_confirmation', ['placeholder' => 'Confirm Password', 'class' => 'form-control']) !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <strong>Note</strong>
                                            {!! Form::textarea('note', null, ['placeholder' => 'Note', 'class' => 'form-control', 'rows' => 3]) !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="mt-4">
                                        <button class="btn btn-success w-100 hover-up" type="submit">{{ __('Signup') }}</button>
                                    </div>
                                </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
                <div class="text-center" bis_skin_checked="1">
                    <p class="mb-0">Already have an account ? <a href="{{route('login')}}" class="fw-semibold text-primary text-decoration-underline"> Login </a> </p>
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
