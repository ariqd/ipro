@extends('layouts.carbon')

@section('title', 'Master Data User / Cabang')

@push('css')
<link href="{{ asset('assets/plugins/DataTables/datatables.min.css') }}" rel="stylesheet" />
<link href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css" rel="stylesheet" />
<style>
    .underline-on-hover:hover {
        text-decoration: underline;
    }

</style>
@endpush

@push('js')
<script src="{{ asset('assets/plugins/DataTables/datatables.min.js') }}"></script>
<script src="https://cdn.datatables.net/plug-ins/1.10.19/features/scrollResize/dataTables.scrollResize.min.js"></script>

<script type="text/javascript">
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

</script>
@endpush

@section('content')
@include('layouts.ajax')
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <p class="mb-0 text-muted">Master Data</p>
                    <h2><b>Cabang</b></h2>
                </div>
                <div>
                    <a href="#modalForm" data-toggle="modal" data-href="{{ url('branches/create') }}"
                        class="btn btn-success"><i class="fa fa-plus"></i> Tambah Cabang</a>
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
                <table class="table bg-light table-hover data-table">
                    <thead>
                        <tr>
                            <th width="20">No</th>
                            <th>Nama Cabang</th>
                            <th>Gudang</th>
                            <th>Catatan</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($branches as $branch)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $branch->name }}</td>
                            <td>
                                <ul class="list-unstyled">
                                    @foreach ($branch->warehouses as $warehouse)
                                    <li><a href="{{ url('warehouse/'.$warehouse->id) }}"
                                            class="text-dark underline-on-hover"
                                            title="Edit gudang {{ $warehouse->name }}">{{ $warehouse->name }}</a></li>
                                    @endforeach
                                </ul>
                                <a href="{{ url("warehouse/$branch->id/create") }}" class="btn btn-sm btn-success">
                                    <i class="fa fa-plus"></i> Tambah Gudang
                                </a>
                            </td>
                            <td>
                                <p>{{ $branch->notes }}</p>
                            </td>
                            <td>
                                <a href="#modalForm" data-toggle="modal"
                                    data-href="{{ url('branches/'.$branch->id.'/edit') }}"
                                    class="btn btn-secondary btn-sm">Edit</a>
                                <a href="#" class="btn btn-danger btn-sm m-1 btnDelete">
                                    Hapus
                                </a>
                                <form action="{{ url('branches/'.$branch->id) }}" method="post"
                                    class="formDelete d-none">
                                    {!! csrf_field() !!}
                                    {!! method_field('delete') !!}
                                </form>
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
