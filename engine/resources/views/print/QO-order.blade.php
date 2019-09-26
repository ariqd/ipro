@extends("layouts.print")

@section("title")
Quotation Order
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
        /* border: 1px solid black; */
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

    .table-borderless>tbody>tr>td,
    .table-borderless>tbody>tr>th,
    .table-borderless>tfoot>tr>td,
    .table-borderless>tfoot>tr>th,
    .table-borderless>thead>tr>td,
    .table-borderless>thead>tr>th {
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
        <img src="{!! asset('assets/img/logo.png') !!}" alt="" width="200">
        <div class="address">
            Jl. Jendral Sudirman No. 672 B Bandung. Telp. 022-20573322
        </div>
        <table class="table table-borderless">
            <tr>
                <td>Tanggal:</td>
                <td>{{ $sale->created_at }}</td>
            </tr>
            <tr>
                <td>No. SO:</td>
                <td>{{ $sale->quotation_id }}</td>
            </tr>
            <tr>
                <td colspan="2">&nbsp;</td>
            </tr>
            <tr>
                <th colspan="2"><b>SALES</b></th>
            </tr>
            <tr>
                <td>Nama:</td>
                <td>{{ $sale->user->name }}</td>
            </tr>
            <tr>
                <td>ID:</td>
                <td>{{ $sale->user->id }}</td>
            </tr>
            <tr>
                <td>Telp:</td>
                <td>-</td>
            </tr>
            <tr>
                <td>Email:</td>
                <td>{{ $sale->user->email }}</td>
            </tr>
        </table>
    </div>
    <div class="col-xs-6">
        <h2 class="title">Quotation Order</h2>
        <table class="table table-borderless">
            <tr>
                <th colspan="2"><b>PENERIMA</b></th>
            </tr>
            <tr>
                <td>Register ID:</td>
                <td> {{ $sale->customer->id }}</td>
            </tr>
            <tr>
                <td>Pemilik Project:</td>
                <td>{{ $sale->customer->project_owner }}</td>
            </tr>
            <tr>
                <td>Alamat:</td>
                <td>{{ $sale->customer->address }}</td>
            </tr>
            <tr>
                <td>Telp:</td>
                <td>{{ $sale->customer->phone }}</td>
            </tr>
            <tr>
                <td>Fax:</td>
                <td>{{ $sale->customer->fax }}</td>
            </tr>
            <tr>
                <td>Email:</td>
                <td>{{ $sale->customer->email }}</td>
            </tr>
            <tr>
                <td>Tgl Kirim:</td>
                <td>{{ date("d-m-Y",strtotime($sale->send_date)) }}</td>
            </tr>
            <tr>
                <td>Project:</td>
                <td>{{ $sale->project }}</td>
            </tr>
            <tr>
                <td>Alamat Project:</td>
                <td>{{ $sale->send_address }}</td>
            </tr>
            <tr>
                <td>PIC:</td>
                <td>{{ $sale->send_pic_phone }}</td>
            </tr>
            <tr>
                <td>Discount:</td>
                <td>-</td>
            </tr>
        </table>
    </div>
</div>
@if($sale->markup == 1)
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
                @php
                $total =0;
                $diskon =0;
                $totaltanpappn =0;
                @endphp
                @foreach($sale->detail as $key)

                <tr>
                    @php
                    $price = $key->price;
                    $pricediskon = $key->price - ($key->price *
                    $key->discount/100);
                    $priceppn = $pricediskon + $pricediskon*0.1;
                    @endphp
                    <td>{{ $key->qty }}</td>
                    <td>{{ $key->stock->item->name }}</td>
                    <td>{{ $key->stock->item->weight }}</td>
                    <td>{{ $key->qty*$key->stock->item->weight  }}</td>
                    <td>Rp. {{ number_format($pricediskon) }}</td>
                    <td>Rp. {{ number_format($pricediskon*$key->qty) }}</td>
                    @php
                    $total += $priceppn*$key->qty;
                    $totaltanpappn += ($key->price - ($key->price *
                    $key->discount/100)) * $key->qty
                    @endphp
                </tr>
                @endforeach
                <tr>
                    <td colspan="3">

                    </td>
                    <td></td>
                    <td>
                        <div class="text-right"><b>Subtotal</b></div>
                    </td>
                    <td>Rp. {{ number_format($totaltanpappn ) }}</td>
                </tr>

                <tr class="border-none">
                    <td colspan="4">
                        <div class="text-left"><b>CATATAN</b>
                            <p> {{ $sale->note }}</p>
                    </td>
                    <td>
                    </td>
                    <td></td>
                </tr>
                <tr class="border-none">
                    <td colspan="4"></td>
                    <td>
                        <div class="text-right"><b>DISC %</b></div>
                    </td>
                    <td>{{$diskon/100 ?? 0}} %</td>
                </tr>
                <tr class="border-none">
                    <td colspan="4"></td>
                    <td>
                        <div class="text-right"><b>DISC</b></div>
                    </td>
                    <td>Rp. {{ number_format($diskon) }}</td>
                </tr>
                <tr class="border-none">
                    <td colspan="4"></td>
                    <td>
                        <div class="text-right"><b>JUMLAH</b></div>
                    </td>
                    <td>Rp. {{ number_format($totaltanpappn) }}</td>
                </tr>
                <tr class="border-none">
                    <td colspan="4"></td>
                    <td>
                        <div class="text-right"><b>PPN 10%</b></div>
                    </td>
                    <td>Rp. {{ number_format(($totaltanpappn)*0.1) }}</td>
                </tr>
                <tr class="border-none">
                    <td colspan="4"></td>
                    <td>
                        <div class="text-right"><b>ONGKOS KIRIM</b></div>
                    </td>
                    <td>Rp. {{ number_format($sale->ongkir) }}</td>
                </tr>
                <tr>
                    <td colspan="4"></td>
                    <td>
                        <div class="text-right"><b>GRAND TOTAL</b></div>
                    </td>
                    <td>Rp. {{ number_format($total + $sale->ongkir) }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

@else

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
                    <th style="width:250px">JUMLAH</th>
                </tr>
            </thead>
            <tbody>
                @php
                $total =0;
                $diskon =0;
                @endphp
                @foreach($sale->detail as $key)


                <tr>
                    <td>{{ $key->qty }}</td>
                    <td>{{ $key->stock->item->name }}</td>
                    <td>{{ $key->stock->item->weight }}</td>
                    <td>{{ $key->qty*$key->stock->item->weight  }}</td>
                    <td>Rp. {{ number_format($key->price) }}</td>
                    <td>Rp. {{ number_format($key->price*$key->qty) }}</td>
                    @php
                    $total += $key->price*$key->qty;
                    $diskon += $key->discount/100 * ($key->price*$key->qty);
                    @endphp
                </tr>
                @endforeach
                <tr>
                    <td colspan="3">

                    </td>
                    <td></td>
                    <td>
                        <div class="text-right"><b>Subtotal</b></div>
                    </td>
                    <td> Rp. {{ number_format($total -$diskon) }}</td>
                </tr>

                <tr class="border-none">
                    <td colspan="4">
                        <div class="text-left"><b>CATATAN</b>
                            <p> {{ $sale->note }}</p>
                    </td>
                    <td>
                    </td>
                    <td></td>
                </tr>

                <tr class="border-none">
                    <td colspan="4"></td>
                    <td>
                        <div class="text-right"><b>DISC %</b></div>
                    </td>
                    <td>{{$diskon/100 ?? 0}} %</td>
                </tr>
                <tr class="border-none">
                    <td colspan="4"></td>
                    <td>
                        <div class="text-right"><b>DISC</b></div>
                    </td>
                    <td>Rp. {{ number_format($diskon) }}</td>
                </tr>
                <tr class="border-none">
                    <td colspan="4"></td>
                    <td>
                        <div class="text-right"><b>JUMLAH</b></div>
                    </td>
                    <td>Rp. {{ number_format($total-$diskon) }}</td>
                </tr>

                {{-- <tr class="border-none">
                    <td colspan="4"></td>
                    <td>
                        <div class="text-right"><b>PPN 10%</b></div>
                    </td>
                    <td>Rp. {{ number_format(($total -$diskon)*0.1) }}</td>
                </tr> --}}
                <tr class="border-none">
                    <td colspan="4"></td>
                    <td>
                        <div class="text-right"><b>ONGKOS KIRIM</b></div>
                    </td>
                    <td>Rp. {{ number_format($sale->ongkir) }}</td>
                </tr>
                <tr class="border-none">
                    <td colspan="4"></td>
                    <td>
                        <div class="text-right"><b>GRAND TOTAL</b></div>
                    </td>
                    {{-- <td>Rp. {{ number_format(($total + $sale->ongkir - $diskon) + (($total -$diskon)*0.1)) }}</td>
                    --}}
                    <td>Rp. {{ number_format(($total + $sale->ongkir - $diskon))}}</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

@endif

<div class="row">
    <div class="col-xs-4">
        <div class="text-center">
            <p>Mengetahui,</p>
            <p style="margin-top: 120px">(IRENE)</p>
            <P>KEUANGAN</P>
        </div>
    </div>
    <div class="col-xs-4">
    </div>
    <div class="col-xs-4">
        <div class="text-center">
            <p>Yang Membuat,</p>
            <p style="margin-top: 120px">{{$sale->user->name}}</p>
            <P>SALES</P>
        </div>
    </div>
</div>
@endsection
