@extends('layouts.main')

@section('title', 'Inventory')

@push('css')
    <link href="{{ asset('assets/plugins/DataTables/datatables.min.css') }}" rel="stylesheet"/>
@endpush

@push('js')
    <script src="{{ asset('assets/plugins/DataTables/datatables.min.js') }}"></script>
    {{--<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>--}}
@endpush

@push('style')
    <style>
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
            $('.data-table').DataTable({
                responsive: true,
                paging: false,
                dom: "<'myfilter'f><'mylength'l>t"
            });

            $('.btnDelete').on('click', function (e) {
                e.preventDefault();
                var parent = $(this).parent();

                swal({
                    title: "Are you sure?",
                    text: "Once deleted, you will not be able to recover this data!",
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
    <div class="container">
        <div class="d-flex justify-content-between">
            <div>
                <h1>Inventory</h1>
            </div>
            <div>
                <a class="btn btn-secondary" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                    Filter <i class="fa fa-chevron-down"></i>
                </a>
                <a href="#" class="btn btn-dark"><i class="fa fa-plus"></i> Tambah Produk</a>
            </div>
        </div>
        <div class="row mb-3">
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
                                                <label class="custom-control-label" for="customCheck1">Brand Name</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 mb-2">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="customCheck2">
                                                <label class="custom-control-label" for="customCheck2">Brand Name</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 mb-2">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="customCheck3">
                                                <label class="custom-control-label" for="customCheck3">Brand Name</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 mb-2">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="customCheck4">
                                                <label class="custom-control-label" for="customCheck4">Brand Name</label>
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
        <div class="row">
            <div class="col-lg-12">
                <div class="table-responsive">
                    <table class="table table-bordered data-table">
                        <thead>
                        <tr>
                            <th>Brand</th>
                            <th>Kode Barang</th>
                            <th>Nama Barang</th>
                            <th>Stok (Pcs / pack)</th>
                            <th>Berat / pcs</th>
                            <th>Harga / unit</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>Conwood</td>
                            <td>ABCDEFGHIJK</td>
                            <td>Conwood Deck 4"</td>
                            <td>200</td>
                            <td>6,51</td>
                            <td>Rp 70.000.000</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Flooring</td>
                            <td>ABCDEFGHIJK</td>
                            <td>Flooring Deck 4"</td>
                            <td>200</td>
                            <td>6,51</td>
                            <td>Rp 70.000.000</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Conwood</td>
                            <td>ABCDEFGHIJK</td>
                            <td>Conwood Deck 6"</td>
                            <td>200</td>
                            <td>6,51</td>
                            <td>Rp 70.000.000</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Zircon</td>
                            <td>ABCDEFGHIJK</td>
                            <td>Zircon Deck 6"</td>
                            <td>200</td>
                            <td>6,51</td>
                            <td>Rp 70.000.000</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Zircon</td>
                            <td>ABCDEFGHIJK</td>
                            <td>Zircon Deck 6"</td>
                            <td>200</td>
                            <td>6,51</td>
                            <td>Rp 70.000.000</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Zircon</td>
                            <td>ABCDEFGHIJK</td>
                            <td>Zircon Deck 6"</td>
                            <td>200</td>
                            <td>6,51</td>
                            <td>Rp 70.000.000</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Zircon</td>
                            <td>ABCDEFGHIJK</td>
                            <td>Zircon Deck 6"</td>
                            <td>200</td>
                            <td>6,51</td>
                            <td>Rp 70.000.000</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Zircon</td>
                            <td>ABCDEFGHIJK</td>
                            <td>Zircon Deck 6"</td>
                            <td>200</td>
                            <td>6,51</td>
                            <td>Rp 70.000.000</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Zircon</td>
                            <td>ABCDEFGHIJK</td>
                            <td>Zircon Deck 6"</td>
                            <td>200</td>
                            <td>6,51</td>
                            <td>Rp 70.000.000</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Zircon</td>
                            <td>ABCDEFGHIJK</td>
                            <td>Zircon Deck 6"</td>
                            <td>200</td>
                            <td>6,51</td>
                            <td>Rp 70.000.000</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Zircon</td>
                            <td>ABCDEFGHIJK</td>
                            <td>Zircon Deck 6"</td>
                            <td>200</td>
                            <td>6,51</td>
                            <td>Rp 70.000.000</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Zircon</td>
                            <td>ABCDEFGHIJK</td>
                            <td>Zircon Deck 6"</td>
                            <td>200</td>
                            <td>6,51</td>
                            <td>Rp 70.000.000</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Zircon</td>
                            <td>ABCDEFGHIJK</td>
                            <td>Zircon Deck 6"</td>
                            <td>200</td>
                            <td>6,51</td>
                            <td>Rp 70.000.000</td>
                            <td></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection