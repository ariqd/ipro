@extends('layouts.carbon')

@section('title', 'Inventory')

@push('css')
    <link href="{{ asset('assets/plugins/DataTables/datatables.min.css') }}" rel="stylesheet"/>
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

        .dataTables_filter { display: none; }

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
            function addCommas(nStr) {
                nStr += '';
                x = nStr.split('.');
                x1 = x[0];
                x2 = x.length > 1 ? '.' + x[1] : '';
                var rgx = /(\d+)(\d{3})/;
                while (rgx.test(x1)) {
                    x1 = x1.replace(rgx, '$1' + ',' + '$2');
                }
                return x1 + x2;
            }

            var table = $('.data-table').DataTable({
                // searching: false,
                responsive: true,
                paging: false,
                dom: "<'myfilter'f><'mylength'l>t",
                scrollY: '41vh',
                scrollCollapse: true,
                pageResize: true
            });

            countStock();
            countPrice();

            function countStock() {
                var sum = 0;
                $('.stock').each(function () {
                    sum += parseInt($(this).text());
                });
                $('.total_stock').text(sum);
                console.log("total stock = " + sum);
            }

            function countPrice() {
                var sum = 0;
                $('.price').each(function () {
                    sum += parseFloat($(this).text());
                });
                $('.total_price').text(addCommas(sum));
                console.log("total price = " + sum);
            }

            $('#myInput').on('keyup', function () {
                table.search(this.value).draw();
                // $('#filterInfo').html('Currently applied global search: ' + table.search());
                countPrice();
                countStock();
            });

            $('.btnDelete').on('click', function (e) {
                e.preventDefault();
                var parent = $(this).parent();

                swal({
                    title: "Apa anda yakin?",
                    text: "Data akan terhapus secara permanen!",
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
    <div class="container fill">
        <div class="d-flex justify-content-between">
            <div>
                <h1>Inventory</h1>
                <p id="filterInfo"></p>
            </div>
            <div>
                <a class="btn btn-secondary" data-toggle="collapse" href="#collapseExample" role="button"
                   aria-expanded="false" aria-controls="collapseExample">
                    Filter <i class="fa fa-chevron-down"></i>
                </a>
                <a href="#modalForm" data-toggle="modal" data-href="{{ url('inventories/create') }}"
                   class="btn btn-primary"><i class="fa fa-plus"></i> Tambah Produk</a>
                {{--<a href="{{ url('inventories/create') }}" class="btn btn-dark"><i class="fa fa-plus"></i> Tambah Produk</a>--}}
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="collapse" id="collapseExample">
                    <div class="card card-body">
                        <form action="" method="get">
                            <div class="row">
                                <label for="brands" class="col-lg-3 col-form-label"><h4>Brands</h4></label>
                                <div class="col-lg-9">
                                    <div class="row">
                                        <div class="col-lg-4 mb-2">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="customCheck1">
                                                <label class="custom-control-label" for="customCheck1">Brand
                                                    Name</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 mb-2">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="customCheck2">
                                                <label class="custom-control-label" for="customCheck2">Brand
                                                    Name</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 mb-2">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="customCheck3">
                                                <label class="custom-control-label" for="customCheck3">Brand
                                                    Name</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 mb-2">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="customCheck4">
                                                <label class="custom-control-label" for="customCheck4">Brand
                                                    Name</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-0">
                                <button type="submit" class="btn btn-dark float-right">Submit</button>
                            </div>
                        </form>
                        {{--<div class="row">--}}
                        {{--<div class="col-lg-3 border-right">--}}
                        {{--<h4>Brands</h4>--}}
                        {{--</div>--}}
                        {{--</div>--}}
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.feedback')
        <div class="row" id="table">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="add-on"><i class="fa fa-search"></i></span>
                            </div>
                            <input type="text" id="myInput" class="form-control" placeholder="Search inventory..." aria-label="Search" aria-describedby="add-on">
                            {{--<input type="text" id="myInput" class="form-control" placeholder="Search...">--}}
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered data-table display pageResize">
                                <thead>
                                <tr>
                                    <th>Brand</th>
                                    <th>Kode</th>
                                    <th>Nama</th>
                                    <th>Stok (pcs/pack)</th>
                                    <th>Harga/unit</th>
                                    <th></th>
                                    <th class="d-none"></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($inventories as $inventory)
                                    <tr>
                                        <td>{{ $inventory->brand }}</td>
                                        <td>{{ $inventory->code }}</td>
                                        <td>{{ $inventory->name }}</td>
                                        <td class="stock">
                                            {{ $inventory->stock }}
                                        </td>
                                        <td>
                                            Rp {{ number_format($inventory->price) }}
                                        </td>
                                        <td>
                                            <a href="#modalForm" data-toggle="modal"
                                               data-href="{{ url('inventories/'.$inventory->id) }}"
                                               class="btn btn-dark btn-sm">Detail</a>
                                            <a class="btn btn-primary btn-sm" title="Edit" href="#modalForm"
                                               data-toggle="modal"
                                               data-href="{{ url('inventories/'.$inventory->id.'/edit') }}">
                                                Edit</a>
                                            <a href="#" class="btn btn-danger btn-sm btnDelete">Hapus</a>
                                            <form action="{{ url('inventories/'.$inventory->id) }}"
                                                  method="post" class="formDelete"
                                                  style="display: none;">
                                                {!! csrf_field() !!}
                                                {!! method_field('delete') !!}
                                            </form>
                                        </td>
                                        <td class="price d-none">
                                            {{ $inventory->price }}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <td colspan="3">
                                        <div class="float-right">
                                            <b>Total:</b>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="total_stock"></span>
                                    </td>
                                    <td colspan="3">
                                        Rp <span class="total_price"></span>
                                    </td>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection