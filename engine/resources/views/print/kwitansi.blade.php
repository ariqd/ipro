@extends("layouts.print")

@section("title")
    Sales Quotation
@endsection

@push("css")
    <style type="text/css">
        table {
            border-collapse: collapse;
            padding: 0 !important;
            border: none;
        }

        body {
            font-family: Arial, sans-serif;
            font-size: 13px;
        }

        .table > tbody > tr > td {
            line-height: 0.5 !important;
        }
    </style>
@endpush

@section("content")
    <div class="row">
        <div class="col-xs-6" style="margin-top: 2%">
            <h4>Detail Customer</h4>
            <table class="table">
                <tr>
                    <td>Register ID</td>
                    <td>{{ $sale->customer->id }}</td>
                </tr>
                <tr>
                    <td>Pemilik Project</td>
                    <td>{{ $sale->customer->project_owner }}</td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td>{{ $sale->customer->email }}</td>
                </tr>
                <tr>
                    <td>Alamat</td>
                    <td>{{ $sale->customer->address }}</td>
                </tr>
                <tr>
                    <td>Phone</td>
                    <td>{{ $sale->customer->phone }}</td>
                </tr>
                <tr>
                    <td>Fax</td>
                    <td>{{ $sale->customer->fax }}</td>
                </tr>
            </table>
        </div>

        <div class="col-xs-6" style="margin-top: 2%">
            <h4>Detail Sales Order</h4>
            <table class="table table-borderless">
                <tr>
                    <td>No. Sales Order</td>
                    <td>{{ $sale->no_so }}</td>
                </tr>
                <tr>
                    <td>Project</td>
                    <td>{{ $sale->project }}</td>
                </tr>
                <tr>
                    <td>Alamat Pengiriman</td>
                    <td>{{ $sale->send_address }}</td>
                </tr>
                <tr>
                    <td>Tanggal Pengiriman</td>
                    <td>{{ date("d-m-Y",strtotime($sale->send_date)) }}</td>
                </tr>
                <tr>
                    <td>No. Telp PIC</td>
                    <td>{{ $sale->send_pic_phone }}</td>
                </tr>
                <tr>
                    <td>Metode Pembayaran</td>
                    <td>{{ $sale->payment_method }}</td>
                </tr>
                <tr>
                    <td>Notes</td>
                    <td>{{ $sale->note }}</td>
                </tr>
            </table>
        </div>

        <div class="col-xs-12 mt-3">
            <h4>Detail Barang</h4>
            <div class="card">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Qty</th>
                            <th>Price</th>
                            <th>Discount</th>
                            <th>Total</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($sale->details as $details)
                            <tr>
                                <td>
                                    {{ $details->id }}
                                </td>
                                <td>
                                    {{ $details->stock->item->name }}
                                </td>
                                <td>
                                    {{ $details->qty }}
                                </td>
                                <td>
                                    Rp{{number_format($details->price) }},00
                                </td>
                                <td>
                                    {{ $details->discount}}%
                                </td>
                                <td>
                                    Rp{{number_format($details->total)}},00
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