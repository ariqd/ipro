@extends('layouts.carbon')
@include('layouts.ajax')

@section('title', 'Master Data User / Cabang')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="d-flex justify-content-between">
                    <h3><a href="{{ url('accounts') }}" class="text-dark">Master Data Category</a></h3>
                    <div>
                        <a href="#modalForm" data-toggle="modal" data-href="{{ url('categories/create') }}"
                           class="btn btn-dark"><i class="fa fa-plus"></i> Tambah Category</a>
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
                        @foreach($categories as $category)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $category->id }}</td>
                                <td>{{ $category->name }}</td>
                                {{--<td>{{ $branch->status }}</td>--}}
                                <td>
                                    <a href="#modalForm" data-toggle="modal"
                                       data-href="{{ url('categories/'.$category->id.'/edit') }}"
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
