@extends('admin.layouts.app')


@section('content')



<div class="page-content">
    <div class="container-fluid">

        <!-- page title -->
        <div class="row">
            <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Donation Update</h4>

                <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active">Donation Update</li>
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
                    {!! Form::model($donation, ['method' => 'PATCH','route' => ['donations.update', $donation->id]]) !!}
                        {{-- {!! Form::hidden('level', '1', ['class' => 'form-control']) !!} --}}
                        <div class="row mt-2">
                            <div class="col-xs-4 col-sm-4 col-md-4">
                                <div class="form-group">
                                    <strong>Investor</strong>
                                    {!! Form::select('user_id', $donors->pluck('first_name', 'id'), $donation->user_id, ['placeholder' => 'Select Investor', 'class' => 'form-select js-example-basic-single']) !!}
                                </div>
                            </div>
                        {{-- </div>
                        <div class="row mt-2"> --}}
                            <div class="col-xs-4 col-sm-4 col-md-4">
                                <div class="form-group">
                                    <strong>Amount</strong>
                                    {!! Form::number('amount', null, ['placeholder' => 'Amount', 'class' => 'form-control']) !!}
                                </div>
                            </div>
                            <div class="col-xs-4 col-sm-4 col-md-4">
                                <div class="form-group">
                                    <strong>Date </strong>
                                    {!! Form::date('date', $donation->dated, ['class' => 'form-control']) !!}
                                </div>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Detail </strong>
                                    {!! Form::textarea('detail', $donation->detail, ['placeholder' => 'Detail', 'class' => 'form-control', 'rows' => 2]) !!}
                                </div>
                            </div>
                        </div>
                        <div class="text-end mt-4 pe-3">
                            <a href="{{ route('donations.index') }}" class="btn btn-primary w-sm">Cancal</a>
                            <button type="submit" class="btn btn-success w-sm">Update</button>
                        </div>
                    {!! Form::close() !!}
                  </div>
            </div>
        </div>
    </div>
  </div>
@endsection