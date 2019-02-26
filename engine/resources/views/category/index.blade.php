@extends('layouts.carbon')

@section('title', 'Master Data User / Cabang')

@section('content')
    @include('layouts.ajax')
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="mb-0">Master Data</h5>
                        <h2><b>Categories</b></h2>
                    </div>
{{--                    <h3><a href="{{ url('accounts') }}" class="text-dark">Master Data Category</a></h3>--}}
                    <div>
                        <a href="#modalForm" data-toggle="modal" data-href="{{ url('categories/create') }}"
                           class="btn btn-dark"><i class="fa fa-plus"></i> Add Category</a>
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
                    <table class="table bg-light table-bordered" id="datatable">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>ID</th>
                            <th>Brand</th>
                            <th>Name</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($categories as $category)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $category->id }}</td>
                                <td>{{ $category->brand->name }}</td>
                                <td>{{ $category->name }}</td>
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

@push('css')
    <link href="{{ asset('assets/plugins/DataTables/datatables.min.css') }}" rel="stylesheet"/>
    <link href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css" rel="stylesheet"/>
@endpush

@push('js')
    <script src="{{ asset('assets/plugins/DataTables/datatables.min.js') }}"></script>
    <script src="https://cdn.datatables.net/plug-ins/1.10.19/features/scrollResize/dataTables.scrollResize.min.js"></script>
@endpush

@push("script")
    <script>
        var table = $('#datatable').DataTable({
            responsive: true
        });
    </script>
@endpush
