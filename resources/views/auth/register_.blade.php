@extends('admin.layouts.app')

@section('content')





<div class="page-content pt-150 pb-150">
    <div class="container">
        <div class="row">
            <div class="col-xl-8 col-lg-10 col-md-12 m-auto">
                <div class="card" bis_skin_checked="1">
                    <div class="card-header" bis_skin_checked="1">
                        <h4 class="card-title mb-0">Register User</h4>
                    </div><!-- end card header -->
                    <div class="card-body" bis_skin_checked="1">
                        <form action="#" class="form-steps" autocomplete="off">
                            <div class="text-center pt-3 pb-4 mb-1" bis_skin_checked="1">
                                <img src="assets/images/logo-dark.png" alt="" height="17">
                            </div>
                            <div class="step-arrow-nav mb-4" bis_skin_checked="1">

                                <ul class="nav nav-pills custom-nav nav-justified" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link active" id="steparrow-gen-info-tab" data-bs-toggle="pill" data-bs-target="#steparrow-gen-info" type="button" role="tab" aria-controls="steparrow-gen-info" aria-selected="true" data-position="0">Personal</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="steparrow-description-info-tab" data-bs-toggle="pill" data-bs-target="#steparrow-description-info" type="button" role="tab" aria-controls="steparrow-description-info" aria-selected="false" data-position="1" tabindex="-1">Organizational</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="pills-experience-tab" data-bs-toggle="pill" data-bs-target="#pills-experience" type="button" role="tab" aria-controls="pills-experience" aria-selected="false" data-position="2" tabindex="-1">Address</button>
                                    </li>
                                </ul>
                            </div>

                            <div class="tab-content" bis_skin_checked="1">

                                {!! Form::open(['route' => 'register', 'method' => 'POST', 'files' => true]) !!}
                
                                    {!! Form::hidden('user_type', 2, ['value' => 2]) !!}
                                    <div class="tab-pane fade active show" id="steparrow-gen-info" role="tabpanel" aria-labelledby="steparrow-gen-info-tab" bis_skin_checked="1">
                                        
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
                                        {{-- <div class="d-flex align-items-start gap-3 mt-4" bis_skin_checked="1">
                                            <button type="button" class="btn btn-success btn-label right ms-auto nexttab nexttab" data-nexttab="steparrow-description-info-tab"><i class="ri-arrow-right-line label-icon align-middle fs-16 ms-2"></i>Go to more info</button>
                                        </div> --}}
                                    </div>
                                    <!-- end tab pane -->

                                    <div class="tab-pane fade" id="steparrow-description-info" role="tabpanel" aria-labelledby="steparrow-description-info-tab" bis_skin_checked="1">
                                        
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
                                        {{-- <div class="d-flex align-items-start gap-3 mt-4" bis_skin_checked="1">
                                            <button type="button" class="btn btn-light btn-label previestab" data-previous="steparrow-gen-info-tab"><i class="ri-arrow-left-line label-icon align-middle fs-16 me-2"></i> Back to General</button>
                                            <button type="button" class="btn btn-success btn-label right ms-auto nexttab nexttab" data-nexttab="pills-experience-tab"><i class="ri-arrow-right-line label-icon align-middle fs-16 ms-2"></i>Next</button>
                                        </div> --}}
                                    </div>
                                    <!-- end tab pane -->

                                    <div class="tab-pane fade" id="pills-experience" role="tabpanel" bis_skin_checked="1" aria-labelledby="#pills-experience-tab">
                                        
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
                                                    {{-- {!! Form::select('country', $countries->pluck('name', 'id'), null, ['placeholder' => 'Select Country','class' => 'form-control form-select', 'required']) !!} --}}
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
                                        
                                        {{-- <div class="text-center" bis_skin_checked="1">

                                            <div class="avatar-md mt-5 mb-4 mx-auto" bis_skin_checked="1">
                                                <div class="avatar-title bg-light text-success display-4 rounded-circle" bis_skin_checked="1">
                                                    <i class="ri-checkbox-circle-fill"></i>
                                                </div>
                                            </div>
                                            <h5>Well Done !</h5>
                                            <p class="text-muted">You have Successfully Signed Up</p>
                                        </div> --}}
                                        <div class="d-flex align-items-start gap-3 mt-4" bis_skin_checked="1">
                                            {{-- <button type="button" class="btn btn-light btn-label previestab" data-previous="steparrow-gen-info-tab"><i class="ri-arrow-left-line label-icon align-middle fs-16 me-2"></i> Back to General</button> --}}
                                            {{-- <button type="submit"  class="btn btn-success btn-label right ms-auto nexttab nexttab" data-nexttab="pills-experience-tab"><i class="ri-arrow-right-line label-icon align-middle fs-16 ms-2"></i>Submit</button> --}}
                                        
                                            <button type="submit" class="btn btn-primary">
                                                {{ __('Register') }}
                                            </button>
                                        </div>
                                    </div>
                                    <!-- end tab pane -->
                                {!! Form::close() !!}
                            </div>
                            <!-- end tab content -->
                        </form>
                    </div>
                    <!-- end card body -->
                </div>
            </div>
        </div>
    </div>
</div>



<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    {{-- <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="text text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="text text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="text text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form> --}}


                    
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
                    {{-- <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div> --}}
                    <div class="text-end mt-4 pe-3">
                        <a href="{{ route('users.index') }}" class="btn btn-primary w-sm">Cancal</a>
                        <button type="submit" class="btn btn-success w-sm">Create</button>
                    </div>
                </div>
              {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
