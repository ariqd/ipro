@extends('layouts.carbon')

@section('title', 'Customer Master Data')

@section('content')
    @include('layouts.ajax')
    {{--<div class="container">--}}
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="mb-0">Master Data</h5>
                    <h2>Customer</h2>
                </div>
                <div>
                    <a href="#modalForm" data-href="{{ url('customers/create') }}" data-toggle="modal"
                       class="btn btn-dark">
                        <i class="fa fa-plus"></i> Tambah Customer
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            @include("layouts.feedback")
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <table class="table table-light table-bordered">
                <thead>
                <tr>
                    <th>No</th>
                    <th>Project Owner</th>
                    <th>KTP</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Fax</th>
                    <th>Address</th>
                </tr>
                </thead>
                <tbody>
                @foreach($customers as $customer)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $customer->project_owner }}</td>
                        <td>{{ $customer->no_ktp }}</td>
                        <td>{{ $customer->phone }}</td>
                        <td>{{ $customer->email }}</td>
                        <td>{{ $customer->fax }}</td>
                        <td>{{ $customer->address }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    {{--</div>--}}
@endsection