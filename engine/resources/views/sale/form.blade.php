@extends('layouts.carbon')
@extends('layouts.ajax')

@section('title', 'Sales Order')

@push("css")
    {{--<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet"/>--}}
    <style type="text/css">
        .modal-dialog {
            max-width: 1000px;
        }

        .card-header a, .card-header a:hover {
            color: #ffffff;
            font-weight: bold;
        }

        .card-header .fa {
            transition: .3s transform ease-in-out;
        }

        .card-header .collapsed .fa {
            transform: rotate(90deg);
        }
    </style>
@endpush

@push("js")
    {{--<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>--}}
    <script>
        $(document).ready(function () {
            $("#customer_select").change(function () {
                var id = $(this).val();
                $.ajax({
                    // url: '/info/' + $(this).val(),
                    url: "{{ url('sales-orders/create/customer/') }}/" + id,
                    type: 'get',
                    data: {},
                    success: function (data) {
                        if (data.success === true) {
                            $("#register_id").val(data.fill.id);
                            $("#name").val(data.fill.name);
                            $("#address").val(data.fill.address);
                            $("#phone").val(data.fill.phone);
                            $("#fax").val(data.fill.fax);
                            $("#email").val(data.fill.email);
                        } else {
                            alert('Cannot find info');
                        }

                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                    }
                });
            });

            $(".category").select2({
                placeholder: "Pilih Category",
                allowClear: true
            });
            $(".customer").select2({
                placeholder: "Choose Customer",
                allowClear: true
            });
            $(".brand").select2({
                placeholder: "Choose Brand",
                allowClear: true
            });
            $(".category").change(function () {
                $('#modal').modal('show');
                $.ajax({
                    url: '{{ url("stocks/getdatabycategory/") }}' + '/' + $(".category").val(),
                    method: "get",
                    success: function (response) {
                        $('.item-temp').remove();
                        $.each(response["data"], function (i, item) {
                            console.dir(item);
                            var table = document.getElementById("table-pick-item-body");

                            var row = table.insertRow();
                            row.setAttribute('id', 'row');
                            row.setAttribute('class', 'item-temp');
                            var cell0 = row.insertCell(0);
                            var cell1 = row.insertCell(1);
                            var cell2 = row.insertCell(2);
                            var cell3 = row.insertCell(3);
                            var cell4 = row.insertCell(4);
                            var cell5 = row.insertCell(5);

                            cell0.innerHTML = item.catname;
                            cell1.innerHTML = item.code;
                            cell2.innerHTML = item.itemname;
                            cell3.innerHTML = item.stock;
                            cell4.innerHTML = item.weight;
                            cell5.innerHTML = item.price;
                        });
                    },
                    error: function (xhr, statusCode, error) {
                    }
                })
            });
        });
    </script>
@endpush

@section('content')
    @include("layouts.ajax")
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="d-flex justify-content-between">
                    <div>
                        <h2>
                            <small>
                                <a href="{{ url('sales-orders') }}" class="text-dark">Sales Orders</a> /
                            </small>
                            <b>Create</b>
                        </h2>
                    </div>
                    <div>
                        <div class="form-group row">
                            <label for="payment_method" class="col-5 col-form-label text-right">Quotation ID</label>
                            <div class="col-7">
                                <input type="text" class="form-control" id="customer" name="customer">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <form action="#">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"><b>Customer</b></h5>
                            <div class="form-group">
                                {{--<label for="customer_select">Customer</label>--}}
                                {{--<input type="text" class="form-control" id="customer" name="customer">--}}
                                <select class="form-control customer" id="customer_select" name="customer"
                                        style="width: 100%">
                                    <option></option>
                                    @foreach($customers as $customer)
                                        <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                                    @endforeach
                                </select>
                                @if(Gate::allows('isAdmin'))
                                    <a href="#modalForm" data-toggle="modal"
                                       data-href="{{ url('sales-orders/create/customer') }}"
                                       class="btn btn-outline-dark mt-3 btn-block">
                                        <i class="fa fa-plus"></i> New Customer</a>
                                @endif
                            </div>
                        </div>
                        <h5 class="card-header bg-secondary">
                            <a data-toggle="collapse" href="#collapse-example" aria-expanded="true"
                               aria-controls="collapse-example" id="heading-example"
                               class="d-flex justify-content-between align-items-center collapsed">
                                <div>
                                    Customer Data
                                </div>
                                <div>
                                    <i class="fa fa-chevron-down"></i>
                                </div>
                            </a>
                        </h5>
                        <div class="collapse" id="collapse-example" style="background: #F5F5F5;">
                            <div class="card-body">
                                <div class="form-row">
                                    <div class="form-group col-lg-2">
                                        <label for="register_id">Register ID</label>
                                        <input type="text" class="form-control" id="register_id" readonly
                                               name="register_id">
                                    </div>
                                    <div class="form-group col-lg-5">
                                        <label for="name">Pemilik Project</label>
                                        <input type="text" class="form-control" id="name" readonly
                                               name="name">
                                    </div>
                                    <div class="form-group col-lg-5">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control" id="email" readonly name="email">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-lg-6">
                                        <label for="address">Alamat</label>
                                        <input type="text" class="form-control" id="address" readonly name="address">
                                    </div>
                                    <div class="form-group col-lg-3">
                                        <label for="phone">Telp</label>
                                        <input type="text" class="form-control" id="phone" readonly name="phone">
                                    </div>
                                    <div class="form-group col-lg-3">
                                        <label for="fax">Fax</label>
                                        <input type="text" class="form-control" id="fax" readonly name="fax">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{--<div class="col-lg-8">--}}
                    {{--<h5 class="mb-2"><b>Input Data Barang</b></h5>--}}
                    {{--<div class="form-group row">--}}
                        {{--<label for="categories" class="col-sm-2 col-form-label">Category : </label>--}}
                        {{--<div class="col-sm-6">--}}
                            {{--<select class="category form-control" id="categories" name="categories" style="width: 100%">--}}
                                {{--<option></option>--}}
                                {{--@foreach($categories as $key)--}}
                                    {{--<option value="{{ $key->id }}"> {{ $key->name }} </option>--}}
                                {{--@endforeach--}}
                            {{--</select>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<div class="table-responsive">--}}
                        {{--<table class="table table-light table-bordered">--}}
                            {{--<thead>--}}
                            {{--<tr>--}}
                                {{--<th>Kode</th>--}}
                                {{--<th>Nama</th>--}}
                                {{--<th>Berat / Pcs (Kg)</th>--}}
                                {{--<th>Harga / Unit</th>--}}
                                {{--<th>Action</th>--}}
                            {{--</tr>--}}
                            {{--</thead>--}}
                            {{--<tbody>--}}
                            {{--</tbody>--}}
                        {{--</table>--}}
                    {{--</div>--}}
                    {{--<div class="form-group row">--}}
                        {{--<label for="payment_method" class="col-4 col-form-label">Pilih metode pembayaran</label>--}}
                        {{--<div class="col-8">--}}
                            {{--<select class="form-control" id="payment_method" name="payment_method">--}}
                                {{--<option value="1">1</option>--}}
                                {{--<option value="2">2</option>--}}
                                {{--<option value="3">3</option>--}}
                                {{--<option value="4">4</option>--}}
                                {{--<option value="5">5</option>--}}
                            {{--</select>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<div class="row">--}}
                        {{--<div class="col-6">--}}
                            {{--<b>Sales:</b> {{ Auth::user()->name }}--}}
                        {{--</div>--}}
                        {{--<div class="col-6">--}}
                            {{--<b>Tanggal:</b> {{ date("d-m-Y") }}--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"><b>Items</b></h5>
                            <div class="row">
                                <div class="col-lg-4">
                                    <select class="form-control brand" id="brand_select" name="brand"
                                            style="width: 100%">
                                        <option></option>
                                        @foreach($brands as $brand)
                                            <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"><b>Details</b></h5>
                            <div class="form-group">
                                <label for="project">Project</label>
                                <input type="text" class="form-control" id="project" name="project">
                            </div>
                            <div class="form-row">
                                <div class="form-group col-lg-4">
                                    <label for="send_address">Alamat Kirim</label>
                                    <input type="text" class="form-control" id="send_address" name="send_address">
                                </div>
                                <div class="form-group col-lg-4">
                                    <label for="send_date">Tanggal Kirim</label>
                                    <input type="date" class="form-control" id="send_date" name="send_date"
                                           min="{{ date('Y-m-d') }}">
                                </div>
                                <div class="form-group col-lg-4">
                                    <label for="telp_pic">No. Telp PIC</label>
                                    <input type="text" class="form-control" id="telp_pic" name="telp_pic">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="notes">Catatan</label>
                                <textarea name="notes" id="notes" class="form-control" rows="5"></textarea>
                                {{--<input type="text" class="form-control" id="customer" name="customer">--}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                </div>
                <div class="col-lg-6">
                    <a href="#" class="btn btn-success float-right">Create Sales Order</a>
                </div>
            </div>
        </form>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Pilih Item</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table table-bordered table-stripped" id="table-pick">
                        <thead>
                        <tr>
                            <th>Kategori</th>
                            <th>Kode Barang</th>
                            <th>Nama Barang</th>
                            <th>Stock</th>
                            <th>Berat/Pcs</th>
                            <th>Harga/Unit</th>
                        </tr>
                        </thead>
                        <tbody id="table-pick-item-body"></tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
@endsection