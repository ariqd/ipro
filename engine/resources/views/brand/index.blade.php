@extends('layouts.carbon')

@section('title', 'Master Data User / Cabang')

@push('css')
<link href="{{ asset('assets/plugins/DataTables/datatables.min.css') }}" rel="stylesheet" />
<link href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css" rel="stylesheet" />
<style>
    tr.align-middle td {
        vertical-align: middle;
    }

</style>
@endpush

@push('script')
<script src="{{ asset('assets/plugins/DataTables/datatables.min.js') }}"></script>
<script src="https://cdn.datatables.net/plug-ins/1.10.19/features/scrollResize/dataTables.scrollResize.min.js"></script>
<script>
    $(document).ready(function () {
        $('#datatable').ataTable();

        $('.btnDelete').on('click', function (e) {
            e.preventDefault();
            var parent = $(this).parent();

            swal({
                    title: "Apa anda yakin?",
                    text: "Merek, Kategori, Item, serta Stok akan terhapus secara permanen!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
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
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <p class="mb-0 text-muted">Master Data</p>
                    <h2><b>Merek</b></h2>
                </div>
                <div class="ml-4">
                    <a href="#modalForm" data-toggle="modal" data-href="{{ url('brands/create') }}"
                        class="btn btn-success"><i class="fa fa-plus"></i> Tambah Merek Baru</a>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            @include("layouts.feedback")
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-lg-12">
            <div class="table-responsive">
                <table class="table bg-light table-hover border" id="datatable">
                    <thead>
                        <tr>
                            <th width="20">No</th>
                            <th>Nama</th>
                            <th>Catatan</th>
                            <th>Tanggal Dibuat</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($brands as $brand)
                        <tr class="align-middle">
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                <img src="{{ asset("assets/img/logo/$brand->logo") }}" alt="{{ $brand->name }}"
                                    class="img-fluid mr-3" width="50">
                                {{ $brand->name }}
                            </td>
                            <td>{{ $brand->notes }}</td>
                            <td>{{ $brand->created_at->toDayDateTimeString() }}</td>
                            <td>
                                <a href="#modalForm" data-toggle="modal"
                                    data-href="{{ url('brands/'.$brand->id.'/edit') }}"
                                    class="btn btn-secondary btn-sm">Edit</a>
                                <a href="#" class="btn btn-danger btn-sm btnDelete">
                                    Hapus
                                </a>
                                <form action="{{ url('brands/'.$brand->id) }}" method="post" class="formDelete d-none">
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
