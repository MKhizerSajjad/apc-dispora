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
            <label>Whoops!</label> There were some problems with your input.<br><br>
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
                                    <label>First Name</label>
                                    {!! Form::text('first_name', null, ['placeholder' => 'First Name', 'class' => 'form-control']) !!}
                                </div>
                            </div>
                            <div class="col-xs-6 col-sm-6 col-md-6">
                                <div class="form-group">
                                    <label>Last Name</label>
                                    {!! Form::text('last_name', null, ['placeholder' => 'Last Name', 'class' => 'form-control']) !!}
                                </div>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-xs-6 col-sm-6 col-md-6">
                                <div class="form-group">
                                    <label>Email</label>
                                    {!! Form::text('email', null, ['placeholder' => 'Email', 'class' => 'form-control']) !!}
                                </div>
                            </div>
                            <div class="col-xs-6 col-sm-6 col-md-6">
                                <div class="form-group">
                                    <label>Phone </label>
                                    {!! Form::tel('phone', null, ['placeholder' => 'Phone', 'class' => 'form-control']) !!}
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
                        </div> --}}
                        
                        <div class="row">
                            <div class="offset-xs-4 offset-sm-4 offset-md-4 col-xs-4 col-sm-4 col-md-4 col-offset-4">
                                <div class="form-group">
                                    <label>Picture</label>
                                    <input type="file" class="form-control" id="picture" name="picture" placeholder="Icon"  accept="image/*">
                                    <img src="{{ asset('images/users/'.$user->picture) }}"  onerror="this.onerror=null;this.src='{{ asset('admin/images/users/user-dummy-img.jpg') }}';" alt="{{ $user->first_name }}"  width="50" height="50">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xs-4 col-sm-4 col-md-4">
                                <div class="form-group">
                                    <label>Title</label>
                                    {!! Form::select('title', userTitles(), $user->title, ['class' => 'form-select', 'placeholder' => 'Select Title', 'disabled' => 'disabled']) !!}
                                </div>
                            </div>
                            <div class="col-xs-4 col-sm-4 col-md-4">
                                <div class="form-group">
                                    <label>First Name</label>
                                    {!! Form::text('first_name', null, ['placeholder' => 'First Name', 'class' => 'form-control', 'disabled' => 'disabled']) !!}
                                </div>
                            </div>
                            <div class="col-xs-4 col-sm-4 col-md-4">
                                <div class="form-group">
                                    <label>Last Name</label>
                                    {!! Form::text('last_name', null, ['placeholder' => 'Last Name', 'class' => 'form-control', 'disabled' => 'disabled']) !!}
                                </div>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-xs-6 col-sm-6 col-md-6">
                                <div class="form-group">
                                    <label>Email</label>
                                    {!! Form::text('email', null, ['placeholder' => 'Email', 'class' => 'form-control', 'disabled' => 'disabled']) !!}
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
                                    {!! Form::select('emergency_relation', emergencyRelation(), $user->emergency_relation, ['class' => 'form-select', 'placeholder' => 'Select Relation']) !!}
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
                        <div class="row mt-2">
                            <div class="col-xs-4 col-sm-4 col-md-4">
                                <div class="form-group">
                                    <label>Date of birth</label>
                                    {!! Form::date('date_of_birth', null, ['placeholder' => 'Date of birth', 'class' => 'form-control', 'disabled' => 'disabled']) !!}
                                </div>
                            </div>
                            <div class="col-xs-4 col-sm-4 col-md-4">
                                <div class="form-group">
                                    <label>Registration date</label>
                                    {!! Form::date('registration_date', null, ['placeholder' => 'Registration date', 'class' => 'form-control', 'disabled' => 'disabled']) !!}
                                </div>
                            </div>
                            <div class="col-xs-4 col-sm-4 col-md-4">
                                <div class="form-group">
                                    <label>Occupation</label>
                                    {!! Form::text('occupation', null, ['placeholder' => 'Occupation', 'class' => 'form-control']) !!}
                                </div>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-xs-4 col-sm-4 col-md-4">
                                <div class="form-group">
                                    <label>Party Position</label>
                                    {!! Form::text('party_position', null, ['placeholder' => 'Party Position', 'class' => 'form-control', 'disabled' => 'disabled']) !!}
                                </div>
                            </div>
                            <div class="col-xs-4 col-sm-4 col-md-4">
                                <div class="form-group">
                                    <label>Branch</label>
                                    {!! Form::text('branch', null, ['placeholder' => 'Branch', 'class' => 'form-control', 'disabled' => 'disabled']) !!}
                                </div>
                            </div>
                            <div class="col-xs-4 col-sm-4 col-md-4">
                                <div class="form-group">
                                    <label>Chapter</label>
                                    {!! Form::text('chapter', null, ['placeholder' => 'Chapter', 'class' => 'form-control', 'disabled' => 'disabled']) !!}
                                </div>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-xs-4 col-sm-4 col-md-4">
                                <div class="form-group">
                                    <label>Membership Type</label>
                                    {!! Form::select('membership_type', membershipType(), $user->membership_type, ['class' => 'form-select', 'placeholder' => 'Select Membership Type', 'disabled' => 'disabled']) !!}
                                </div>
                            </div>
                            <div class="col-xs-4 col-sm-4 col-md-4">
                                <div class="form-group">
                                    <label>Membership Status</label>
                                    {!! Form::select('status', membershipStatus(), $user->status, ['class' => 'form-select', 'placeholder' => 'Select Membership Status', 'disabled' => 'disabled']) !!}
                                </div>
                            </div>
                            <div class="col-xs-4 col-sm-4 col-md-4">
                                <div class="form-group">
                                    <label>Is Volunteer</label>
                                    {!! Form::select('volunteer', status(), $user->volunteer, ['class' => 'form-select', 'placeholder' => 'Select Option', 'disabled' => 'disabled']) !!}
                                </div>
                            </div>
                        </div>
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
                                    {!! Form::select('country', $countries->pluck('name', 'id'), $user->country, ['placeholder' => 'Select Country','class' => 'form-control form-select', 'required']) !!}
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
                            <span class="text text-danger">Only input password if you want to update it.</span>
                        </div>
                        {{-- <div class="row mt-2">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label>Note</label>
                                    {!! Form::textarea('note', null, ['placeholder' => 'Note', 'class' => 'form-control', 'rows' => 3]) !!}
                                </div>
                            </div>
                        </div> --}}
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

    @php
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
        function membershipType($type = null)
        {
            $type = [
                'Ordinary' => 'Ordinary',
                'Honorary Foundation' => 'Honorary Foundation',
                'Honorary Executive' => 'Honorary Executive',
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