@extends('layouts.carbon')

@section('title', 'Master Data User / Cabang')

@push('css')
<link href="{{ asset('assets/plugins/DataTables/datatables.min.css') }}" rel="stylesheet" />
<style>
    .categories li a:hover {
        text-decoration: underline !important;
    }

</style>
@endpush

@push('js')
<script src="{{ asset('assets/plugins/DataTables/datatables.min.js') }}"></script>
@endpush

@push("script")
<script>
    $('#datatable').DataTable();

    $('.btnDelete').on('click', function (e) {
        e.preventDefault();
        var parent = $(this).parent();

        swal({
                title: "Apa anda yakin?",
                text: "Kategori, Item, serta Stok akan terhapus secara permanen!",
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

</script>
@endpush

@section('content')
@include('layouts.ajax')
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="d-flex justify-content-between align-items-end">
                <div>
                    <p class="mb-0 text-muted">Master Data</p>
                    <h2 class="mb-0"><b>Kategori</b></h2>
                </div>
                <div class="ml-3">
                    <a href="#modalForm" data-toggle="modal" data-href="{{ url('categories/create') }}"
                        class="btn btn-success"><i class="fa fa-plus"></i> Tambah Kategori Baru</a>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-lg-12">
            @include("layouts.feedback")
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-lg-12">
            <div class="table table-responsive">
                <table class="table bg-light table-hover border" id="datatable">
                    <thead>
                        <tr>
                            <th width="20">No</th>
                            <th>Nama Merek</th>
                            <th>Kategori</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($brands as $brand)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $brand->name }}</td>
                            <td>
                                <ul class="categories list-unstyled">
                                    @forelse ($brand->categories as $category)
                                    <li class="mb-3">
                                        <p class="mb-0">
                                            {{ $category->name }}
                                        </p>
                                        <a href="#modalForm" data-toggle="modal"
                                            data-href="{{ url('categories/'.$category->id) }}" class="text-muted">Lihat
                                            Detail</a>
                                        <a href="#modalForm" data-toggle="modal"
                                            data-href="{{ url('categories/'.$category->id.'/edit') }}"
                                            class="text-warning ml-3">Edit</a>
                                        <a href="#" class="text-danger ml-3 btnDelete">Hapus</a>
                                        <form action="{{ url('categories/'.$category->id) }}" method="post"
                                            class="formDelete d-none">
                                            {!! csrf_field() !!}
                                            {!! method_field('delete') !!}
                                        </form>
                                    </li>
                                    @empty
                                    <li class="text-muted">-</li>
                                    @endforelse
                                </ul>
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
