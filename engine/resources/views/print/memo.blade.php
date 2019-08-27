@extends("layouts.print")

@section("title")
Purchase Order
@endsection

@push("css")
<style type="text/css">
    .content {
        margin-top: 0 !important;
    }

    body {
        font-size: 14px !important;
        /* letter-spacing: 0.20rem; */
    }

    blockquote,
    q {
        quotes: none;
    }

    blockquote:before,
    blockquote:after,
    q:before,
    q:after {
        content: '';
        content: none;
    }

    table {
        border-collapse: collapse;
        padding: 0px !important;
    }

    body,
    h4 {
        font-family: arial;
        font-size: 18px;
    }

    tr,
    td {
        border: 1px solid black !important;
        text-align: center;
        margin: 0 auto;
    }

    .table.data tr {
        border-collapse: separate;
        border-spacing: 10px;
    }

    .vertical-text {
        transform: rotate(270deg);
        min-height: 150px;
    }

    .nopadding {
        padding: 0 !important;
        margin: 0 !important;
    }
</style>
@endpush

@section("content")
<div class="col-xs-12">
    <div class="col-xs-3" style="border: black 1px solid">
        <img src="{!! asset('assets/img/'.$line[0]->item->category->brand->name.'/'.$line[0]->item->category->brand->logo) !!}" alt="" width="70">
    </div>

    <div class="col-xs-9" style="border: black 1px solid">
        <h4>Memo Pengambilan Produk</h4>
    </div>
</div>
<div class="col-xs-12">
    <div class="col-xs-3" style="border: black 1px solid">
            <h5>Customer/Distributor</h5>
    </div>

    <div class="col-xs-9" style="border: black 1px solid">
        <h5>
            {{ $line[0]->item->category->brand->name }}
        </h5>
    </div>
</div>
<div class="col-xs-12">
    <table class="table table-bordered">
        <tr>
            <td>No.</td>
            <td>Nama Produk</td>
            <td>Jumlah</td>
            <td>Berat</td>
            <td>Total Berat</td>
            <td>No. PO / SO</td>
        </tr>
        @php
        $total = 0;
        @endphp
        @foreach($line as $key)
        @php
        $total += $key->qty_get*$key->item->weight;
        @endphp
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $key->item->category->name }}</td>
            <td>{{ $key->qty_get }}</td>
            <td>{{ $key->item->weight }}</td>
            <td>{{ $key->qty_get*$key->item->weight }}</td>
            <td>{{ $key->purchase_details->sales->no_so ?? "-" }}</td>
        </tr>
        @endforeach
        <tr>
            <td colspan="4">Total</td>
            <td colspan="1">{{$total}}</td>
            <td></td>
        </tr>
    </table>
    <div class="col-xs-12 nopadding">
        <div class="col-xs-6 nopadding">
            <table>
                <tr>
                    <td>Tanggal Rencana Pick Up *)</td>
                    <td style="width:288px">{{date("d-m-Y")}}</td>
                </tr>

                <tr>
                    <td>Nama Ekspedisi</td>
                    <td style="width:288px"></td>
                </tr>

                <tr>
                    <td>No. Plat Kendaraan *)</td>
                    <td style="width:288px"></td>
                </tr>

                <tr>
                    <td>Nama Supir *)</td>
                    <td style="width:288px"></td>
                </tr>

                <tr>
                    <td>No HP Supir </td>
                    <td style="width:288px"></td>
                </tr>
            </table>
        </div>
        <div class="col-xs-6">
            <table>
                <tr>
                    <td style="width:288px; height: 75px"></td>
                </tr>

                <tr>
                    <td style="height: 31px"></td>
                </tr>
            </table>
        </div>
    </div>
    <div class="col-xs-3 nopadding">
        No Dok: xxxyyyzzz
    </div>
    <div class="col-xs-3 nopadding">
        No. Rev: 00
    </div>
    <div class="col-xs-3 nopadding">
        Tgl Efektif: DD-MM-YYYY
    </div>
    <div class="col-xs-3 nopadding">
        Hal : 1 Dari 1
    </div>
</div>
@endsection
