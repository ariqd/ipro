@extends('layouts.carbon')

@section('title', 'Goods Receive')

@push("css")
@endpush

@push("js")
@endpush

@section('content')

<div class="container">

    <div class="row">

        <div class="col-lg-12">
            <div class="col-lg-12 text-right">
            </div>
            <h4>Goods Receive</h4>
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-light">
                            <thead style="background-color: lightsalmon">
                                <tr>
                                    <th>No.</th>
                                    <th>Kategori</th>
                                    <th>Kode Barang</th>
                                    <th>Item</th>
                                    <th>Berat/pcs</th>
                                    <th>Order Qty/pcs</th>
                                    <th>Get Qty/pcs</th>
                                    <th>Total Amount (IDR)</th>
                                    <th>No Sales</th>
                                </tr>
                            </thead>
                            <tbody id="purchase-body">
                                @foreach($line as $key)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $key->item->category->name }}</td>
                                    <td>{{ $key->item->code }}</td>
                                    <td>{{ $key->item->name }}</td>
                                    <td>{{ $key->item->weight }}</td>
                                    <td>{{ $key->purchase_details->qty }}</td>
                                    <td>{{ $key->qty_get }}</td>
                                    <td>{{ $key->total_price }}</td>
                                    <td>{{ $key->purchase_details->sales->no_so ?? "-" }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>

    @endsection
