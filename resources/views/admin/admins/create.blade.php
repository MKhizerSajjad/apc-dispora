@extends('admin.layouts.app')


@section('content')

  <div class="page-content">
    <div class="container-fluid">

      <!-- page title -->
      <div class="row">
        <div class="col-12">
          <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">Admins List</h4>

            <div class="page-title-right">
              <ol class="breadcrumb m-0">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active">Admins List</li>
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
      
      <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                  
                {!! Form::open(['route' => 'admins.store', 'method' => 'POST', 'files' => true]) !!}

                  {!! Form::hidden('user_type', 1, ['value' => 1]) !!}

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
                  <div class="row mt-2">
                      <div class="col-xs-4 col-sm-4 col-md-4">
                          <div class="form-group">
                              <label>Email</label>
                              {!! Form::text('email', null, ['placeholder' => 'Email', 'class' => 'form-control']) !!}
                          </div>
                      </div>
                      <div class="col-xs-4 col-sm-4 col-md-4">
                          <div class="form-group">
                              <label>Mobile Number</label>
                              {!! Form::tel('mobile_number', null, ['placeholder' => 'Mobile Number', 'class' => 'form-control']) !!}
                          </div>
                      </div>
                      <div class="col-xs-4 col-sm-4 col-md-4">
                          <div class="form-group">
                              <label>Status</label>
                              {!! Form::select('status', adminStatus(), [], ['class' => 'form-select', 'placeholder' => 'Select Membership Status']) !!}
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
                  <div class="row mt-2">
                      <div class="col-xs-12 col-sm-12 col-md-12">
                          <div class="form-group">
                              <label>Note</label>
                              {!! Form::textarea('note', null, ['placeholder' => 'Note', 'class' => 'form-control', 'rows' => 3]) !!}
                          </div>
                      </div>
                  </div>
                  <div class="row">
                      <div class="text-end mt-4 pe-3">
                          <a href="{{ route('admins.index') }}" class="btn btn-primary w-sm">Cancal</a>
                          <button type="submit" class="btn btn-success w-sm">Create</button>
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
        function adminStatus($status = null, $type= null)
        {
            if(isset($type)) {
                $response = [
                    'Active' => '<span class="badge badge-soft-info">Active</span>',
                    'Inactive' => '<span class="badge badge-soft-warning">Inactive</span>',
                ];
            } else {
                $response = [
                    'Active' => 'Active',
                    'Inactive' => 'Inactive',
                ];
            }

            if(isset($status) && $status != null) {
                return $response[$status];
            } else {
                return $response;
            }
        }
    @endphp
@endsection
