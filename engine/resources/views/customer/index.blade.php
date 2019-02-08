@extends('layouts.carbon')

@section('title', 'Customer Master Data')

@section('content')
    @include('layouts.ajax')
    <div class="container">
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
            <div class="col-12">
                <table class="table table-light table-bordered">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama</th>
                        <th>Alamat</th>
                        <th>No. Telp</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection