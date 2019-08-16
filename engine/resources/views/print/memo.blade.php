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
        <img src="{!! asset('assets/img/logo.png') !!}" alt="" width="73">
    </div>

    <div class="col-xs-9" style="border: black 1px solid">
        <h4>Memo Pengambilan Produk</h4>
    </div>
</div>
<div class="col-xs-12">
    <div class="col-xs-3" style="border: black 1px solid">
        Customer/Distributor
    </div>

    <div class="col-xs-9" style="border: black 1px solid">
        <h1></h1>
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
        <tr>
            <td>1.</td>
            <td>Conwood</td>
            <td>3</td>
            <td>2.5</td>
            <td>7,5</td>
            <td>xxxyyyzzz</td>
        </tr>
        <tr>
            <td>2.</td>
            <td>Conwood</td>
            <td>3</td>
            <td>2.5</td>
            <td>7,5</td>
            <td>xxxyyyzzz</td>
        </tr>
        <tr>
            <td>3.</td>
            <td>Conwood</td>
            <td>3</td>
            <td>2.5</td>
            <td>7,5</td>
            <td>xxxyyyzzz</td>
        </tr>
        <tr>
            <td>4.</td>
            <td>Conwood</td>
            <td>3</td>
            <td>2.5</td>
            <td>7,5</td>
            <td>xxxyyyzzz</td>
        </tr>
        <tr>
            <td colspan="4">Total</td>
            <td colspan="1">30</td>
            <td></td>
        </tr>
    </table>
    <div class="col-xs-12 nopadding">
        <div class="col-xs-6 nopadding">
            <table>
                <tr>
                    <td>Tanggal Rencana Pick Up *)</td>
                    <td style="width:288px"></td>
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
