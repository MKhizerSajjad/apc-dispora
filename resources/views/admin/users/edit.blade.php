@extends('admin.layouts.app')


@section('content')



<div class="page-content">
    <div class="container-fluid">

        <!-- page title -->
        <div class="row">
            <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Users List</h4>

                <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active">Users List</li>
                </ol>
                </div>

            </div>
            </div>
        </div>

        @if (count($errors) > 0)
            <div class="alert alert-danger alert-border-left alert-dismissible fade show auto-colse-10">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
      
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    {!! Form::model($user, ['method' => 'PATCH', 'files' => true, 'route' => ['users.update', $user->id]]) !!}
                        {{-- <div class="row">
                            <div class="col-xs-6 col-sm-6 col-md-6">
                                <div class="form-group">
                                    <strong>First Name</strong>
                                    {!! Form::text('first_name', null, ['placeholder' => 'First Name', 'class' => 'form-control']) !!}
                                </div>
                            </div>
                            <div class="col-xs-6 col-sm-6 col-md-6">
                                <div class="form-group">
                                    <strong>Last Name</strong>
                                    {!! Form::text('last_name', null, ['placeholder' => 'Last Name', 'class' => 'form-control']) !!}
                                </div>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-xs-6 col-sm-6 col-md-6">
                                <div class="form-group">
                                    <strong>Email</strong>
                                    {!! Form::text('email', null, ['placeholder' => 'Email', 'class' => 'form-control']) !!}
                                </div>
                            </div>
                            <div class="col-xs-6 col-sm-6 col-md-6">
                                <div class="form-group">
                                    <strong>Phone </strong>
                                    {!! Form::tel('phone', null, ['placeholder' => 'Phone', 'class' => 'form-control']) !!}
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
                        </div> --}}
                        
                        <div class="row">
                            <div class="offset-xs-4 offset-sm-4 offset-md-4 col-xs-4 col-sm-4 col-md-4 col-offset-4">
                                <div class="form-group">
                                    <strong>Picture</strong>
                                    <input type="file" class="form-control" id="picture" name="picture" placeholder="Icon"  accept="image/*">
                                    <img src="{{ asset('images/users/'.$user->picture) }}" onerror="{{ asset('images/users/user.jpg') }}" alt="{{ $user->first_name }}"  width="50" height="50">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xs-4 col-sm-4 col-md-4">
                                <div class="form-group">
                                    <strong>Title</strong>
                                    {!! Form::select('title', userTitles(), $user->title, ['class' => 'form-select', 'placeholder' => 'Select Title']) !!}
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
                                    {!! Form::select('membership_type', membershipType(), $user->membership_type, ['class' => 'form-select', 'placeholder' => 'Select Membership Type']) !!}
                                </div>
                            </div>
                            <div class="col-xs-4 col-sm-4 col-md-4">
                                <div class="form-group">
                                    <strong>Membership Status</strong>
                                    {!! Form::select('status', membershipStatus(), $user->status, ['class' => 'form-select', 'placeholder' => 'Select Membership Status']) !!}
                                </div>
                            </div>
                            <div class="col-xs-4 col-sm-4 col-md-4">
                                <div class="form-group">
                                    <strong>Is Volunteer</strong>
                                    {!! Form::select('volunteer', status(), $user->volunteer, ['class' => 'form-select', 'placeholder' => 'Select Option']) !!}
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
                                    {!! Form::select('country', $countries->pluck('name', 'id'), $user->country, ['placeholder' => 'Select Country','class' => 'form-control form-select', 'required']) !!}
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
                            <span class="text text-danger">Only input password if you want to update it.</span>
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
                            <div class="text-end mt-4 pe-3">
                                <a href="{{ route('users.index') }}" class="btn btn-primary w-sm">Cancal</a>
                                <button type="submit" class="btn btn-success w-sm">Update</button>
                            </div>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
  </div>
@endsection