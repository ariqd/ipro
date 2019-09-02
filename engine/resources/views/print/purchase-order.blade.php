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
    <div class="col-xs-2" style="font-size: 19px">
        <center><strong>ORDER FORM</strong></center>
    </div>
    <div class="col-xs-5" class="col-xs-6" style="font-size: 11px">
        <table width="80%" style="float: right">
            <tr>
                <td width="40%">
                    <p class="text-right" style="margin:0 auto">No. Order :</p>
                </td>
                <td width="60%" colspan="3">{{$data->purchase_number}}</td>
            </tr>
            <tr>
                <td width="40%">
                    <p class="text-right" style="margin:0 auto">Date :</p>
                </td>
            <td width="60%" colspan="3"><b class="text-danger">{{date("d-M-Y",strtotime($data->created_at))}}</b></td>
            </tr>
        </table>
    </div>
</div>
<div class="col-xs-12" style="margin-top: 0%">
    <div class="col-xs-3" style="margin-top: 0%; margin-bottom: 0%">
    From:  <img src="{!! asset('assets/img/'.$data->details[0]->item->category->brand->name.'/'.$data->details[0]->item->category->brand->logo) !!}" alt="" width="70">
    </div>
    <div class="col-xs-4" style="font-size: 12px">
        <br><br>
        <strong>PT. INDOTEKNIK PRATAMA PRO<br></strong>
        <p style="font-size: 10px">Jl. Jendral Sudirman No. 672 B<br>
            Bandung - Jawa Barat<br>
            Telp. 022 2057 33 22 Mb. 0819 0123 3030<br></p>
    </div>
    <div class="col-xs-5" style="font-size: 12px">
        <br>
        <table width="80%" style="font-size: 11px;float: right">
            <tr>
                <td colspan="2">
                    <p class="text-center" style="margin:0 auto">Customer Code</p>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <p class="text-center" style="margin:0 auto; font-size: 19px">000000</p>
                </td>
            </tr>
        </table>
    </div>
</div>
<div class="col-xs-12" style="font-size: 11px">
    <div class="col-xs-6" style="font-size: 11px">
        <br>
        <strong>email : <b class="text-danger"><u>marketing.ipro@indoteknikpratama.co.id</u></strong></b>
    </div>
</div>
<div class="col-xs-12" style="margin-top: 1%">
    <div class="col-xs-12">
        <table class="table table-bordered" style="font-size: 11px">
            <thead style="text-align: center;">
                <tr>
                    <td rowspan="2"></td>
                    <td rowspan="2" width="50%">Product Description</td>
                    <td rowspan="2" width="15%">Material Code</td>
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
                $totalcount =0;
                $totalrupiah =0;
                $totalweight =0;
                @endphp
                @foreach ($data->details as $item)
                @php
                $totalcount += $item->qty;
                $totalrupiah += $item->item->purchase_price*$item->qty;
                $totalweight += $item->item->weight;
                @endphp
                <tr style="text-align: center;">
                    <td width="5%" class="vertical-text">{{$item->item->category->name}}</td>
                    <td>{{$item->item->name}}</td>
                    <td>{{$item->item->code}}</td>
                    <td>{{$item->qty}}</td>
                    <td style="">
                        {{$item->item->weight * $item->qty}}
                    </td>
                    <td class="">{{$item->qty}}</td>
                    <td class="printUang">
                        <p class="text-right" style="margin:0 auto">&nbsp;&nbsp;&nbsp;{{$item->item->purchase_price}}
                        </p>
                    </td>
                    <td class="printUang">&nbsp;&nbsp;&nbsp;6</td>
                    <td class="printUang">
                        <p class="text-right" style="margin:0 auto">
                            &nbsp;&nbsp;&nbsp;{{$item->item->purchase_price*$item->qty}}</p>
                    </td>
                </tr>
                @endforeach


                <tr style="text-align: center;">
                    <td class="text-right" colspan="5">TOTAL QTY (Pcs)</td>
                    <td class="text-right" colspan="1">
                        <p class="text-right" style="margin:0 auto">{{$totalcount}}</p>
                    </td>
                    <td class="text-right" colspan="2">Total Amount</td>
                    <td>
                        <p class="text-right" style="margin:0 auto">{{$totalrupiah}}
                    </td>
                </tr>

                <tr style="text-align: center;">
                    <td class="text-right" colspan="5">TOTAL WEIGHT (Kg)</td>
                    <td class="text-right" colspan="1">
                    <p class="text-right" style="margin:0 auto">{{$totalweight}}</p>
                    </td>
                    <td class="text-right" colspan="2">VA 10%</td>
                    <td>
                    <p class="text-right" style="margin:0 auto">{{$totalrupiah*0.1}}</p>
                    </td>
                </tr>
                <tr style="text-align: center;">
                    <td class="text-right" colspan="8">TOTAL (Incl VAT)</td>
                    <td class="printUang">
                    <p class="text-right" style="margin:0 auto">&nbsp;&nbsp;&nbsp;{{$totalrupiah + $totalrupiah*0.1}}</p>
                    </td>
                </tr>
                <tr style="text-align: center;">
                    <td class="text-right" colspan="8">Transport Cost (%)</td>
                    <td class="printUang">
                        <p class="text-right" style="margin:0 auto">&nbsp;&nbsp;&nbsp;0</p>
                    </td>
                </tr>
                <tr style="text-align: center;">
                    <td class="text-right" colspan="8">Total (Rp.)</td>
                    <td class="printUang">
                        <p class="text-right" style="margin:0 auto">&nbsp;&nbsp;&nbsp;{{$totalrupiah + $totalrupiah*0.1}}</p>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<div class="col-xs-12">
    <div class="col-xs-6" style="font-size: 11px">
        Remarks
    </div>
    <div class="col-xs-1" style="font-size: 11px">
        Shipment Condition
    </div>
    <div class="col-xs-4" style="font-size: 11px">
        <table width="100%">
            <tr>
                <td width="20%">abc</td>
                <td class="text-left">&nbspPick Up</td>
            </tr>
            <tr>
                <td width="20%">abc</td>
                <td class="text-left">&nbspDelivery by Conwood Indonesia</td>
            </tr>
        </table>
    </div>

</div>

<div class="col-xs-12">
    <br>
    <div class="col-xs-2" style="font-size: 11px">
        Project Code (if Have)<br>
        Sales Order No.<br>
        Delivery Order<br>
        Contract No.<br>
        Ship to<br>
    </div>
    <div class="col-xs-2" style="font-size: 11px">
        <br>
        <br>
        <br>
        <br>
        <br>
    </div>
    <div class="col-xs-3" style="font-size: 11px">
    </div>
    <div class="col-xs-2" style="font-size: 11px">
        Delivery To<br>
        Truck License No<br>
        Request Date Pick Up<br>
    </div>
    <div class="col-xs-2" style="font-size: 11px">
        <br>
        <br>
        <br>
    </div>
</div>


<div class="col-xs-12">
    <div class="col-xs-12">
        <br>
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
                        ( Nama )
                    </div>
                </td>
            </tr>
        </table>
    </div>
</div>

@endsection
