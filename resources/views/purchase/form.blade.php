@extends('layouts.carbon')

@section('title', 'Purchase Order')

@section('content')
    @include('layouts.ajax', ['size' => 'lg'])
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="d-flex justify-content-between">
                    <div>
                        <h2>
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
                    <a href="#modalForm" class="btn btn-primary float-right" data-toggle="modal"
                       data-href="{{ url('purchase-orders/create/add-items') }}"><i class="fa fa-plus"></i> Add Items</a>
                </div>
                <div class="col-lg-12 ">
                    <div class="table-responsive">
                        <table class="table table-bordered table-light">
                            <thead>
                            <tr>
                                <th>Kategori</th>
                                <th>Kode Barang</th>
                                <th>Description</th>
                                <th>Berat/pcs</th>
                                <th>Order Qty/pcs</th>
                                <th>Price/pcs</th>
                                <th>Total Amount (IDR)</th>
                                <th>GR Code</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
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