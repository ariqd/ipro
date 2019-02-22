@extends('layouts.carbon')

@section('title', 'Purchase Order')

@push("css")
    <style>
        .loading {
            background: lightgrey;
            padding: 15px;
            position: fixed;
            border-radius: 4px;
            left: 50%;
            top: 50%;
            text-align: center;
            margin: -40px 0 0 -50px;
            z-index: 2000;
            display: none;
        }
    </style>
@endpush

@push("js")
    <script>
        $(document).ready(function () {
            $("#brands").select2({
                placeholder: "Choose Brand"
            });
            $("#categories").select2({
                placeholder: "Choose Category"
            });
            $("#items").select2({
                placeholder: "Choose Item"
            });
            // $("#brands").change(function () {
            //     $('.loading').show();
            //     $.ajax({
            //         type: "GET",
            //         url: url("purchase-orders/create/get-categories/" + $("#brands").val()),
            //         dataType: "json",
            //         beforeSend: function (e) {
            //             if (e && e.overrideMimeType) {
            //                 e.overrideMimeType("application/json;charset=UTF-8");
            //             }
            //             $('#kota').html("");
            //         },
            //         success: function (response) {
            //             console.dir(response);
            //
            //             $.each(response.data, function (i, item) {
            //                 $('#kota').append($('<option>', {
            //                     value: item.id,
            //                     text: item.name
            //                 }));
            //             });
            //
            //             $("#kota").select2({
            //                 placeholder: "Choose city"
            //             });
            //
            //             $('.loading').hide();
            //         },
            //         error: function (xhr, ajaxOptions, thrownError) {
            //             alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            //         }
            //     });
            // });
        })
    </script>
@endpush

@section('content')
    {{--@include('layouts.ajax', ['size' => 'lg'])--}}
    <div class="loading">
        <i class="fas fa-sync fa-spin fa-2x fa-fw"></i><br/>
        <span>Loading</span>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="d-flex justify-content-between">
                    <div>
                        <h2>
                            {{--Buat Purchase Order Baru--}}
                            <small>
                                <a href="{{ url('purchase-orders') }}" class="text-dark">Purchase Orders</a> /
                            </small>
                            <b>Create</b>
                        </h2>
                    </div>
                </div>
            </div>
        </div>

        <form action="#">
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group row">
                        <label for="payment_method" class="col-4 col-form-label">Purchase Order ID</label>
                        <div class="col-7">
                            <input type="text" class="form-control" id="customer" name="customer">
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    {{--<a href="#modalForm" class="btn btn-dark float-right" data-toggle="modal"--}}
                       {{--data-href="{{ url('purchase-orders/create/add-items') }}"><i class="fa fa-plus"></i> Add--}}
                        {{--Items</a>--}}
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4">
                    <h4>Cari Item</h4>
                    <div class="form-group">
                        <select name="brand" id="brands" class="form-control brands">
                            <option value="" selected disabled></option>
                            @foreach($brands as $brand)
                                <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <select name="category" id="categories" class="form-control categories">
                            <option value="" selected disabled></option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <select name="items" id="items" class="form-control items">
                            <option value="" selected disabled></option>
                            {{--@foreach($categories as $category)--}}
                            {{--<option value="{{ $category->id }}">{{ $category->name }}</option>--}}
                            {{--@endforeach--}}
                        </select>
                    </div>
                    <div class="card">
                        <div class="card-body">

                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <h4>Cart</h4>
                    <div class="card">
                        <div class="card-body">

                        </div>
                    </div>
                    {{--<div class="table-responsive">--}}
                        {{--<table class="table table-bordered table-light">--}}
                            {{--<thead>--}}
                            {{--<tr>--}}
                                {{--<th>Kategori</th>--}}
                                {{--<th>Kode Barang</th>--}}
                                {{--<th>Item</th>--}}
                                {{--<th>Berat/pcs</th>--}}
                                {{--<th>Order Qty/pcs</th>--}}
                                {{--<th>Price/pcs</th>--}}
                                {{--<th>Total Amount (IDR)</th>--}}
                                {{--<th>GR Code</th>--}}
                                {{--<th></th>--}}
                            {{--</tr>--}}
                            {{--</thead>--}}
                            {{--<tbody>--}}
                            {{--<tr>--}}
                                {{--<td>-</td>--}}
                                {{--<td>-</td>--}}
                                {{--<td>-</td>--}}
                                {{--<td>-</td>--}}
                                {{--<td>-</td>--}}
                                {{--<td>-</td>--}}
                                {{--<td></td>--}}
                            {{--</tr>--}}
                            {{--</tbody>--}}
                        {{--</table>--}}
                    {{--</div>--}}
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">

                </div>
                <div class="col-lg-6">
                    <a href="#" class="btn btn-success float-right">Create Purchase Order</a>
                </div>
            </div>
        </form>
    </div>
@endsection