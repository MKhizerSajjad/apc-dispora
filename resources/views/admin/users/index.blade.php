@extends('admin.layouts.app')


@section('content')
    <div class="page-content">
        <div class="container-fluid">

          <!-- page title -->
          <div class="row">
              <div class="col-12">
                  <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Memberships List</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                            <li class="breadcrumb-item active">Memberships List</li>
                        </ol>
                    </div>

                  </div>
              </div>
          </div>

          {{-- Cards --}}
          {{-- <div class="row">
              <div class="col-xxl-3 col-sm-6">
                  <div class="card card-animate">
                      <div class="card-body">
                          <div class="d-flex justify-content-between">
                            <div>
                                <p class="fw-medium text-muted mb-0">Total Tickets</p>
                                <h2 class="mt-4 ff-secondary fw-semibold"><span class="counter-value"
                                        data-target="547">0</span>k</h2>
                                <p class="mb-0 text-muted"><span class="badge bg-light text-success mb-0">
                                        <i class="ri-arrow-up-line align-middle"></i> 17.32 % </span> vs.
                                    previous month
                                </p>
                            </div>
                            <div>
                                <div class="avatar-sm flex-shrink-0">
                                    <span class="avatar-title bg-soft-info text-info rounded-circle fs-4">
                                        <i class="ri-ticket-2-line"></i>
                                    </span>
                                </div>
                            </div>
                          </div>
                      </div><!-- end card body -->
                  </div> <!-- end card-->
              </div>
              <!--end col-->
              <div class="col-xxl-3 col-sm-6">
                  <div class="card card-animate">
                      <div class="card-body">
                          <div class="d-flex justify-content-between">
                              <div>
                                  <p class="fw-medium text-muted mb-0">Pending Tickets</p>
                                  <h2 class="mt-4 ff-secondary fw-semibold"><span class="counter-value"
                                          data-target="124">0</span>k</h2>
                                  <p class="mb-0 text-muted">
                                      <span class="badge bg-light text-danger mb-0"> <i
                                              class="ri-arrow-down-line align-middle"></i> 0.96 % </span> vs. previous
                                      month
                                  </p>
                              </div>
                              <div>
                                  <div class="avatar-sm flex-shrink-0">
                                      <span class="avatar-title bg-soft-info text-info rounded-circle fs-4">
                                          <i class="mdi mdi-timer-sand"></i>
                                      </span>
                                  </div>
                              </div>
                          </div>
                      </div><!-- end card body -->
                  </div>
              </div>
              <!--end col-->
              <div class="col-xxl-3 col-sm-6">
                  <div class="card card-animate">
                      <div class="card-body">
                          <div class="d-flex justify-content-between">
                              <div>
                                  <p class="fw-medium text-muted mb-0">Closed Tickets</p>
                                  <h2 class="mt-4 ff-secondary fw-semibold"><span class="counter-value"
                                          data-target="107">0</span>K
                                  </h2>
                                  <p class="mb-0 text-muted"><span class="badge bg-light text-danger mb-0"> <i
                                              class="ri-arrow-down-line align-middle"></i> 3.87 % </span> vs.
                                      previous month
                                  </p>
                              </div>
                              <div>
                                  <div class="avatar-sm flex-shrink-0">
                                      <span class="avatar-title bg-soft-info text-info rounded-circle fs-4">
                                          <i class="ri-shopping-bag-line"></i>
                                      </span>
                                  </div>
                              </div>
                          </div>
                      </div><!-- end card body -->
                  </div>
              </div>
              <!--end col-->
              <div class="col-xxl-3 col-sm-6">
                  <div class="card card-animate">
                      <div class="card-body">
                          <div class="d-flex justify-content-between">
                              <div>
                                  <p class="fw-medium text-muted mb-0">Deleted Tickets</p>
                                  <h2 class="mt-4 ff-secondary fw-semibold"><span class="counter-value"
                                          data-target="15.95">0</span>%</h2>
                                  <p class="mb-0 text-muted"><span class="badge bg-light text-success mb-0">
                                          <i class="ri-arrow-up-line align-middle"></i> 1.09 % </span> vs.
                                      previous month</p>
                              </div>
                              <div>
                                  <div class="avatar-sm flex-shrink-0">
                                      <span class="avatar-title bg-soft-info text-info rounded-circle fs-4">
                                          <i class="ri-delete-bin-line"></i>
                                      </span>
                                  </div>
                              </div>
                          </div>
                      </div><!-- end card body -->
                  </div>
              </div>
              <!--end col-->
          </div> --}}

          @if ($message = Session::get('success'))
            <div class="alert alert-success alert-border-left alert-dismissible fade show auto-colse-3" role="alert">
              <i class="ri-check-double-line me-3 align-middle fs-16"></i><strong>Success! </strong>
              {{ $message }}
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
          @endif

          <div class="row">
              <div class="col-lg-12">
                  <div class="card" id="usersList">
                      <div class="card-header border-0">
                          <div class="d-flex align-items-center">
                              <h5 class="card-title mb-0 flex-grow-1">Memberships</h5>
                              <div class="flex-shrink-0">
                                <a href="{{ route('users.create') }}" class="btn btn-danger add-btn">
                                  <i class="ri-add-line align-bottom me-1"></i>
                                  Create Membership
                                </a>

                                @if (($filters))
                                    <a data-bs-toggle="modal" class="btn btn-soft-info" href="#fillterUser">
                                        <i class="ri-filter-2-line"></i>
                                    </a>
                                    <a href="{{ route('users.index') }}" class="btn btn-primary"><i class="ri-refresh-line"></i></a>
                                @else
                                    <a data-bs-toggle="modal" class="btn btn-soft-info" href="#fillterUser">
                                        <i class="ri-filter-2-line"></i>
                                    </a>
                                @endif
                                <div class="modal fade zoomIn" id="fillterUser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-lg">
                                        <div class="modal-content border-0">
                                            <div class="modal-header p-3 bg-soft-info">
                                                <h5 class="modal-title" id="exampleModalLabel">Search </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                                                    id="close-modal"></button>
                                            </div>
                                            {!! Form::open(['route' => 'users.index', 'method' => 'GET']) !!}
                                                <div class="modal-body">
                                                    <div class="row p-2">
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
                                                                    {!! Form::select('country', $countries->pluck('name', 'id'), null, ['placeholder' => 'Select Country','class' => 'form-control form-select']) !!}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <div class="hstack gap-2 justify-content-end">
                                                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Filter</button>
                                                    </div>
                                                </div>
                                            {!! Form::close() !!}
                                            {{-- <form>
                                                <div class="modal-body">
                                                    <div class="row g-3">
                                                        <div class="col-lg-12">
                                                            <div id="modal-id">
                                                                <label for="orderId" class="form-label">ID</label>
                                                                <input type="text" id="orderId" class="form-control" placeholder="ID"
                                                                    value="#VLZ462" readonly />
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12">
                                                            <div>
                                                                <label for="tasksTitle-field" class="form-label">Title</label>
                                                                <input type="text" id="tasksTitle-field" class="form-control"
                                                                    placeholder="Title" required />
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div>
                                                                <label for="client_nameName-field" class="form-label">Client
                                                                    Name</label>
                                                                <input type="text" id="client_nameName-field" class="form-control"
                                                                    placeholder="Client Name" required />
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div>
                                                                <label for="assignedtoName-field" class="form-label">Assigned
                                                                    To</label>
                                                                <input type="text" id="assignedtoName-field" class="form-control"
                                                                    placeholder="Assigned to" required />
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <label for="date-field" class="form-label">Create Date</label>
                                                            <input type="text" id="date-field" class="form-control" data-provider="flatpickr"
                                                                data-date-format="d M, Y" placeholder="Create Date" required />
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <label for="duedate-field" class="form-label">Due Date</label>
                                                            <input type="text" id="duedate-field" class="form-control"
                                                                data-provider="flatpickr" data-date-format="d M, Y" placeholder="Due Date"
                                                                required />
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <label for="ticket-status" class="form-label">Status</label>
                                                            <select class="form-control" data-plugin="choices" name="ticket-status"
                                                                id="ticket-status">
                                                                <option value="">Status</option>
                                                                <option value="New">New</option>
                                                                <option value="Inprogress">Inprogress</option>
                                                                <option value="Closed">Closed</option>
                                                                <option value="Open">Open</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <label for="priority-field" class="form-label">Priority</label>
                                                            <select class="form-control" data-plugin="choices" name="priority-field"
                                                                id="priority-field">
                                                                <option value="">Priority</option>
                                                                <option value="High">High</option>
                                                                <option value="Medium">Medium</option>
                                                                <option value="Low">Low</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <div class="hstack gap-2 justify-content-end">
                                                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-success" id="add-btn">Add Ticket</button>
                                                        <button type="button" class="btn btn-success" id="edit-btn">Update</button>
                                                    </div>
                                                </div>
                                            </form> --}}
                                        </div>
                                    </div>
                                </div>
                              </div>
                          </div>
                      </div>
                      {{-- <div class="card-body border border-dashed border-end-0 border-start-0">
                          <form>
                            <div class="row g-3">
                              <div class="col-xxl-5 col-sm-12">
                                <div class="search-box">
                                  <input type="text" class="form-control search bg-light border-light"
                                  placeholder="Search for ticket details or something...">
                                  <i class="ri-search-line search-icon"></i>
                                </div>
                              </div>
                              <!--end col-->

                              <div class="col-xxl-3 col-sm-4">
                                <input type="text" class="form-control bg-light border-light"
                                data-provider="flatpickr" data-date-format="d M, Y"
                                data-range-date="true" id="demo-datepicker"
                                placeholder="Select date range">
                              </div>
                              <!--end col-->

                              <div class="col-xxl-3 col-sm-4">
                                <div class="input-light">
                                  <select class="form-control" data-choices data-choices-search-false name="choices-single-default" id="idStatus">
                                    <option value="">Status</option>
                                    <option value="all" selected>All</option>
                                    <option value="Open">Open</option>
                                    <option value="Inprogress">Inprogress</option>
                                    <option value="Closed">Closed</option>
                                    <option value="New">New</option>
                                  </select>
                                </div>
                              </div>
                              <!--end col-->
                              <div class="col-xxl-1 col-sm-4">
                                <button type="button" class="btn btn-primary w-100"
                                onclick="SearchData();"> <i
                                class="ri-equalizer-fill me-1 align-bottom"></i>
                                Filters
                              </button>
                            </div>
                            <!--end col-->
                          </div>
                          <!--end row-->
                        </form>
                      </div> --}}
                  <!--end card-body-->
                  <div class="card-body">
                    @if (count($data) > 0)
                      <div class="table-responsive table-card mb-4">
                         <div id="buttons-datatables_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
                        
                          <table class="table align-middle table-nowrap mb-0" id="ticketTable">
                              <thead>
                                  <tr>
                                      {{-- <th scope="col" style="width: 40px;">
                                          <div class="form-check">
                                              <input class="form-check-input" type="checkbox" id="checkAll"
                                                  value="option">
                                          </div>
                                      </th> --}}
                                      
                                      <th data-sort="srno">No</th> {{-- class="sort" --}}
                                      <th data-sort="name">Photo</th>
                                      <th data-sort="name">Name</th>
                                      <th data-sort="email">Email</th>
                                      <th data-sort="mobile">Mobile</th>
                                      <th data-sort="country">Country</th>
                                      <th data-sort="branch">Branch</th>
                                      <th data-sort="membership_type">Membership Type</th>
                                      <th data-sort="status">Status</th>
                                      <th data-sort="action">Action</th>
                                  </tr>
                              </thead>
                              <tbody class="list form-check-all" id="ticket-list-data">

                                  @foreach ($data as $key => $user)
                                      <tr>
                                          <td class="srno"><a href="javascript:void(0);" onclick="ViewTickets(this)"
                                                  data-id="001" class="fw-medium link-primary">{{ ++$key }}</a>
                                          </td>
                                          <td><img src="{{ asset('images/users/'.$user->picture) }}" onerror="this.onerror=null;this.src='{{ asset('admin/images/users/user-dummy-img.jpg') }}';" alt="{{ $user->first_name }}" class="avatar-xs me-2"></td>
                                          <td class="name">{{ $user->first_name .' '. $user->last_name }}</td>
                                          <td class="email">{{ $user->email }}</td>
                                          <td class="mobile_number">{{ $user->mobile_number }}</td>
                                          <td class="country">{{ $user->countries->name ?? ''}}</td>
                                          <td class="branch">{{ $user->branch }}</td>
                                          <td class="membership_type">{{ $user->membership_type }}</td>
                                          <td class="status">{!! membershipStatus($user->status, 'badge') !!}</td>
                                          <td>
                                            <a data-bs-toggle="modal" href="#detailUser{{$user->id}}">
                                                <i class="ri-eye-fill align-bottom me-2 text-muted"></i>
                                            </a>
                                            <a href="{{ route('users.edit', $user->id) }}">
                                                <i class="ri-pencil-fill align-bottom me-2 text-muted"></i>
                                            </a>
                                            <a href="https://wa.me/{{$user->mobile_number}}" target="_blank">
                                                <i class="ri-whatsapp-fill align-bottom me-2 text-muted"></i>
                                            </a>
                                            {{-- <a data-bs-toggle="modal" href="#deleteOrder">
                                                <i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>
                                            </a> --}}
                                          </td>
                                      </tr>

                                    {{-- Detail Modal --}}
                                    <div class="modal fade zoomIn" id="detailUser{{$user->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-lg">
                                            <div class="modal-content border-0">
                                                <div class="modal-header p-3 bg-soft-info">
                                                    <h5 class="modal-title" id="exampleModalLabel">User Detail </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                                                        id="close-modal"></button>
                                                </div>
                                                {!! Form::open(['route' => 'users.index', 'method' => 'GET']) !!}
                                                    <div class="modal-body">
                                                        <div class="row p-2">                                     
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
                                                                <div class="col-xs-4 col-sm-4 col-md-4">
                                                                    <div class="form-group">
                                                                        <strong>Email</strong>
                                                                        {!! Form::text('email', $user->email, ['placeholder' => 'Email', 'class' => 'form-control', 'disabled' => 'disabled']) !!}
                                                                    </div>
                                                                </div>
                                                                <div class="col-xs-4 col-sm-4 col-md-4">
                                                                    <div class="form-group">
                                                                        <strong>Mobile Number</strong>
                                                                        {!! Form::tel('mobile_number', $user->mobile_number, ['placeholder' => 'Mobile Number', 'class' => 'form-control', 'disabled' => 'disabled']) !!}
                                                                    </div>
                                                                </div>
                                                                <div class="col-xs-4 col-sm-4 col-md-4">
                                                                    <div class="form-group">
                                                                        <strong>Emergency Number </strong>
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
                                                                        {!! Form::tel('city', $user->city, ['placeholder' => 'Mobile Number', 'class' => 'form-control', 'disabled' => 'disabled']) !!}
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
                                                                        {!! Form::select('country', $countries->pluck('name', 'id'), $user->country, ['placeholder' => 'Select Country','class' => 'form-control form-select', 'disabled' => 'disabled']) !!}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row mt-2">
                                                                <div class="col-xs-12 col-sm-12 col-md-12">
                                                                    <div class="form-group">
                                                                        <label>Note</label>
                                                                        {!! Form::textarea('note', $user->note, ['placeholder' => 'Note', 'class' => 'form-control', 'rows' => 3, 'disabled' => 'disabled']) !!}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <div class="hstack gap-2 justify-content-end">
                                                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>
                                                {!! Form::close() !!}
                                            </div>
                                        </div>
                                    </div>
                                  @endforeach
                              </tbody>
                          </table>

                          @if ($data->hasPages())
                            <div class="d-flex justify-content-end  mt-3 me-3">
                              <div class="pagination-wrap ">
                                {{-- {{ $data->render() }} --}}
                                {{ $data->onEachSide(5)->links() }}
                              </div>
                            </div>
                          @endif
                      </div>
                    @else
                      <div class="noresult">
                          <div class="text-center">
                              <lord-icon src="https://cdn.lordicon.com/msoeawqm.json" trigger="loop"
                                  colors="primary:#121331,secondary:#08a88a" style="width:75px;height:75px">
                              </lord-icon>
                              <h5 class="mt-2">Sorry! No Result Found</h5>
                              {{-- <p class="text-muted mb-0">We've searched more than 150+ Tickets We did not find any Tickets for you search.</p> --}}
                          </div>
                      </div>
                    @endif
                  </div>
              </div>
          </div>
        </div>

        {{-- Delete Modal --}}
        <div class="modal fade zoomIn" id="deleteOrder" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content border-0">
                    <div class="modal-header p-3 bg-soft-info">
                        <h5 class="modal-title" id="exampleModalLabel"></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                            id="close-modal"></button>
                    </div>
                    <form>
                        <div class="modal-body">
                            <div class="row g-3">
                                <div class="col-lg-12">
                                    <div id="modal-id">
                                        <label for="orderId" class="form-label">ID</label>
                                        <input type="text" id="orderId" class="form-control" placeholder="ID"
                                            value="#VLZ462" readonly />
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div>
                                        <label for="tasksTitle-field" class="form-label">Title</label>
                                        <input type="text" id="tasksTitle-field" class="form-control"
                                            placeholder="Title" required />
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div>
                                        <label for="client_nameName-field" class="form-label">Client
                                            Name</label>
                                        <input type="text" id="client_nameName-field" class="form-control"
                                            placeholder="Client Name" required />
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div>
                                        <label for="assignedtoName-field" class="form-label">Assigned
                                            To</label>
                                        <input type="text" id="assignedtoName-field" class="form-control"
                                            placeholder="Assigned to" required />
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <label for="date-field" class="form-label">Create Date</label>
                                    <input type="text" id="date-field" class="form-control" data-provider="flatpickr"
                                        data-date-format="d M, Y" placeholder="Create Date" required />
                                </div>
                                <div class="col-lg-6">
                                    <label for="duedate-field" class="form-label">Due Date</label>
                                    <input type="text" id="duedate-field" class="form-control"
                                        data-provider="flatpickr" data-date-format="d M, Y" placeholder="Due Date"
                                        required />
                                </div>
                                <div class="col-lg-6">
                                    <label for="ticket-status" class="form-label">Status</label>
                                    <select class="form-control" data-plugin="choices" name="ticket-status"
                                        id="ticket-status">
                                        <option value="">Status</option>
                                        <option value="New">New</option>
                                        <option value="Inprogress">Inprogress</option>
                                        <option value="Closed">Closed</option>
                                        <option value="Open">Open</option>
                                    </select>
                                </div>
                                <div class="col-lg-6">
                                    <label for="priority-field" class="form-label">Priority</label>
                                    <select class="form-control" data-plugin="choices" name="priority-field"
                                        id="priority-field">
                                        <option value="">Priority</option>
                                        <option value="High">High</option>
                                        <option value="Medium">Medium</option>
                                        <option value="Low">Low</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <div class="hstack gap-2 justify-content-end">
                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-success" id="add-btn">Add Ticket</button>
                                <button type="button" class="btn btn-success" id="edit-btn">Update</button>
                            </div>
                        </div>
                    </form>
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


<style>
    .w-5 {
        width: 10px !important;
    }
    .h-5 {
        height: 10px !important;
    }
    .flex.justify-between.flex-1
    {
        display: none !important;
    }
</style>
