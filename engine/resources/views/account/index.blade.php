@extends('layouts.carbon')
@include('layouts.ajax')

@section('title', 'Master Data User')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="mb-0">Master Data</h5>
                        <h2>User</h2>
                    </div>
                    <div>
                        {{--<a href="#modalForm" data-toggle="modal" data-href="{{ url('branches') }}"--}}
                           {{--class="btn btn-success"><i class="fa fa-tree"></i> Atur Cabang</a>--}}
                        <a href="{{ url('branches') }}"
                           class="btn btn-secondary"><i class="fa fa-tree"></i> Atur Cabang</a>
                        <a href="#modalForm" data-toggle="modal" data-href="{{ url('accounts/create') }}"
                           class="btn btn-dark"><i class="fa fa-plus"></i> Tambah User</a>
                    </div>
                </div>
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
                            <th>Username</th>
                            <th>Email</th>
                            <th>Role</th>
                            {{--<th>Branch</th>--}}
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->username }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->role }}</td>
                                {{--<td>{{ $user->branch }}</td>--}}
                                {{--<td>Bandung</td>--}}
                                <td>
                                    <a href="#modalForm" data-toggle="modal"
                                       data-href="{{ url('accounts/'.$user->id.'/edit') }}"
                                       class="btn btn-secondary btn-sm">Edit</a>
                                    <a href="#modalForm" data-toggle="modal"
                                       data-href="#"
                                       class="btn btn-outline-dark btn-sm">Change Password</a>
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