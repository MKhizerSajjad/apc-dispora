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


                        <div class="step-arrow-nav mb-4" bis_skin_checked="1">

                            <ul class="nav nav-pills custom-nav nav-justified" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="steparrow-gen-info-tab" data-bs-toggle="pill" data-bs-target="#steparrow-gen-info" type="button" role="tab" aria-controls="steparrow-gen-info" aria-selected="true" data-position="0">Personal</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="steparrow-description-info-tab" data-bs-toggle="pill" data-bs-target="#steparrow-description-info" type="button" role="tab" aria-controls="steparrow-description-info" aria-selected="false" data-position="1" tabindex="-1">Organizational</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="steparrow-contact-info-tab" data-bs-toggle="pill" data-bs-target="#steparrow-contact-info" type="button" role="tab" aria-controls="steparrow-contact-info" aria-selected="false" data-position="1" tabindex="-1">Contact</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="pills-experience-tab" data-bs-toggle="pill" data-bs-target="#pills-experience" type="button" role="tab" aria-controls="pills-experience" aria-selected="false" data-position="2" tabindex="-1">Address</button>
                                </li>
                            </ul>
                        </div>

                        <div class="card-body">

                            <div class="text-center mt-2">
                                <h5 class="text-primary">{{ __('Welcome !') }}</h5>
                                <p class="text-muted">{{ __('Sign up to continue to portal') }}</p>
                            </div>

                            {!! Form::open(['route' => 'register', 'method' => 'POST', 'files' => true]) !!}

                                {!! Form::hidden('user_type', 2, ['value' => 2]) !!}

                                @if (count($errors) > 0)
                                    <div class="alert alert-danger alert-border-left alert-dismissible fade show auto-colse-10">
                                        <label>Whoops!</label> There were some problems with your input.<br><br>
                                        <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                        </ul>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                @endif

                                <div class="tab-content" bis_skin_checked="1">
                                    <div class="tab-pane fade active show" id="steparrow-gen-info" role="tabpanel" aria-labelledby="steparrow-gen-info-tab" bis_skin_checked="1">

                                        <div class="row">
                                            <div class="offset-xs-4 offset-sm-4 offset-md-4 col-xs-4 col-sm-4 col-md-4 col-offset-4 mb-2">
                                                <div class="form-group">
                                                    <label>Picture</label>
                                                    <input type="file" class="form-control" id="picture" name="picture" placeholder="Icon"  accept="image/*">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-xs-4 col-sm-4 col-md-4">
                                                <div class="form-group">
                                                    <label>Title</label>
                                                    {!! Form::select('title', userTitles(), [], ['class' => 'form-select', 'placeholder' => 'Select Title']) !!}
                                                </div>
                                            </div>
                                            <div class="col-xs-4 col-sm-4 col-md-4">
                                                <div class="form-group">
                                                    <label>First Name</label>
                                                    {!! Form::text('first_name', null, ['placeholder' => 'First Name', 'class' => 'form-control']) !!}
                                                </div>
                                            </div>
                                            <div class="col-xs-4 col-sm-4 col-md-4">
                                                <div class="form-group">
                                                    <label>Last Name</label>
                                                    {!! Form::text('last_name', null, ['placeholder' => 'Last Name', 'class' => 'form-control']) !!}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mt-2 mb-2">
                                            <div class="col-xs-4 col-sm-4 col-md-4">
                                                <div class="form-group">
                                                    <label>Date of birth</label>
                                                    {!! Form::date('date_of_birth', null, ['placeholder' => 'Date of birth', 'class' => 'form-control']) !!}
                                                </div>
                                            </div>
                                            <div class="col-xs-4 col-sm-4 col-md-4">
                                                <div class="form-group">
                                                    <label>Registration date</label>
                                                    {!! Form::date('registration_date', null, ['placeholder' => 'Registration date', 'class' => 'form-control']) !!}
                                                </div>
                                            </div>
                                            <div class="col-xs-4 col-sm-4 col-md-4">
                                                <div class="form-group">
                                                    <label>Occupation</label>
                                                    {!! Form::text('occupation', null, ['placeholder' => 'Occupation', 'class' => 'form-control']) !!}
                                                </div>
                                            </div>
                                        </div>
                                        {{-- <div class="d-flex align-items-start gap-3 mt-4" bis_skin_checked="1">
                                            <button type="button" class="btn btn-success btn-label right ms-auto nexttab nexttab" data-nexttab="pills-experience-tab"><i class="ri-arrow-right-line label-icon align-middle fs-16 ms-2"></i>Next</button>
                                        </div> --}}
                                    </div>
                                    <div class="tab-pane fade" id="steparrow-contact-info" role="tabpanel" aria-labelledby="steparrow-contact-info-tab" bis_skin_checked="1">
                                        <div class="row mt-2">
                                            <div class="col-xs-6 col-sm-6 col-md-6">
                                                <div class="form-group">
                                                    <label>Email</label>
                                                    {!! Form::text('email', null, ['placeholder' => 'Email', 'class' => 'form-control']) !!}
                                                </div>
                                            </div>
                                            <div class="col-xs-6 col-sm-6 col-md-6">
                                                <div class="form-group">
                                                    <label>Mobile Number</label>
                                                    {!! Form::tel('mobile_number', null, ['placeholder' => 'Mobile Number', 'class' => 'form-control']) !!}
                                                </div>
                                            </div>
                                            {{-- <div class="col-xs-4 col-sm-4 col-md-4">
                                                <div class="form-group">
                                                    <label>Emergency Number </label>
                                                    {!! Form::tel('emergency_number', null, ['placeholder' => 'Emergency Number', 'class' => 'form-control']) !!}
                                                </div>
                                            </div> --}}
                                        </div>
                                        <div class="row mt-2">
                                            <div class="col-xs-4 col-sm-4 col-md-4">
                                                <div class="form-group">
                                                    <label>Emmergence Relationship</label>
                                                    {!! Form::select('emergency_relation', emergencyRelation(), [], ['class' => 'form-select', 'placeholder' => 'Select Relation']) !!}
                                                </div>
                                            </div>
                                            <div class="col-xs-4 col-sm-4 col-md-4">
                                                <div class="form-group">
                                                    <label>Emmergency Contact's Name</label>
                                                    {!! Form::text('emergency_name', null, ['placeholder' => 'Emergency Name', 'class' => 'form-control']) !!}
                                                </div>
                                            </div>
                                            <div class="col-xs-4 col-sm-4 col-md-4">
                                                <div class="form-group">
                                                    <label>Emergency Number </label>
                                                    {!! Form::tel('emergency_number', null, ['placeholder' => 'Emergency Number', 'class' => 'form-control']) !!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="steparrow-description-info" role="tabpanel" aria-labelledby="steparrow-description-info-tab" bis_skin_checked="1">
                                        <div class="row mt-2">
                                            <div class="col-xs-4 col-sm-4 col-md-4">
                                                <div class="form-group">
                                                    <label>Party Position</label>
                                                    {!! Form::text('party_position', null, ['placeholder' => 'Party Position', 'class' => 'form-control']) !!}
                                                </div>
                                            </div>
                                            <div class="col-xs-4 col-sm-4 col-md-4">
                                                <div class="form-group">
                                                    <label>Branch</label>
                                                    {!! Form::text('branch', null, ['placeholder' => 'Branch', 'class' => 'form-control']) !!}
                                                </div>
                                            </div>
                                            <div class="col-xs-4 col-sm-4 col-md-4">
                                                <div class="form-group">
                                                    <label>Chapter</label>
                                                    {!! Form::text('chapter', null, ['placeholder' => 'Chapter', 'class' => 'form-control']) !!}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mt-2 mb-2">
                                            <div class="col-xs-4 col-sm-4 col-md-4">
                                                <div class="form-group">
                                                    <label>Membership Type</label>
                                                    {!! Form::select('membership_type', membershipType(), [], ['class' => 'form-select', 'placeholder' => 'Select Membership Type']) !!}
                                                </div>
                                            </div>
                                            <div class="col-xs-4 col-sm-4 col-md-4">
                                                <div class="form-group">
                                                    <label>Membership Status</label>
                                                    {!! Form::select('status', membershipStatus(), [], ['class' => 'form-select', 'placeholder' => 'Select Membership Status']) !!}
                                                </div>
                                            </div>
                                            <div class="col-xs-4 col-sm-4 col-md-4">
                                                <div class="form-group">
                                                    <label>Is Volunteer</label>
                                                    {!! Form::select('volunteer', status(), [], ['class' => 'form-select', 'placeholder' => 'Select Option']) !!}
                                                </div>
                                            </div>
                                        </div>

                                        {{-- <div class="d-flex align-items-start gap-3 mt-4" bis_skin_checked="1">
                                            <button type="button" class="btn btn-light btn-label previestab" data-previous="steparrow-gen-info-tab"><i class="ri-arrow-left-line label-icon align-middle fs-16 me-2"></i> Back to General</button>
                                            <button type="button" class="btn btn-success btn-label right ms-auto nexttab nexttab" data-nexttab="pills-experience-tab"><i class="ri-arrow-right-line label-icon align-middle fs-16 ms-2"></i>Next</button>
                                        </div> --}}
                                    </div>
                                    <div class="tab-pane fade" id="pills-experience" role="tabpanel" bis_skin_checked="1" aria-labelledby="#pills-experience-tab">

                                        <div class="row mt-2">
                                            <div class="col-xs-8 col-sm-8 col-md-8">
                                                <div class="form-group">
                                                    <label>Address</label>
                                                    {!! Form::text('address', null, ['placeholder' => 'Address', 'class' => 'form-control']) !!}
                                                </div>
                                            </div>
                                            <div class="col-xs-4 col-sm-4 col-md-4">
                                                <div class="form-group">
                                                    <label>City</label>
                                                    {!! Form::text('city', null, ['placeholder' => 'City', 'class' => 'form-control']) !!}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mt-2">
                                        <div class="col-xs-4 col-sm-4 col-md-4">
                                            <div class="form-group">
                                                <label>State </label>
                                                {!! Form::text('state', null, ['placeholder' => 'State', 'class' => 'form-control']) !!}
                                            </div>
                                        </div>
                                            <div class="col-xs-4 col-sm-4 col-md-4">
                                                <div class="form-group">
                                                    <label>Zip Code</label>
                                                    {!! Form::text('zipcode', null, ['placeholder' => 'zip Code', 'class' => 'form-control']) !!}
                                                </div>
                                            </div>
                                            <div class="col-xs-4 col-sm-4 col-md-4">
                                                <div class="form-group">
                                                    <label>Country</label>
                                                    {{-- {!! Form::text('country', 1, ['placeholder' => 'zip Code', 'class' => 'form-control']) !!} --}}

                                                    {!! Form::select('country', getCountries(), null, ['placeholder' => 'Select Country','class' => 'form-control form-select', 'required']) !!}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mt-2">
                                            <div class="col-xs-6 col-sm-6 col-md-6">
                                                <div class="form-group">
                                                    <label>Password</label>
                                                    {!! Form::password('password', ['placeholder' => 'Password', 'class' => 'form-control']) !!}
                                                </div>
                                            </div>
                                            <div class="col-xs-6 col-sm-6 col-md-6">
                                                <div class="form-group">
                                                    <label>Confirm Password</label>
                                                    {!! Form::password('password_confirmation', ['placeholder' => 'Confirm Password', 'class' => 'form-control']) !!}
                                                </div>
                                            </div>
                                        </div>
                                        {{-- <div class="row mt-2">
                                            <div class="col-xs-12 col-sm-12 col-md-12">
                                                <div class="form-group">
                                                    <label>Note</label>
                                                    {!! Form::textarea('note', null, ['placeholder' => 'Note', 'class' => 'form-control', 'rows' => 3]) !!}
                                                </div>
                                            </div>
                                        </div> --}}

                                        {{-- <div class="d-flex align-items-start gap-3 mt-4" bis_skin_checked="1">
                                            <button type="button" class="btn btn-light btn-label previestab" data-previous="steparrow-gen-info-tab"><i class="ri-arrow-left-line label-icon align-middle fs-16 me-2"></i> Back to General</button>
                                            <button ype="submit" class="btn btn-success btn-label right ms-auto nexttab nexttab" data-nexttab="pills-experience-tab"><i class="ri-arrow-right-line label-icon align-middle fs-16 ms-2"></i>Signup</button>
                                        </div> --}}
                                        <div class="row">
                                            <div class="mt-4">
                                                <button class="btn btn-success w-100 hover-up" type="submit">{{ __('Signup') }}</button>
                                            </div>
                                        </div>
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

@php
    use App\Models\Countries;

    function userTitles($title = null)
    {
        $title = [
            'Mr' => 'Mr'    ,
            'Mrs' => 'Mrs'    ,
            'Miss' => 'Miss'  ,
            'Doctor' => 'Doctor',
        ];

        return $title;
    }
    function getCountries($title = null)
    {
        $countries = Countries::where('status', 'Active')->orderBy('name')->pluck('name', 'id');
        return $countries;
    }   
    function membershipType($type = null)
    {
        $type = [
            'Ordinary' => 'Ordinary',
            'Honorary Foundation' => 'Honorary Foundation',
            'Honorary Executive' => 'Honorary Executive',
        ];

        return $type;
    }

    function emergencyRelation($type = null)
    {
        $type = [
            'Husband' => 'Husband',
            'Wife' => 'Wife',
            'Partner' => 'Partner',
            'Father' => 'Father',
            'Mother' => 'Mother',
            'Sister' => 'Sister',
            'Brother' => 'Brother',
            'Friend' => 'Friend',
            'Colleague' => 'Colleague',
        ];

        return $type;
    }
    function membershipStatus($status = null, $type= null)
    {
        if(isset($type)) {
            $response = [
                'Active' => '<span class="badge badge-soft-info">Active</span>',
                'Dormant' => '<span class="badge badge-soft-success">Dormant</span>',
                'Inactive' => '<span class="badge badge-soft-warning">Inactive</span>',
                'Expired' => '<span class="badge badge-soft-danger">Expired</span>'
            ];
        } else {
            $response = [
                'Active' => 'Active',
                'Dormant' => 'Dormant',
                'Inactive' => 'Inactive',
                'Expired' => 'Expired',
            ];
        }

        if(isset($status) && $status != null) {
            return $response[$status];
        } else {
            return $response;
        }
    }

    function status($status = null)
    {
        $status = [
            'Yes' => 'Yes',
            'No' => 'No',
        ];

        return $status;
    } 
@endphp
@endsection
