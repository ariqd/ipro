@extends("layouts.print")

@section("title")
    Kwitansi
@endsection

@push("css")
    <style type="text/css">
        table {
            padding: 0 !important;
            border: 1px solid #000;
        }

        body {
            font-family: Arial, sans-serif;
            font-size: 13px;
        }

        .table > tbody > tr > td {
        }
    </style>
@endpush

@section("content")

    <div class="col-xs-12" style="margin-top: 0%">
        <div class="col-xs-2" style="margin-top: 0%; margin-bottom: 0%">
            <img src="{!! asset('assets/img/logo.png') !!}" alt="" width="100">
        </div>
        <div class="col-xs-6" style="font-size: 12px">
            <br><br>
            <strong>PT. INDOTEKNIK PRATAMA PRO<br></strong>
            <p style="font-size: 10px">Jl. Jendral Sudirman No. 672 B<br>
                Bandung - Jawa Barat<br>
                Telp. 022 2057 33 22 Mb. 0819 0123 3030<br></p>
        </div>
        <div class="col-xs-4" style="font-size: 12px">
            <table width="80%" style="font-size: 11px;float: right">
                <tr>
                    <td width="40%" colspan="2"><p class="text-center" style="margin:0 auto; font-size: 18px"><b>KWITANSI<br>CASH
                                RECEIPT</b></p></td>
                </tr>
                <tr>
                    <td width="40%"><p class="text-left" style="margin:0 auto"> &emsp;<u>No QO</u> <br>&emsp;No SO</p>
                    </td>
                    <td width="40%"><p class="text-left" style="margin:0 auto"> &emsp;<u>{{ $QO }}</u>
                            <br>&emsp;{{ $SO }}</p></td>
                </tr>

            </table>
        </div>
    </div>
    <div class="col-xs-12" style="font-size: 11px">
        <div class="col-xs-6" style="font-size: 11px">
            <br>
            <strong>email : <b class="text-danger"><u>indoteknikpratamapro@gmail.com</u></strong></b>
        </div>
    </div>
    <div class="col-xs-12" style="margin-top: 1%">
        <div class="col-xs-12">
            <table class="table table-bordered" style="font-size: 11px">
                <tr>
                    <td width="100%">
                        <b>
                            <div class="col-xs-12">
                                <div class="col-xs-4">
                                    <u>Sudah terima dari&emsp;</u>
                                </div>
                                <div class="col-xs-1">
                                    :
                                </div>
                                <div class="col-xs-7">
                                    {{ $customer_name }}
                                </div>
                            </div>
                            <div class="col-xs-12">
                                <div class="col-xs-3">
                                    Received from
                                </div>
                            </div>
                            <div class="col-xs-12">
                                <div class="col-xs-4">
                                    <u>Banyaknya uang&emsp;&emsp;</u>
                                </div>
                                <div class="col-xs-1">
                                    :
                                </div>
                                <div class="col-xs-7">
                                    # {{ $terbilang }} #
                                </div>
                            </div>
                            <div class="col-xs-12">
                                <div class="col-xs-3">
                                    The sum of
                                </div>
                            </div>
                        </b>
                    </td>
                </tr>
                <tr>
                    <td width="100%">
                        <div class="col-xs-12">
                            <b>
                                <div class="col-xs-4">
                                    <u>Untuk pembayaran&ensp;</u>
                                </div>
                                <div class="col-xs-1">
                                    :
                                </div>
                            </b>
                            <div class="col-xs-7">
                                {{ $project_name }}
                            </div>
                        </div>
                        <div class="col-xs-12">
                            <b>
                                <div class="col-xs-3">
                                    For payment of
                                </div>
                            </b>
                        </div>
                    </td>
                </tr>
            </table>
        </div>
    </div>
    <div class="col-xs-12" style="font-size: 14px">
        <div class="col-xs-1">
            <b>Rp.</b>
        </div>
        <div class="col-xs-3">
            <table width="100%">
                <tr>
                    <td>
                        <b>
                            <p class="text-right" style="margin:0 auto">{{ number_format($nominal) }}</p>
                        </b>
                    </td>
                </tr>
            </table>
        </div>
    </div>
    <div class="col-xs-12">
        <div class="col-xs-6" style="font-size: 11px">
            <b><br>Catatan : <br>
                <ol>
                    <li>Mohon pembayaran ditransfer ke rekening bank berikut ini :<br>
                        BCA Cabang Abdul Rahman Saleh<br>
                        51 500 700 17<br>
                        a.n. CV Indoteknik Pratama<br>
                    </li>
                    <br>
                    <li>Kwitansi ini berlaku apabila telah diuangkan</li>
                </ol>
            </b>
        </div>
        <div class="col-xs-3">
        </div>
        <div class="col-xs-3 text-center" style="font-size: 11px">
            {{"Bandung,". date("d F Y",strtotime($updated_at))}}
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            Nama <br>
            Irene
        </div>
    </div>
    <div class="col-xs-12">
        <div class="col-xs-12">
            <hr>
        </div>
    </div>

@endsection

