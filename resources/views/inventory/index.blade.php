@extends('layouts.carbon')

@section('title', 'Inventory')

@push('css')
    <link href="{{ asset('assets/plugins/DataTables/datatables.min.css') }}" rel="stylesheet"/>
    <link href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css" rel="stylesheet"/>
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
                responsive: true,
                paging: false,
                dom: "<'myfilter'f><'mylength'l>t",
                scrollY: '4000px',
                scrollCollapse: true,
                pageResize: true
            });

            countStock();
            countWeight();
            countPrice();

            function countStock() {
                var sum = 0;
                $('.stock').each(function () {
                    sum += parseInt($(this).text());
                });
                $('.total_stock').text(sum);
            }

            function countWeight() {
                var sum = 0;
                $('.weight').each(function () {
                    sum += parseFloat($(this).text());
                });
                var text = sum + ' kg';
                if (sum > 1000) {
                    sum = sum / 1000;
                    var weight = Number(sum).toFixed(2);
                    text = weight + ' ton';
                }
                $('.total_weight').text(text);
            }

            function countPrice() {
                var sum = 0;
                $('.price').each(function () {
                    sum += parseFloat($(this).text());
                });
                $('.total_price').text(addCommas(sum));
            }

            $('#myInput').on('keyup', function () {
                table.search(this.value).draw();

                countPrice();
                countWeight();
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
    <div class="container fill">
        <div class="row">
            <div class="col-lg-4">
                <h2>Master Data Inventory</h2>
            </div>
            <div class="col-lg-8">
                <div class="d-flex">
                    <div class="input-group mr-2">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="add-on"><i class="fa fa-search"></i></span>
                        </div>
                        <input type="text" id="myInput" class="form-control" placeholder="Search inventory..."
                               aria-label="Search" aria-describedby="add-on">
                    </div>
                    @if($filtered)
                        <a href="{{ url('inventories') }}" class="btn btn-dark mr-2"><i class="fa fa-refresh"></i> Clear
                            Filter</a>
                    @else
                        <a class="btn btn-secondary mr-2" data-toggle="collapse" href="#collapseExample" role="button"
                           aria-expanded="false" aria-controls="collapseExample">
                            Filter <i class="fa fa-chevron-down"></i>
                        </a>
                    @endif
                    {{--<a href="{{ url('inventories/restock') }}"--}}
                       {{--class="btn btn-success mr-2"><i class="fa fa-plus-circle"></i> Restock</a>--}}
                    {{--<a href="#modalForm" data-toggle="modal" data-href="{{ url('inventories/restock') }}"--}}
                       {{--class="btn btn-success mr-2"><i class="fa fa-plus-circle"></i> Restock</a>--}}
                    @if(Gate::allows('isAdmin'))
                        <a href="#modalForm" data-toggle="modal" data-href="{{ url('inventories/create') }}"
                           class="btn btn-primary"><i class="fa fa-plus"></i> Add New</a>
                    @endif
                </div>
            </div>
        </div>
        @if(!empty(Request::all()))
            <div class="row">
                <div class="col-lg-12">
                    <b>Filters:</b> <br>
                    @if(Request::has("brands"))
                        Brands:
                        @php
                            $brands = Request::get("brands");
                        @endphp
                        @foreach($brands as $key => $brand)
                            {{ $brand }}{{ $key == (count($brands) - 1) ? '' : ',' }}
                        @endforeach
                        <br>
                    @endif

                    @if(Request::has("branches"))
                        Branches:
                        @php
                            $branches = Request::get("branches");
                        @endphp
                        @foreach($branches as $key => $branch)
                            {{ $branch }}{{ $key == (count($branches) - 1) ? '' : ',' }}
                        @endforeach
                    @endif
                </div>
            </div>
        @endif
        <div class="row">
            <div class="col-lg-12">
                <div class="collapse" id="collapseExample">
                    <div class="card card-body">
                        <form action="{{ url('inventories') }}" id="find-table" method="get">
                            <div class="row">
                                <label for="brands" class="col-lg-2 col-form-label text-right"><h4>Brands :</h4></label>
                                <div class="col-lg-10">
                                    <div class="row p-2">
                                        @foreach($brands as $key => $brand)
                                            <div class="col-lg-2 mb-2">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" name="brands[]"
                                                           class="custom-control-input check" id="{{ $brand }}"
                                                           value="{{ $brand }}"
                                                            {{--                                                           {{ $brand == Request::get("brands")[$i] ? 'checked' : '' }}--}}
                                                    >
                                                    <label class="custom-control-label"
                                                           for="{{ $brand }}">{{ $brand }}</label>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <label for="brands" class="col-lg-2 col-form-label text-right"><h4>Branch :</h4></label>
                                <div class="col-lg-10">
                                    <div class="row p-2">
                                        @foreach($branches as $branch)
                                            <div class="col-lg-2 mb-2">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" name="branches[]"
                                                           class="custom-control-input check" id="{{ $branch }}"
                                                           value="{{ $branch }}"
                                                    >
                                                    <label class="custom-control-label"
                                                           for="{{ $branch }}">{{ $branch }}</label>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-0">
                                <button type="submit" class="btn btn-dark float-right" id="btnFilter">Apply Filter
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.feedback')
        <div class="row" id="table">
            <div class="col-lg-12">
                {{--<div class="card">--}}
                {{--<div class="card-body">--}}
                <div class="table-responsive">
                    <table class="table table-bordered data-table table-light w-100">
                        <thead>
                        <tr>
                            <th class="nama">Nama</th>
                            <th class="brand">Brand</th>
                            <th class="kode">Kode</th>
                            <th>Cabang</th>
                            <th class="stok">Stok (per Batang)</th>
                            <th class="stok">Booking Stok</th>
                            <th class="berat">Berat (kg)</th>
                            <th class="harga">Harga/unit</th>
                            <th></th>
                            <th class="d-none"></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($inventories as $inventory)
                            <tr>
                                <td class="nama">{{ $inventory->name }}</td>
                                <td class="brand">{{ $inventory->brand }}</td>
                                <td class="kode">{{ $inventory->code }}</td>
                                {{--<td class="cabang">{{ $inventory->branch }}</td>--}}
                                <td class="cabang">Bandung</td>
                                <td class="stock stok">
                                    {{ $inventory->stock }}
                                </td>
                                <td class="booking">
                                    10
                                </td>
                                <td class="berat weight">
                                    {{ $inventory->weight }}
                                </td>
                                <td class="harga">
                                    Rp {{ number_format($inventory->price) }}
                                </td>
                                <td>
                                    {{--<div class="d-flex">--}}
                                    <a href="#modalForm" data-toggle="modal"
                                       data-href="{{ url('inventories/'.$inventory->id.'/restock') }}"
                                       class="btn btn-success btn-block btn-sm">
                                        <i class="fa fa-plus"></i> Restock</a>
                                    @if(Gate::allows('isAdmin'))
                                        <a href="#modalForm" data-toggle="modal"
                                           data-href="{{ url('inventories/'.$inventory->id) }}"
                                           class="btn btn-dark btn-block btn-sm">
                                            <i class="fa fa-eye"></i> Detail</a>
                                        <a title="Edit" class="btn btn-info btn-block btn-sm" title="Edit"
                                           href="#modalForm"
                                           data-toggle="modal"
                                           data-href="{{ url('inventories/'.$inventory->id.'/edit') }}">
                                            <i class="fa fa-edit"></i> Edit</a>
                                        <a href="#" class="btn btn-danger btnDelete btn-block btn-sm"><i
                                                    class="fa fa-trash"></i> Delete</a>
                                        <form action="{{ url('inventories/'.$inventory->id) }}"
                                              method="post" class="formDelete d-none">
                                            {!! csrf_field() !!}
                                            {!! method_field('delete') !!}
                                        </form>
                                    @endif
                                    {{--</div>--}}
                                </td>
                                <td class="price d-none">
                                    {{ $inventory->price }}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <td class="nama"></td>
                            <td class="brand"></td>
                            <td class="kode"></td>
                            <td class="cabang">
                                <span class="float-right">
                                    <b>Total:</b>
                                </span>
                            </td>
                            <td class="stok">
                                <span class="total_stock"></span> pcs
                            </td>
                            <td></td>
                            <td>
                                <span class="total_weight"></span>
                            </td>
                            <td class="border-right harga">
                                Rp <span class="total_price"></span>
                            </td>
                            <td></td>
                            <td class="d-none"></td>
                        </tr>
                        </tfoot>
                    </table>
                </div>
                {{--</div>--}}
                {{--</div>--}}
            </div>
        </div>
    </div>
@endsection