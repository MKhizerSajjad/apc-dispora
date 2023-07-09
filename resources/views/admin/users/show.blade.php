@extends('admin.layouts.app')
@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <!-- page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Profile</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                            <li class="breadcrumb-item active">Profile</li>
                        </ol>
                    </div>

                    </div>
                </div>
            </div>
        
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header border-0">
                    <div class="d-flex align-items-center">
                        <h5 class="card-title mb-0 flex-grow-1">My Profile</h5>
                        <div class="flex-shrink-0">
                          <a href="{{ route('users.edit', $user->id) }}" class="btn btn-danger add-btn">
                            <i class="ri-edit-line align-bottom me-1"></i>
                            Update My Profile
                          </a>
                        </div>
                    </div>
                    </div>
                    <div class="card-body">                        
                        <div class="row">
                            <div class="offset-xs-5 offset-sm-5 offset-md-5 col-xs-2 col-sm-2 col-md-2 mb-3">
                                <div class="form-group">
                                    <img src="{{ asset('images/users/'.$user->picture) }}" onerror="this.onerror=null;this.src='{{ asset('admin/images/users/user-dummy-img.jpg') }}';" class="rounded-circle avatar-xl img-thumbnail user-profile-image" alt="{{$user->first_name}}">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xs-4 col-sm-4 col-md-4">
                                <div class="form-group">
                                    <strong>Title</strong>
                                    {!! Form::select('title', userTitles(), $user->title, ['class' => 'form-select', 'placeholder' => 'Select Title', 'disabled' => 'disabled']) !!}
                                </div>
                            </div>
                            <div class="col-xs-4 col-sm-4 col-md-4">
                                <div class="form-group">
                                    <strong>First Name</strong>
                                    {!! Form::text('first_name', $user->first_name, ['placeholder' => 'First Name', 'class' => 'form-control', 'disabled' => 'disabled']) !!}
                                </div>
                            </div>
                            <div class="col-xs-4 col-sm-4 col-md-4">
                                <div class="form-group">
                                    <strong>Last Name</strong>
                                    {!! Form::text('last_name', $user->last_name, ['placeholder' => 'Last Name', 'class' => 'form-control', 'disabled' => 'disabled']) !!}
                                </div>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-xs-6 col-sm-6 col-md-6">
                                <div class="form-group">
                                    <strong>Email</strong>
                                    {!! Form::text('email', $user->email, ['placeholder' => 'Email', 'class' => 'form-control', 'disabled' => 'disabled']) !!}
                                </div>
                            </div>
                            <div class="col-xs-6 col-sm-6 col-md-6">
                                <div class="form-group">
                                    <strong>Mobile Number</strong>
                                    {!! Form::tel('mobile_number', $user->mobile_number, ['placeholder' => 'Mobile Number', 'class' => 'form-control', 'disabled' => 'disabled']) !!}
                                </div>
                            </div>
                            {{-- <div class="col-xs-4 col-sm-4 col-md-4">
                                <div class="form-group">
                                    <strong>Emergency Number </strong>
                                    {!! Form::tel('emergency_number', $user->emergency_number, ['placeholder' => 'Emergency Number', 'class' => 'form-control', 'disabled' => 'disabled']) !!}
                                </div>
                            </div> --}}
                        </div>
                        <div class="row mt-2">
                            <div class="col-xs-4 col-sm-4 col-md-4">
                                <div class="form-group">
                                    <label>Emmergence Relationship</label>
                                    {!! Form::select('emergency_relation', emergencyRelation(), $user->emergency_relation, ['class' => 'form-select', 'placeholder' => 'Select Relation', 'disabled' => 'disabled']) !!}
                                </div>
                            </div>
                            <div class="col-xs-4 col-sm-4 col-md-4">
                                <div class="form-group">
                                    <label>Emmergency Contact's Name</label>
                                    {!! Form::text('emergency_name', $user->emergency_name, ['placeholder' => 'Emergency Name', 'class' => 'form-control', 'disabled' => 'disabled']) !!}
                                </div>
                            </div>
                            <div class="col-xs-4 col-sm-4 col-md-4">
                                <div class="form-group">
                                    <label>Emergency Number </label>
                                    {!! Form::tel('emergency_number', $user->emergency_number, ['placeholder' => 'Emergency Number', 'class' => 'form-control', 'disabled' => 'disabled']) !!}
                                </div>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-xs-4 col-sm-4 col-md-4">
                                <div class="form-group">
                                    <strong>Date of birth</strong>
                                    {!! Form::date('date_of_birth', $user->date_of_birth, ['placeholder' => 'Date of birth', 'class' => 'form-control', 'disabled' => 'disabled']) !!}
                                </div>
                            </div>
                            <div class="col-xs-4 col-sm-4 col-md-4">
                                <div class="form-group">
                                    <strong>Registration date</strong>
                                    {!! Form::date('registration_date', $user->registration_date, ['placeholder' => 'Registration date', 'class' => 'form-control', 'disabled' => 'disabled']) !!}
                                </div>
                            </div>
                            <div class="col-xs-4 col-sm-4 col-md-4">
                                <div class="form-group">
                                    <strong>Occupation</strong>
                                    {!! Form::text('occupation', $user->occupation, ['placeholder' => 'Occupation', 'class' => 'form-control', 'disabled' => 'disabled']) !!}
                                </div>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-xs-4 col-sm-4 col-md-4">
                                <div class="form-group">
                                    <strong>Party Position</strong>
                                    {!! Form::text('party_position', $user->party_position, ['placeholder' => 'Party Position', 'class' => 'form-control', 'disabled' => 'disabled']) !!}
                                </div>
                            </div>
                            <div class="col-xs-4 col-sm-4 col-md-4">
                                <div class="form-group">
                                    <strong>Branch</strong>
                                    {!! Form::text('branch', $user->branch, ['placeholder' => 'Branch', 'class' => 'form-control', 'disabled' => 'disabled']) !!}
                                </div>
                            </div>
                            <div class="col-xs-4 col-sm-4 col-md-4">
                                <div class="form-group">
                                    <strong>Chapter</strong>
                                    {!! Form::text('chapter', $user->chapter, ['placeholder' => 'Chapter', 'class' => 'form-control', 'disabled' => 'disabled']) !!}
                                </div>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-xs-4 col-sm-4 col-md-4">
                                <div class="form-group">
                                    <strong>Membership Type</strong>
                                    {!! Form::select('membership_type', membershipType(), $user->membership_type, ['class' => 'form-select', 'placeholder' => 'Select Membership Type', 'disabled' => 'disabled']) !!}
                                </div>
                            </div>
                            <div class="col-xs-4 col-sm-4 col-md-4">
                                <div class="form-group">
                                    <strong>Membership Status</strong>
                                    {!! Form::select('status', membershipStatus(), $user->status, ['class' => 'form-select', 'placeholder' => 'Select Membership Status', 'disabled' => 'disabled']) !!}
                                </div>
                            </div>
                            <div class="col-xs-4 col-sm-4 col-md-4">
                                <div class="form-group">
                                    <strong>Is Volunteer</strong>
                                    {!! Form::select('volunteer', status(), $user->volunteer, ['class' => 'form-select', 'placeholder' => 'Select Option', 'disabled' => 'disabled']) !!}
                                </div>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-xs-8 col-sm-8 col-md-8">
                                <div class="form-group">
                                    <strong>Address</strong>
                                    {!! Form::text('address', $user->address, ['placeholder' => 'Address', 'class' => 'form-control', 'disabled' => 'disabled']) !!}
                                </div>
                            </div>
                            <div class="col-xs-4 col-sm-4 col-md-4">
                                <div class="form-group">
                                    <strong>City</strong>
                                    {!! Form::text('city', $user->city, ['placeholder' => 'City', 'class' => 'form-control', 'disabled' => 'disabled']) !!}
                                </div>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-xs-4 col-sm-4 col-md-4">
                                <div class="form-group">
                                    <strong>State </strong>
                                    {!! Form::text('state', $user->state, ['placeholder' => 'State', 'class' => 'form-control', 'disabled' => 'disabled']) !!}
                                </div>
                            </div>
                            <div class="col-xs-4 col-sm-4 col-md-4">
                                <div class="form-group">
                                    <strong>Zip Code</strong>
                                    {!! Form::text('zipcode', $user->zipcode, ['placeholder' => 'zip Code', 'class' => 'form-control', 'disabled' => 'disabled']) !!}
                                </div>
                            </div>
                            <div class="col-xs-4 col-sm-4 col-md-4">
                                <div class="form-group">
                                    <strong>Country</strong>
                                    {!! Form::select('country', $countries->pluck('name', 'id'), $user->country, ['placeholder' => 'Select Country','class' => 'form-control form-select', 'required', 'disabled' => 'disabled']) !!}
                                </div>
                            </div>
                        </div>
                        {{-- <div class="row mt-2">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Note</strong>
                                    {!! Form::textarea('note', $user->note, ['placeholder' => 'Note', 'class' => 'form-control', 'rows' => 3, 'disabled' => 'disabled']) !!}
                                </div>
                            </div>
                        </div> --}}
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