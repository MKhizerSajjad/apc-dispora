@extends('admin.layouts.app')


@section('content')
    <div class="page-content">
        <div class="container-fluid">

        <!-- page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Donations List</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                            <li class="breadcrumb-item active">Donations List</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>

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
                            <h5 class="card-title mb-0 flex-grow-1">Donations</h5>
                            <div class="flex-shrink-0">
                                <a href="{{ route('donations.create') }}" class="btn btn-danger add-btn">
                                <i class="ri-add-line align-bottom me-1"></i>
                                Create Donation
                                </a>
                                {{-- <button class="btn btn-soft-danger" onClick="deleteMultiple()">
                                <i class="ri-delete-bin-2-line"></i>
                                </button> --}}
                            </div>
                        </div>
                    </div>
                <div class="card-body">
                    @if (count($data) > 0)
                    <div class="table-responsive table-card mb-4">
                        <table class="table align-middle table-nowrap mb-0" id="ticketTable">
                            <thead>
                                <tr>
                                    {{-- <th scope="col" style="width: 40px;">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="checkAll"
                                                value="option">
                                        </div>
                                    </th> --}}
                                    
                                    <th data-sort="srno">Sr#</th> {{-- class="sort" --}}
                                    <th data-sort="name">Donor</th>
                                    <th data-sort="name">Date</th>
                                    <th data-sort="email">Amount</th>
                                    <th data-sort="action">Action</th>
                                </tr>
                            </thead>
                            <tbody class="list form-check-all" id="ticket-list-data">

                                @foreach ($data as $key => $donation)
                                    <tr>
                                        <td class="srno"><a href="javascript:void(0);" onclick="ViewTickets(this)"
                                                data-id="001" class="fw-medium link-primary">{{ ++$key }}</a>
                                        </td>
                                        <td class="name">{{ $donation->User->first_name }}</td>
                                        <td class="name">{{ $donation->dated }}</td>
                                        <td class="email">{{ $donation->amount }}</td>
                                        {{-- <td class="status">{!! getGenrelStatus($donation->status, 'badge') !!}</td> --}}
                                        <td>
                                            {{-- <a href="{{ route('donations.show', $donation->id) }}">
                                                <i class="ri-eye-fill align-bottom me-2 text-muted"></i>
                                            </a> --}}
                                            <a href="{{ route('donations.edit', $donation->id) }}">
                                                <i class="ri-pencil-fill align-bottom me-2 text-muted"></i>
                                            </a>
                                            {{-- <a data-bs-toggle="modal" href="#deleteOrder">
                                                <i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>
                                            </a> --}}
                                        </td>
                                    </tr>
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
                    {{-- <div class="d-flex justify-content-end mt-2">
                        <div class="pagination-wrap hstack gap-2">
                            <a class="page-item pagination-prev disabled" href="#">
                                Previous
                            </a>
                            <ul class="pagination listjs-pagination mb-0"></ul>
                            <a class="page-item pagination-next" href="#">
                                Next
                            </a>
                        </div>
                    </div> --}}

                    <!-- Delete Modal -->
                    <div class="modal fade flip" id="deleteOrder" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-body p-5 text-center">
                                    <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="loop"
                                        colors="primary:#405189,secondary:#f06548" style="width:90px;height:90px">
                                    </lord-icon>
                                    <div class="mt-4 text-center">
                                        <h4>You are about to delete a record ?</h4>
                                        <p class="text-muted fs-14 mb-4">Deleting your order will remove all of your information from our database.</p>
                                        <div class="hstack gap-2 justify-content-center remove">
                                            <button class="btn btn-link link-success fw-medium text-decoration-none" id="deleteRecord-close" data-bs-dismiss="modal">
                                                <i class="ri-close-line me-1 align-middle"></i>
                                                Close
                                                </button>
                                                {!! Form::open(['method' => 'DELETE', 'route' => ['donations.destroy', 1], 'style' => 'display:inline']) !!}
                                                {!! Form::submit('Yes, Delete It', ['class' => 'btn btn-danger']) !!}
                                                {!! Form::close() !!}
                                                {{-- {{ $donation->id}} --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>
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
