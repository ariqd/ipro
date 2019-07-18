@extends("layouts.print")

@section("title")
Komisi
@endsection

@push("css")

@endpush

@section("content")
<div class="container-fluid">
    <div class="col-xs-12">
        <div class="col-xs-6">
            <img src="{!! asset('assets/img/logo.png') !!}" alt="" width="150">
        </div>

        <div class="col-xs-6">
            <h5>PT INDOTEKNIK PRATAMA PRO</h5>
            <h6 style="font-size:10px; line-height: 0.2px">Jl. Jendral Sudirman No. 672 B</h6>
            <h6 style="font-size:10px; line-height: 0.2px">Bandung, Jawa Barat</h6>
            <h6 style="font-size:10px; line-height: 0.2px">Telp. 022 2057 33 22</h6>
            <h6 style="font-size:10px; line-height: 0.2px">Mobile 0819 0123 3030</h6>
        </div>
    </div>
    <div class="col-xs-12" style="text-align:center; padding: 2% 0 2% 0">
        FORM KOMISI SALES
    </div>
    <div class="col-xs-12">
        <table class="table table-bordered table-stripped">
            <thead>
                <th>No</th>
                <th>Keterangan</th>
                <th>Nama</th>
                <th>Total (Exclude PPN)</th>
                <th>Komisi(...)</th>
                <th>(-10%)</th>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>CAT (0.5%)</td>
                    <td>RIA</td>
                    <td>{{ number_format(242500) }}</td>
                    <td>{{ number_format(1213) }}</td>
                    <td>{{ number_format(1091) }}</td>
                </tr>
                <tr>
                    <td colspan="3">TOTAL KOMISI</td>
                    <td>41782000</td>
                    <td>393230</td>
                    <td>353907</td>
                </tr>
                <tr>
                    <td colspan="3">Status</td>
                    <td>Tidak Achieve</td>
                    <td>117969</td>
                    <td>106172</td>
                </tr>
            </tbody>
        </table>

        <div class="col-xs-12">
            <div class="col-xs-6"></div>
            <div class="col-xs-6" style="text-align: right">Bandung, {{ date(" d F Y") }}</div>
        </div>
        <style>
            td {
                text-align: center;
            }
        </style>
        <div class="col-xs-12" style="padding-top: 5%">
            <table class="table">
                <tr>
                    <td>(&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)
                    </td>
                    <td>IRENE</td>
                </tr>

                <tr>
                    <td>Sales</td>
                    <td>(Finance)</td>
                </tr>
            </table>
        </div>
    </div>
</div>


<div class="container-fluid" style="padding-top: 10%">
    <div class="col-xs-12">
        <div class="col-xs-6">
            <img src="{!! asset('assets/img/logo.png') !!}" alt="" width="150">
        </div>

        <div class="col-xs-6">
            <h5>PT INDOTEKNIK PRATAMA PRO</h5>
            <h6 style="font-size:10px; line-height: 0.2px">Jl. Jendral Sudirman No. 672 B</h6>
            <h6 style="font-size:10px; line-height: 0.2px">Bandung, Jawa Barat</h6>
            <h6 style="font-size:10px; line-height: 0.2px">Telp. 022 2057 33 22</h6>
            <h6 style="font-size:10px; line-height: 0.2px">Mobile 0819 0123 3030</h6>
        </div>
    </div>
    <div class="col-xs-12" style="text-align:center; padding: 2% 0 2% 0">
        FORM KOMISI SALES
    </div>
    <div class="col-xs-12">
        <table class="table table-bordered table-stripped">
            <thead>
                <th>No</th>
                <th>Keterangan</th>
                <th>Nama</th>
                <th>Total (Exclude PPN)</th>
                <th>Komisi(...)</th>
                <th>(-10%)</th>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>CAT (0.5%)</td>
                    <td>RIA</td>
                    <td>{{ number_format(242500) }}</td>
                    <td>{{ number_format(1213) }}</td>
                    <td>{{ number_format(1091) }}</td>
                </tr>
                <tr>
                    <td colspan="3">TOTAL KOMISI</td>
                    <td>41782000</td>
                    <td>393230</td>
                    <td>353907</td>
                </tr>
                <tr>
                    <td colspan="3">Status</td>
                    <td>Tidak Achieve</td>
                    <td>117969</td>
                    <td>106172</td>
                </tr>
            </tbody>
        </table>

        <div class="col-xs-12">
            <div class="col-xs-6"></div>
            <div class="col-xs-6" style="text-align: right">Bandung, {{ date(" d F Y") }}</div>
        </div>
        <style>
            td {
                text-align: center;
            }
        </style>
        <div class="col-xs-12" style="padding-top: 5%">
            <table class="table">
                <tr>
                    <td>(&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)
                    </td>
                    <td>IRENE</td>
                </tr>

                <tr>
                    <td>Sales</td>
                    <td>(Finance)</td>
                </tr>
            </table>
        </div>
    </div>
</div>

@endsection
