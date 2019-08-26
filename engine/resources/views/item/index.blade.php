@extends('layouts.carbon')

@section('title', 'Master Data Item')

@push('css')
<link href="{{ asset('assets/plugins/DataTables/datatables.min.css') }}" rel="stylesheet" />
<link href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css" rel="stylesheet" />
@endpush

@push('js')
<script src="{{ asset('assets/plugins/DataTables/datatables.min.js') }}"></script>
<script src="https://cdn.datatables.net/plug-ins/1.10.19/features/scrollResize/dataTables.scrollResize.min.js"></script>
@endpush

@push('style')
<style>
    .fill {
        min-height: 100%;
        height: 100%;
    }

    .dataTables_filter {
        display: none;
    }

    .dataTables_wrapper .myfilter .dataTables_filter {
        float: left
    }

    .dataTables_wrapper .mylength .dataTables_length {
        float: right
    }

</style>
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
<div class="container">
    <div class="d-flex justify-content-between">
        <div>
            <p class="mb-0 text-muted">Master Data</p>
            <h2><b>Produk</b></h2>
        </div>
        <div class="d-flex align-items-center ">
            <div class="input-group mr-2">
                <input type="text" id="myInput" class="form-control" placeholder="Cari produk..." aria-label="Search"
                    aria-describedby="add-on">                    
                <div class="input-group-append">
                    <span class="input-group-text" id="add-on"><i class="fa fa-search"></i></span>
                </div>
            </div>
            @if(Gate::allows('isAdmin'))
            <a href="#modalForm" data-toggle="modal" data-href="{{ url('items/create') }}" class="btn btn-success"><i
                    class="fa fa-plus"></i> Tambah Produk</a>
            @endif
        </div>
    </div>
    @include('layouts.feedback')
    <div class="row mt-3" id="table">
        <div class="col-lg-12">
            <div class="table-responsive">
                <table class="table data-table table-light table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode - Nama Produk</th>
                            <th>Merek - Kategori</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($items as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->code }} - {{ $item->name }}</td>
                            <td>{{ $item->category->brand->name }} - {{ $item->category->name }}</td>
                            <td>
                                <a href="#modalForm" data-toggle="modal"
                                    data-href="{{ url('items/' . $item->id) }}"
                                    class="btn btn-light btn-sm">Detail</a>
                                <a href="#modalForm" data-toggle="modal"
                                    data-href="{{ url('items/' . $item->id . '/edit') }}"
                                    class="btn btn-secondary btn-sm">Edit</a>
                                <a href="#" class="btn btn-danger btn-sm btnDelete">
                                    Hapus
                                </a>
                                <form action="{{ url('items/'.$item->id) }}" method="post" class="formDelete d-none">
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
