@extends('layouts.carbon')
@include('layouts.ajax')

@section('title', 'Master Data User / Cabang')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="d-flex justify-content-between">
                    <h3><a href="{{ url('accounts') }}" class="text-dark">Master Data Users</a> / Cabang</h3>
                    <div>
                        <a href="#modalForm" data-toggle="modal" data-href="{{ url('branches/create') }}"
                           class="btn btn-dark"><i class="fa fa-plus"></i> Tambah Cabang</a>
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
            <div class="col-lg-12">
                <div class="table table-responsive">
                    <table class="table bg-light table-bordered">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>ID</th>
                            <th>Name</th>
                            {{--<th>Status</th>--}}
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($branches as $branch)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $branch->id }}</td>
                                <td>{{ $branch->name }}</td>
                                {{--<td>{{ $branch->status }}</td>--}}
                                <td>
                                    <a href="#modalForm" data-toggle="modal"
                                       data-href="{{ url('branches/'.$branch->id.'/edit') }}"
                                       class="btn btn-outline-dark btn-sm">Edit</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection