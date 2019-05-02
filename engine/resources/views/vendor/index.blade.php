@extends('layouts.carbon')

@section('title', 'Vendor')

@push('css')
    <link href="{{ asset('assets/plugins/DataTables/datatables.min.css') }}" rel="stylesheet"/>
    <link href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css" rel="stylesheet"/>
@endpush

@push('js')
    <script src="{{ asset('assets/plugins/DataTables/datatables.min.js') }}"></script>
    <script src="https://cdn.datatables.net/plug-ins/1.10.19/features/scrollResize/dataTables.scrollResize.min.js"></script>

    <script type="text/javascript">
        $('.data-table').DataTable();
    </script>
@endpush

@section('content')
    @include('layouts.ajax')
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="mb-0">Master Data</h5>
                    <h2><b>Vendor</b></h2>
                </div>
                <div>
                    <a href="#modalForm" data-href="{{ url('vendors/create') }}" data-toggle="modal"
                       class="btn btn-dark">
                        <i class="fa fa-plus"></i> Add Vendor
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
                    <th>Name</th>
                    <th>Address</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>PIC</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($vendors as $vendor)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $vendor->name }}</td>
                        <td>{{ $vendor->address }}</td>
                        <td>{{ $vendor->phone }}</td>
                        <td>{{ $vendor->email }}</td>
                        <td>{{ $vendor->pic_name }}</td>
                        <td>
                            <a href="#modalForm" data-href="{{ url('vendors/'.$vendor->id.'/edit') }}"
                               data-toggle="modal" class="btn btn-secondary">Edit</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection