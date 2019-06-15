@extends('layouts.carbon')

@section('title', 'Stock')

@push('css')
    <link href="{{ asset('assets/plugins/DataTables/datatables.min.css') }}" rel="stylesheet"/>
    {{--<link href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css" rel="stylesheet"/>--}}
@endpush

@push('js')
    <script src="{{ asset('assets/plugins/DataTables/datatables.min.js') }}"></script>
    {{--<script src="https://cdn.datatables.net/plug-ins/1.10.19/features/scrollResize/dataTables.scrollResize.min.js"></script>--}}
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
                // responsive: true,
                paging: false,
                dom: "<'myfilter'f><'mylength'l>t",
                // scrollY: '4000px',
                // scrollCollapse: true,
                // pageResize: true
            });

            countStock();
            countWeight();
            countPrice();
            countPriceBranch();

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
                var text = sum + ' Kg';
                if (sum > 1000) {
                    sum = sum / 1000;
                    var weight = Number(sum).toFixed(2);
                    text = weight + ' Ton';
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

            function countPriceBranch() {
                var sum = 0;
                $('.price_branch').each(function () {
                    sum += parseFloat($(this).text());
                });
                $('.total_price_branch').text(addCommas(sum));
            }

            $('#myInput').on('keyup', function () {
                table.search(this.value).draw();

                countPrice();
                countPriceBranch();
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
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="mb-0">Master Data</h5>
                        <h2><b>Stocks</b></h2>
                    </div>
                    <div class="d-flex">
                        <div class="input-group mr-2">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="add-on"><i class="fa fa-search"></i></span>
                            </div>
                            <input type="text" id="myInput" class="form-control" placeholder="Search stock..."
                                   aria-label="Search" aria-describedby="add-on">
                        </div>
                        @if($filtered)
                            <a href="{{ url('stocks') }}" class="btn btn-dark mr-2"><i class="fa fa-refresh"></i> Clear
                                Filter</a>
                        @else
                            <a class="btn btn-secondary mr-2" data-toggle="collapse" href="#collapseExample"
                               role="button"
                               aria-expanded="false" aria-controls="collapseExample">
                                Filter <i class="fa fa-chevron-down"></i>
                            </a>
                        @endif
                        @if(Gate::allows('isAdmin'))
                            <a href="#modalForm" data-toggle="modal" data-href="{{ url('stocks/create') }}"
                               class="btn btn-dark"><i class="fa fa-plus"></i> Add Stock</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @if(!empty(request()->all()))
            <div class="row">
                <div class="col-lg-12">
                    <b>Filters:</b> <br>
                    @if(request()->has("brands"))
                        Brands:
                        @php
                            $brands = request()->get("brands");
                        @endphp
                        @foreach($brands as $key => $brand)
                            {{ $brand }}{{ $key == (count($brands) - 1) ? '' : ',' }}
                        @endforeach
                        <br>
                    @endif

                    @if(request()->has("branches"))
                        Branches:
                        @php
                            $branches = request()->get("branches");
                        @endphp
                        @foreach($branches as $key => $branch)
                            {{ $branch }}{{ $key == (count($branches) - 1) ? '' : ',' }}
                        @endforeach
                    @endif
                </div>
            </div>
        @else
            <div class="row">
                <div class="col-lg-12">
                    <div class="collapse" id="collapseExample">
                        <div class="card card-body">
                            <form action="{{ url('stocks') }}" id="find-table" method="get">
                                <div class="row">
                                    <label for="brands" class="col-lg-2 col-form-label text-right"><h4>Brands :</h4>
                                    </label>
                                    <div class="col-lg-10">
                                        <div class="row p-2">
                                            @foreach($brands as $key => $brand)
                                                <div class="col-lg-2 mb-2">
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" name="brands[]"
                                                               class="custom-control-input check"
                                                               id="{{ $brand->name }}"
                                                               value="{{ $brand->id }}">
                                                        <label class="custom-control-label"
                                                               for="{{ $brand->name }}">{{ $brand->name }}</label>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <label for="brands" class="col-lg-2 col-form-label text-right"><h4>Branches :</h4>
                                    </label>
                                    <div class="col-lg-10">
                                        <div class="row p-2">
                                            @foreach($branches as $branch)
                                                <div class="col-lg-2 mb-2">
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" name="branches[]"
                                                               class="custom-control-input check"
                                                               id="{{ $branch->name }}"
                                                               value="{{ $branch->id }}">
                                                        <label class="custom-control-label"
                                                               for="{{ $branch->name }}">{{ $branch->name }}</label>
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
        @endif
        @include('layouts.feedback')
        <div class="row" id="table">
            <div class="col-lg-12">
                <div class="table-responsive">
                    <table class="table table-bordered data-table table-light w-100">
                        <thead>
                        <tr>
                            <th>No.</th>
                            <th>Brand - Category - Item</th>
                            <th>Cabang</th>
                            <th class="stok">Stok (per Batang)</th>
                            <th class="berat">Berat (kg)</th>
                            <th class="harga">Harga Pusat</th>
                            <th class="harga_cabang">Harga Cabang</th>
                            <th></th>
                            <th class="d-none"></th>
                            <th class="d-none"></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($stocks as $stock)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $stock->item->category->brand->name .' - '. $stock->item->category->name .' - '. $stock->item->name }}</td>
                                <td class="cabang">{{ ucfirst($stock->branch->name) }}</td>
                                <td class="stock stok">
                                    {{ $stock->quantity }}
                                </td>
                                <td class="weight berat">
                                    {{ $stock->item->weight }}
                                </td>
                                <td class="harga">
                                    Rp {{ number_format($stock->item->purchase_price) }}
                                </td>
                                <td class="harga_cabang">
                                    Rp {{ number_format($stock->price_branch) }}
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-outline-dark btn-sm dropdown-toggle"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fa fa-bars"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a href="#modalForm"
                                               data-href="{{ url('stocks/'.$stock->id.'/restock') }}"
                                               data-toggle="modal"
                                               class="dropdown-item">
                                                <i class="fa fa-plus text-success"></i>
                                                Restock
                                            </a>
                                            @if(Gate::allows('isAdmin'))
                                                <a href="#modalForm" data-toggle="modal"
                                                   data-href="{{ url('stocks/'.$stock->id) }}"
                                                   class="dropdown-item">
                                                    <i class="fa fa-eye"></i> Detail</a>
                                                <a title="Edit"
                                                   class="dropdown-item"
                                                   href="#modalForm"
                                                   data-toggle="modal"
                                                   data-href="{{ url('stocks/'.$stock->id.'/edit') }}">
                                                    <i class="fa fa-edit text-warning"></i> Edit
                                                </a>
                                                <a href="#"
                                                   class="dropdown-item btnDelete">
                                                    <i class="fa fa-trash text-danger"></i>
                                                    Delete
                                                </a>
                                                <form action="{{ url('stocks/'.$stock->id) }}"
                                                      method="post" class="formDelete d-none">
                                                    {!! csrf_field() !!}
                                                    {!! method_field('delete') !!}
                                                </form>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td class="price d-none">
                                    {{ $stock->item->purchase_price }}
                                </td>
                                <td class="price_branch d-none">
                                    {{ $stock->price_branch }}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <td></td>
                            <td></td>
                            <td class="cabang">
                                    <span class="float-right">
                                        <b>Total:</b>
                                    </span>
                            </td>
                            <td class="stok">
                                <span class="total_stock"></span> pcs
                            </td>
                            <td>
                                <span class="total_weight"></span>
                            </td>
                            <td class="border-right harga">
                                Rp <span class="total_price"></span>
                            </td>
                            <td class="border-right harga_cabang">
                                Rp <span class="total_price_branch"></span>
                            </td>
                            <td></td>
                            <td class="d-none"></td>
                            <td class="d-none"></td>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection