@extends('layouts.carbon')

@section('title', 'Customer Master Data')

@push('css')
    <link href="{{ asset('assets/plugins/DataTables/datatables.min.css') }}" rel="stylesheet"/>
    <link href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css" rel="stylesheet"/>
@endpush

@push('js')
    <script src="{{ asset('assets/plugins/DataTables/datatables.min.js') }}"></script>
    <script src="https://cdn.datatables.net/plug-ins/1.10.19/features/scrollResize/dataTables.scrollResize.min.js"></script>
@endpush

@push('script')
    <script>
        $(document).ready(function () {
            $('.data-table').DataTable();

            $('.btnDelete').on('click', function (e) {
                e.preventDefault();
                var parent = $(this).parent();

                swal({
                    title: "Apa anda yakin?",
                    text: "Data akan terhapus secara permanen!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true
                })
                    .then(function (willDelete) {
                        if (willDelete) {
                            parent.find('.formDelete').submit();
                        }
                    });
            });
        });
    </script>
@endpush

@section('content')
    @include('layouts.ajax')
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="mb-0">Master Data</h5>
                    <h2><b>Customer</b></h2>
                </div>
                <div>
                    <a href="#modalForm" data-href="{{ url('customers/create') }}" data-toggle="modal"
                       class="btn btn-dark">
                        <i class="fa fa-plus"></i> Add Customer
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
            <div class="table-responsive">
                <table class="table table-light table-bordered data-table">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Project Owner</th>
                        <th>KTP</th>
                        <th>NPWP</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Fax</th>
                        <th>Address</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($customers as $customer)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $customer->project_owner }}</td>
                            <td>{{ $customer->no_ktp }}</td>
                            <td>{{ $customer->npwp }}</td>
                            <td>{{ $customer->phone }}</td>
                            <td>{{ $customer->email }}</td>
                            <td>{{ $customer->fax }}</td>
                            <td>{{ $customer->address }}</td>
                            <td>
                                <div class="d-flex">
                                    <a href="#modalForm" data-toggle="modal"
                                       data-href="{{ route('customers.edit', $customer) }}"
                                       class="btn btn-secondary btn-sm">Edit</a>
                                    <a href="#" class="btn btn-sm btn-danger ml-1 btnDelete">Delete</a>
                                    <form action="{{ route('customers.destroy', $customer) }}"
                                          method="post" class="formDelete d-none">
                                        {!! csrf_field() !!}
                                        {!! method_field('delete') !!}
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection