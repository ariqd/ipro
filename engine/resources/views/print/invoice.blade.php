@extends("layouts.print")

@section("title")
Invoice
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
</style>
@endpush

@section("content")
<div class="col-xs-12" style="margin-top: 10%">
    <div class="col-xs-5">
    </div>
    <div class="col-xs-2" style="font-size: 20px">
        <strong>INVOICE</strong>
    </div>
    <div class="col-xs-5" class="col-xs-6" style="font-size: 11px">
        <table width="80%" style="float: right">
            <tr>
                <td width="40%">
                    <p class="text-right" style="margin:0 auto">No. Order :</p>
                </td>
                <td width="60%" colspan="3">1</td>
            </tr>
            <tr>
                <td width="40%">
                    <p class="text-right" style="margin:0 auto">Date :</p>
                </td>
            <td width="60%" colspan="3"><b class="text-danger">{{date("d-m-Y")}}</b></td>
            </tr>
            <tr>
                <td width="40%">
                    <p class="text-right" style="margin:0 auto">Customer Code :</p>
                </td>
                <td width="20%">SO</td>
                <td width="20%">
                    <p class="text-right" style="margin:0 auto">SO</p>
                </td>
            <td width="20%">{{$sale->no_so}}</td>
            </tr>
        </table>
    </div>
</div>
<div class="col-xs-12" style="margin-top: 0%">
    <div class="col-xs-2" style="margin-top: 0%; margin-bottom: 0%">
        <img src="{!! asset('assets/img/logo.png') !!}" alt="" width="100%">
    </div>
    <div class="col-xs-5" style="font-size: 12px">
        <br><br>
        <strong>PT. INDOTEKNIK PRATAMA PRO<br></strong>
        <p style="font-size: 10px">Jl. Jendral Sudirman No. 672 B<br>
            Bandung - Jawa Barat<br>
            Telp. 022 2057 33 22 Mb. 0819 0123 3030<br></p>
    </div>
    <div class="col-xs-5" style="font-size: 12px">
        <table width="80%" style="font-size: 11px;float: right">
            <tr>
                <td width="40%">
                    <p class="text-right" style="margin:0 auto">Customer :</p>
                </td>
                <td width="60%" colspan="3">
                    <p class="text-center" style="margin:0 auto">{{$sale->customer->project_owner}}</p>
                </td>
            </tr>
            <tr>
                <td width="40%">
                    <p class="text-right" style="margin:0 auto">Address :</p>
                </td>
                <td width="60%" colspan="3">{{$sale->customer->address}}</td>
            </tr>
            <tr>
                <td width="40%">
                    <p class="text-right" style="margin:0 auto">City</p>
                </td>
                <td width="60%">{{$sale->customer->city ?? "-" }}</td>
            </tr>
            <tr>
                <td width="40%">
                    <p class="text-right" style="margin:0 auto">Contact :</p>
                </td>
                <td width="60%">{{$sale->customer->phone}}</td>
            </tr>
            <tr>
                <td width="40%">
                    <p class="text-right" style="margin:0 auto">Sales :</p>
                </td>
                <td width="60%">{{$sale->user->name}}</td>
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
            <thead style="text-align: center;">
                <tr>
                    <td rowspan="3" colspan="2" width="45%">Product Description</td>
                    <td rowspan="2">Pcs / Pack</td>
                    <td rowspan="2">Weight (Kg)</td>
                    <td>Order qty</td>
                    <td>Price (IDR)</td>
                    <td>Discount</td>
                    <td rowspan="2" width="18%">Total Amount (IDR) Incl. Disc</td>
                </tr>
                <tr>
                    <td>(in Pieces)</td>
                    <td>(in Pieces)</td>
                    <td>(%)</td>
                </tr>
            </thead>
            <tbody>
                @php
                $totalweight = 0;
                @endphp
                @foreach($sale->detail as $detail)
                <tr style="text-align: center;">
                    <td width="5%" class="vertical-text">{{$detail->stock->item->category->name}}</td>
                    <td>{{$detail->stock->item->name}}</td>
                    <td>{{$detail->qty}}</td>
                    <td style="">
                        {{$detail->stock->item->weight}}
                        @php
                            $totalweight += $detail->stock->item->weight * $detail->qty;
                        @endphp
                    </td>
                    <td class="">{{$detail->qty}}</td>
                    <td class="printUang">
                        <p class="text-right" style="margin:0 auto">&nbsp;&nbsp;&nbsp;{{$detail->price}}</p>
                    </td>
                    <td class="printUang">&nbsp;&nbsp;&nbsp;{{$detail->discount}}</td>
                    <td class="printUang">
                        <p class="text-right" style="margin:0 auto">&nbsp;&nbsp;&nbsp;{{$detail->price * $detail->qty}}
                        </p>
                    </td>
                </tr>
                @endforeach

                <tr style="text-align: center;">
                    <td class="text-right" colspan="4">TOTAL QTY (Pcs)</td>
                    <td class="text-right" colspan="1">
                        <p class="text-right" style="margin:0 auto"></p>
                    </td>
                    <td class="text-right" colspan="2">Total Amount</td>
                    <td>
                        <p class="text-right" style="margin:0 auto">{{$sale->grand_total}}
                    </td>
                </tr>

                <tr style="text-align: center;">
                    <td class="text-right" colspan="4">TOTAL WEIGHT (Kg)</td>
                    <td class="text-right" colspan="1">
                        <p class="text-right" style="margin:0 auto">{{$totalweight}}</p>
                    </td>
                    <td class="text-right" colspan="2">Transport Cost</td>
                    <td>
                        <p class="text-right" style="margin:0 auto">{{$sale->ongkir}}</p>
                    </td>
                </tr>

                <tr style="text-align: center;">
                    <td class="text-right" colspan="7">Discount Transport Cost (%)</td>
                    <td class="printUang">
                        <p class="text-right" style="margin:0 auto">&nbsp;&nbsp;&nbsp;0</p>
                    </td>
                </tr>
                <tr style="text-align: center;">
                    <td class="text-right" colspan="7">Total (Rp.)</td>
                    <td class="printUang">
                        <p class="text-right" style="margin:0 auto">&nbsp;&nbsp;&nbsp;{{$sale->grand_total +$sale->ongkir}}</p>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<div class="col-xs-12">
    <div class="col-xs-5 text-center" style="font-size: 18px">
        <table width="100%">
            <tr>
                <td>
                    <b>
                        BCA Account : 51 5059 6060 <br>
                        PT Indoteknik Pratama Pro <br>
                        BCA Cab. Abdul Rahman Saleh <br>
                    </b>
                </td>
            </tr>
        </table>
    </div>

</div>
<div class="col-xs-12">
    <div class="col-xs-12" style="font-size: 11px">
        <b class="text-danger"><strong>Note :</strong></b>
        <ol>
            <li class="text-danger">Barang yang telah dibeli, tidak dapat dikembalikan.</li>
        </ol>
    </div>
</div>

<div class="col-xs-12">
    <div class="col-xs-12">
        <table width="100%">
            <tr>
                <td>
                    <div class="col-xs-2 text-center">
                        Customer ..........
                        <br>
                        Created By
                        <br>
                        <br>
                        <br>
                        <br>
                        (.............)
                    </div>
                    <div class="col-xs-8 text-center">
                    </div>

                    <div class="col-xs-2 text-center">
                        <br>
                        Authorized by
                        <br>
                        <br>
                        <br>
                        <br>
                        ( Irene )
                    </div>
                </td>
            </tr>
        </table>
    </div>
</div>
@endsection
