@extends('admin.layouts.app')


@section('content')

<div class="page-content">
    <div class="container-fluid">

        <!-- page title -->
        <div class="row">
            <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Investors Profile</h4>

                <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active">Investors Profile</li>
                </ol>
                </div>

            </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Name:</strong>
                    {{ $investor->first_name }}
                    {{ $investor->last_name }}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Email:</strong>
                    {{ $investor->email }}
                </div>
            </div>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('investors.index') }}"> Back</a>
        </div>
    </div>
</div>


@endsection