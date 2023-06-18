@extends('admin.layouts.app')

@push('css')
    <style>

    </style>
@endpush

@section('content')


{{-- // Get total purchases
$totalPurchases = DB::table('purchases')
->sum('total_amount');

// Get total sales
$totalSales = DB::table('sales')
->sum('total_amount');

// Get total investments from the investments table
$investments = DB::table('investments')
    ->where('status', 1)
    ->where('return_type', 0)
    ->sum('amount');

// Get total investment returns from the purchase_investment_returns table
$investmentReturns = DB::table('purchase_investment_returns')
    ->where('status', 1)
    ->where('via', 1)
    ->sum('amount');

// Calculate total profit
$totalProfit = $totalSales - $totalPurchases + $investmentReturns;

// Calculate remaining amount
$remainingAmount = $investments - $investmentReturns;

// Merge the results together
$results = [
    'total_purchases' => $totalPurchases,
    'total_sales' => $totalSales,
    'total_investments' => $investments,
    'total_investment_returns' => $investmentReturns,
    'total_profit' => $totalProfit,
    'remaining_amount' => $remainingAmount,
]; --}}


    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Dashboard</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboards</a></li>
                                <li class="breadcrumb-item active">Dashboard</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            @if(Auth::user()->id == 1)
                <div class="row">
                    <div class="col">

                        <div class="h-100">

                            {{-- COUNTER --}}
                            <div class="row">
                                @foreach (membershipStatus() as $status)
                                    <div class="col-xl-3 col-md-6">
                                        <!-- card -->
                                        <div class="card card-animate">
                                            <div class="card-body">
                                                <div class="d-flex align-items-center">
                                                    <div class="flex-grow-1 overflow-hidden">
                                                        <p class="text-uppercase fw-medium text-muted text-truncate mb-0">
                                                            {{$status}} Users</p>
                                                    </div>
                                                    <div class="flex-shrink-0">
                                                        <h5 class="text-success fs-14 mb-0">
                                                            {{-- <i class="ri-arrow-right-up-line fs-13 align-middle"></i>
                                                            +16.24 % --}}
                                                        </h5>
                                                    </div>
                                                </div>
                                                <div class="d-flex align-items-end justify-content-between mt-4">
                                                    <div>
                                                        <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span
                                                                class="counter-value" data-target="{{$totalUsers[$status] ?? 0}}">0</span>
                                                        </h4>
                                                        <a href="{{route('users.index', ['status' => $status])}}" class="text-decoration-underline">View {{$status}} Users</a>
                                                    </div>
                                                    <div class="avatar-sm flex-shrink-0">
                                                        <span class="avatar-title bg-soft-info rounded fs-3">
                                                            <i class="bx bx-user-circle text-info"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div><!-- end card body -->
                                        </div><!-- end card -->
                                    </div><!-- end col -->
                                @endforeach
                            </div>

                            {{-- <div class="row">
                                <div class="col-xl-8">
                                    <div class="card">
                                        <div class="card-header border-0 align-items-center d-flex">
                                            <h4 class="card-title mb-0 flex-grow-1">Users</h4>
                                            <div>
                                                <button type="button" class="btn btn-soft-secondary btn-sm">
                                                    ALL
                                                </button>
                                                <button type="button" class="btn btn-soft-secondary btn-sm">
                                                    1M
                                                </button>
                                                <button type="button" class="btn btn-soft-secondary btn-sm">
                                                    6M
                                                </button>
                                                <button type="button" class="btn btn-soft-primary btn-sm">
                                                    1Y
                                                </button>
                                            </div>
                                        </div><!-- end card header -->

                                        <div class="card-header p-0 border-0 bg-soft-light">
                                            <div class="row g-0 text-center">
                                                <div class="col-6 col-sm-3">
                                                    <div class="p-3 border border-dashed border-start-0">
                                                        <h5 class="mb-1"><span class="counter-value"
                                                                data-target="7585">0</span></h5>
                                                        <p class="text-muted mb-0">Orders</p>
                                                    </div>
                                                </div>
                                                <!--end col-->
                                                <div class="col-6 col-sm-3">
                                                    <div class="p-3 border border-dashed border-start-0">
                                                        <h5 class="mb-1">$<span class="counter-value"
                                                                data-target="22.89">0</span>k</h5>
                                                        <p class="text-muted mb-0">Earnings</p>
                                                    </div>
                                                </div>
                                                <!--end col-->
                                                <div class="col-6 col-sm-3">
                                                    <div class="p-3 border border-dashed border-start-0">
                                                        <h5 class="mb-1"><span class="counter-value"
                                                                data-target="367">0</span></h5>
                                                        <p class="text-muted mb-0">Refunds</p>
                                                    </div>
                                                </div>
                                                <!--end col-->
                                                <div class="col-6 col-sm-3">
                                                    <div
                                                        class="p-3 border border-dashed border-start-0 border-end-0">
                                                        <h5 class="mb-1 text-success"><span class="counter-value"
                                                                data-target="18.92">0</span>%</h5>
                                                        <p class="text-muted mb-0">Conversation Ratio</p>
                                                    </div>
                                                </div>
                                                <!--end col-->
                                            </div>
                                        </div><!-- end card header -->

                                        <div class="card-body p-0 pb-2">
                                            <div class="w-100">
                                                <div id="customer_impression_charts"
                                                    data-colors='["--vz-primary", "--vz-success", "--vz-danger"]'
                                                    class="apex-charts" dir="ltr"></div>
                                            </div>
                                        </div><!-- end card body -->
                                    </div><!-- end card -->
                                </div><!-- end col -->

                                <div class="col-xl-4">
                                    <!-- card -->
                                    <div class="card card-height-100">
                                        <div class="card-header align-items-center d-flex">
                                            <h4 class="card-title mb-0 flex-grow-1">Sales by Locations</h4>
                                            <div class="flex-shrink-0">
                                                <button type="button" class="btn btn-soft-primary btn-sm">
                                                    Export Report
                                                </button>
                                            </div>
                                        </div><!-- end card header -->

                                        <!-- card body -->
                                        <div class="card-body">

                                            <div id="sales-by-locations"
                                                data-colors='["--vz-light", "--vz-success", "--vz-primary"]'
                                                style="height: 269px" dir="ltr"></div>

                                            <div class="px-2 py-2 mt-1">
                                                <p class="mb-1">Canada <span class="float-end">75%</span></p>
                                                <div class="progress mt-2" style="height: 6px;">
                                                    <div class="progress-bar progress-bar-striped bg-primary"
                                                        role="progressbar" style="width: 75%" aria-valuenow="75"
                                                        aria-valuemin="0" aria-valuemax="75"></div>
                                                </div>

                                                <p class="mt-3 mb-1">Greenland <span class="float-end">47%</span>
                                                </p>
                                                <div class="progress mt-2" style="height: 6px;">
                                                    <div class="progress-bar progress-bar-striped bg-primary"
                                                        role="progressbar" style="width: 47%" aria-valuenow="47"
                                                        aria-valuemin="0" aria-valuemax="47"></div>
                                                </div>

                                                <p class="mt-3 mb-1">Russia <span class="float-end">82%</span></p>
                                                <div class="progress mt-2" style="height: 6px;">
                                                    <div class="progress-bar progress-bar-striped bg-primary"
                                                        role="progressbar" style="width: 82%" aria-valuenow="82"
                                                        aria-valuemin="0" aria-valuemax="82"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end card body -->
                                    </div>
                                    <!-- end card -->
                                </div>
                                <!-- end col -->
                            </div> --}}

                            {{-- <div class="row">
                                <div class="col-xl-4">
                                    <div class="card card-height-100">
                                        <div class="card-header align-items-center d-flex">
                                            <h4 class="card-title mb-0 flex-grow-1">Store Visits by Source</h4>
                                            <div class="flex-shrink-0">
                                                <div class="dropdown card-header-dropdown">
                                                    <a class="text-reset dropdown-btn" href="#"
                                                        data-bs-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="false">
                                                        <span class="text-muted">Report<i
                                                                class="mdi mdi-chevron-down ms-1"></i></span>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        <a class="dropdown-item" href="#">Download Report</a>
                                                        <a class="dropdown-item" href="#">Export</a>
                                                        <a class="dropdown-item" href="#">Import</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!-- end card header -->

                                        <div class="card-body">
                                            <div id="store-visits-source"
                                                data-colors='["--vz-primary", "--vz-success", "--vz-warning", "--vz-danger", "--vz-info"]'
                                                class="apex-charts" dir="ltr"></div>
                                        </div>
                                    </div> <!-- .card-->
                                </div> <!-- .col-->

                                <div class="col-xl-8">
                                </div> <!-- .col-->
                            </div> <!-- end row--> --}}

                        </div> <!-- end .h-100-->

                    </div> <!-- end col -->

                </div>
            @else
                <h3>Welcome {{Auth::user()->first_name}}..!</h3>
            @endif
        </div>
        <!-- container-fluid -->
    </div>

    @php
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
    @endphp
@endsection
