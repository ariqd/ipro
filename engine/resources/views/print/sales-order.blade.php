@extends("layouts.print")

@section("title")
    Purchase Order
@endsection

@push("css")
    <style type="text/css">
        body {
            font-size: 14px !important;
            letter-spacing: 0.20rem;
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

        tr, td {
            /* border: 1px solid black; */
            text-align: center;
            margin: 0 auto;
        }

        .table.data
        tr {
            border-collapse: separate;
            border-spacing: 10px;
        }

        .vertical-text {
            transform: rotate(270deg);
            min-height: 150px;
        }

        .address {
            background-color: #2E7D32;
            color: #ffffff;
            text-align: center;
            padding: 10px;
            margin: 20px 0;
            border: 1px solid #000;
        }

        .title {
            background-color: #F57F17;
            color: #ffffff;
            text-align: center;
            padding: 4px;
            border: 1px solid #000;
        }

        .table td {
            text-align: left;
        }

        .table-borderless > tbody > tr > td,
        .table-borderless > tbody > tr > th,
        .table-borderless > tfoot > tr > td,
        .table-borderless > tfoot > tr > th,
        .table-borderless > thead > tr > td,
        .table-borderless > thead > tr > th {
            border: none;
        }

        table thead tr.warning th {
            background-color: #F57F17 !important;
            text-align: center;
        }

        .notes {
            border: 1px solid #000000;
            padding: 10px;
        }
    </style>
@endpush

@section("content")
    <div class="row">
        <div class="col-xs-6">
            <img src="logo.png" alt="" width="200">
            <div class="address">
                Jln. Jendral Sudirman No. 672 B Bandung. Telp. 022 2057 33 22
            </div>
            <table class="table table-borderless">
                <tr>
                    <td>Tanggal:</td>
                    <td>{ tanggal }</td>
                </tr>
                <tr>
                    <td>No. SO:</td>
                    <td>{ no_so }</td>
                </tr>
                <tr>
                    <td colspan="2">&nbsp;</td>
                </tr>
                <tr>
                    <th colspan="2"><b>SALES</b></th>
                </tr>
                <tr>
                    <td>Nama:</td>
                    <td>{ Nama }</td>
                </tr>
                <tr>
                    <td>ID:</td>
                    <td>{ ID }</td>
                </tr>
                <tr>
                    <td>Telp:</td>
                    <td>{ Telp }</td>
                </tr>
                <tr>
                    <td>Email:</td>
                    <td>{ Email }</td>
                </tr>
            </table>
        </div>
        <div class="col-xs-6">
            <h2 class="title">Sales Order</h2>
            <table class="table table-borderless">
                <tr>
                    <th colspan="2"><b>PENERIMA</b></th>
                </tr>
                <tr>
                    <td>Register ID:</td>
                    <td>{ Register ID }</td>
                </tr>
                <tr>
                    <td>Pemilik Project:</td>
                    <td>{ Pemilik Project }</td>
                </tr>
                <tr>
                    <td>Alamat:</td>
                    <td>{ Alamat }</td>
                </tr>
                <tr>
                    <td>Telp:</td>
                    <td>{ Telp }</td>
                </tr>
                <tr>
                    <td>Fax:</td>
                    <td>{ Fax }</td>
                </tr>
                <tr>
                    <td>Email:</td>
                    <td>{ Email }</td>
                </tr>
                <tr>
                    <td>Tgl Kirim:</td>
                    <td>{ Tgl Kirim }</td>
                </tr>
                <tr>
                    <td>Project:</td>
                    <td>{ Project }</td>
                </tr>
                <tr>
                    <td>Alamat Project:</td>
                    <td>{ Alamat Project }</td>
                </tr>
                <tr>
                    <td>PIC:</td>
                    <td>{ PIC }</td>
                </tr>
                <tr>
                    <td>Discount:</td>
                    <td>{ Discount }</td>
                </tr>
            </table>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12">
            <table class="table table-bordered">
                <thead>
                <tr class="warning">
                    <th>BANYAK</th>
                    <th>NAMA BARANG</th>
                    <th>BERAT/PCS</th>
                    <th>BERAT (KG)</th>
                    <th>HARGA/UNIT</th>
                    <th>JUMLAH</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                </tbody>
                <tfoot>
                <tr>
                    <td colspan="3">
                        <div class="text-right"><b>JUMLAH</b></div>
                    </td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-6">
            <div class="notes">
                <p><b>Catatan:</b></p>
                <p>{ Catatan }</p>
            </div>
        </div>
        <div class="col-xs-6">
            <table class="table table-borderless">
                <tr>
                    <td><b>DISC</b></td>
                    <td>0%</td>
                    <td style="border-bottom: 1px solid #000000">: Rp. { DISC }</td>
                </tr>
                <tr>
                    <td colspan="2"><b>JUMLAH</b></td>
                    <td>: Rp. { JUMLAH }</td>
                </tr>
                <tr>
                    <td colspan="2"><b>PPN 10%</b></td>
                    <td>: Rp. { PPN 10% }</td>
                </tr>
                <tr>
                    <td colspan="2"><b>ONGKOS KIRIM</b></td>
                    <td style="border-bottom: 1px solid #000000">: Rp. { ONGKOS KIRIM }</td>
                </tr>
                <tr>
                    <td colspan="2"><b>GRAND TOTAL</b></td>
                    <td>: Rp. { GRAND TOTAL }</td>
                </tr>
            </table>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-4">
            <div class="text-center">
                <p>Mengetahui,</p>
                <p style="margin-top: 120px">(IRENE)</p>
                <P>KEUANGAN</P>
            </div>
        </div>
        <div class="col-xs-4">
            <div class="text-center">
                <p>Mengetahui,</p>
                <p style="margin-top: 120px">(RIA ADRIYATI)</p>
                <P>HEAD SALES</P>
            </div>
        </div>
        <div class="col-xs-4">
            <div class="text-center">
                <p>Yang Membuat,</p>
                <p style="margin-top: 120px">Erlin</p>
                <P>SALES</P>
            </div>
        </div>
    </div>
@endsection