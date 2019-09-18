@extends("layouts.print")

@section("title")
Surat Jalan
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
    <div style="text-align:center">
        <h4>Surat Jalan</h4>
        <h6>xxx/yyy/zz</h6>
    </div>
</div>
<div class="col-xs-12">
    {{-- <div class="col-xs-3" style="">
        <img src="{!! asset('assets/img/logo.png') !!}" alt="" width="73">
    </div> --}}
    <div class="col-xs-6" style="">
        <div class="col-xs-12">Bersama ini kendaraan {{ $head->mobil }} No. {{ $head->plat }}</div>
        <div class="col-xs-12">kami kirimkan barang tersebut, dibawah ini.</div>
        <div class="col-xs-12">Harap terima dengan baik.</div>
    </div>
    <div class="col-xs-6">
        <div class="col-xs-12">Bandung , {{ Carbon\Carbon::parse(date("Y-m-d"))->formatLocalized('%A, %d %B %Y')}}</div>
        <div class="col-xs-12">Nama Customer</div>
        <div class="col-xs-12">Nama Toko</div>
        <div class="col-xs-12">Alamat Toko</div>
    </div>
</div>
<div class="col-xs-12">
    <div class="col-xs-6" style="">

    </div>
    <div class="col-xs-6" style="">

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
            <td>No.SO</td>
        </tr>
        @foreach ($line as $item)
        <tr>
            <td>No.</td>
            <td>{{ $item->detail->stock->item->name }}</td>
            <td>{{ $item->qty_kirim }}</td>
            <td>{{ $item->detail->stock->item->weight }}</td>
            <td>{{ $item->qty_kirim*$item->detail->stock->item->weight }}</td>
            <td>{{ $item->detail->sale->no_so }}</td>

        </tr>
        @endforeach
    </table>
    <div class="col-xs-12 ">
        <div class="col-xs-4 ">
            <table>
                <tr>
                    <td style="width:288px; height: 75px"></td>
                </tr>

                <tr>
                    <td style="height: 31px">Tanda Tangan Terima</td>
                </tr>
            </table>
        </div>
        <div class="col-xs-4">
            <table>
                <tr>
                    <td style="width:288px; height: 75px"> </td>
                </tr>

                <tr>
                    <td style="height: 31px">Mengetahui</td>
                </tr>
            </table>
        </div>
        <div class="col-xs-4">
            <table>
                <tr>
                    <td style="width:288px; height: 75px"></td>
                </tr>

                <tr>
                    <td style="height: 31px">Hormat Kami</td>
                </tr>
            </table>
        </div>
    </div>

</div>
@endsection
