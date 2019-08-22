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


        <div class="row">
            <div class="col-6">
                <h4>Periode {{ $from }} - {{ $to }}</h4>
            </div>
            <div class="col-6">
                <h4 class="float-right">
                    Achievement: Rp {{ number_format($commission->achievement, '0', ',', '.') }}
                    Achieved: Rp {{ number_format($commission->achieved, '0', ',', '.') }}
                </h4>
            </div>
            <div class="col-12">
                <table class="table table-light table-bordered table-hover">
                    <thead class="text-center">
                        <tr>
                            <th rowspan="2" class="align-middle">No</th>
                            <th rowspan="2" class="align-middle">Keterangan</th>
                            <th>Total (Exclude PPN)</th>
                            <th>Komisi</th>
                            {{-- <th>(-10 %)</th> --}}
                        </tr>
                        <tr>
                            <th>
                                <span class="float-right font-weight-bold">
                                    @if ($commission->achieved > $commission->achievement)
                                        <span class="badge badge-success">Achieve</span>
                                        @else
                                        <span class="badge badge-danger">Tidak Achieve</span>
                                        @endif
                                        Rp {{ number_format($commission->achieved) }}
                                </span>
                            </th>
                            <th>
                                <span class="float-right font-weight-bold">
                                    @if ($commission->achieved > $commission->achievement)
                                        Rp {{ number_format($commission->total_commission) }}
                                        <span class="badge badge-success">Achieve</span>
                                        @else
                                        Rp {{ number_format($commission->total_commission_not_achieve) }}
                                        <span class="badge badge-danger">Tidak Achieve</span>
                                        @endif
                                </span>
                            </th>
                            {{-- <th>
                                        <span class="float-right font-weight-bold">
                                            Rp {{ number_format($data['total_buat_sales']) }}
                            </span>
                            </th> --}}
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($detail_commission as $sales_order)
                        <tr>
                            <td class="align-middle">{{ $loop->iteration }}</td>
                            <td class="align-middle">
                                #{{ $sales_order->sale->no_so }} <br>
                            </td>
                            <td class="align-middle">
                                <span class="float-right">Rp {{ number_format($sales_order->sale->grand_total) }}</span>
                            </td>
                            <td class="align-middle">
                                    @if ($commission->achieved > $commission->achievement)
                                    <span class="float-right">Rp {{ number_format($sales_order->commission) }}</span>
                                    @else
                                    <span class="float-right">Rp {{ number_format($sales_order->commission_not_achieve) }}</span>
                                    @endif

                            </td>


                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="2">
                                <span class="float-right font-weight-bold">
                                    Total:
                                </span>
                            </td>
                            <td>
                                <span class="float-right font-weight-bold">
                                    {{-- Rp {{ number_format($data['total']) }} --}}
                                </span>
                            </td>
                            <td>
                                <span class="float-right font-weight-bold">
                                    @if ($commission->achieved > $commission->achievement)
                                        Rp {{ number_format($commission->total_commission) }}
                                        <span class="badge badge-success">Achieve</span>
                                        @else
                                        Rp {{ number_format($commission->total_commission_not_achieve) }}
                                        <span class="badge badge-danger">Tidak Achieve</span>
                                        @endif
                                </span>
                            </td>
                            {{-- <td>
                                        <span class="float-right font-weight-bold">
                                            Rp {{ number_format($data['total_buat_sales']) }}
                            </span>
                            </td> --}}
                        </tr>
                        <tr>
                            <td colspan="2">
                                <span class="float-right font-weight-bold">
                                    Status:
                                </span>
                            </td>
                            <td>
                                <h4 class="float-right font-weight-bold">
                                    @if ($commission->achieved > $commission->achievement)
                                        <span class="badge badge-success">Achieve</span>
                                        @else
                                        <span class="badge badge-danger">Tidak Achieve</span>
                                        @endif
                                        Rp {{ number_format($commission->achieved) }}
                                </h4>
                            </td>

                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

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

{{--
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


        <div class="row">
            <div class="col-6">
                <h4>Periode {{ $from->format('d F') }} - {{ $to->format('d F') }}</h4>
</div>
<div class="col-6">
    <h4 class="float-right">
        Achievement: Rp {{ number_format($user->commission->achievement, '0', ',', '.') }}
    </h4>
</div>
<div class="col-12">
    <table class="table table-light table-bordered table-hover">
        <thead class="text-center">
            <tr>
                <th rowspan="2" class="align-middle">No</th>
                <th rowspan="2" class="align-middle">Keterangan</th>
                <th>Total (Exclude PPN)</th>
                <th>Komisi</th>
                <th>(-10 %)</th>
            </tr>
            <tr>
                <th>
                    <span class="float-right font-weight-bold">
                        @if ($data['achieved'])
                        <span class="badge badge-success">Achieve</span>
                        @else
                        <span class="badge badge-danger">Tidak Achieve</span>
                        @endif
                        Rp {{ number_format($data['total']) }}
                    </span>
                </th>
                <th>
                    <span class="float-right font-weight-bold">
                        Rp {{ number_format($data['total_komisi']) }}
                    </span>
                </th>
                <th>
                    <span class="float-right font-weight-bold">
                        Rp {{ number_format($data['total_buat_sales']) }}
                    </span>
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($sales_orders as $sales_order)
            <tr>
                <td class="align-middle">{{ $loop->iteration }}</td>
                <td class="align-middle">
                    <small class="text-secondary">
                        {{ $sales_order->stock->item->category->brand->name }}
                        -
                        {{ $sales_order->stock->item->category->name }}
                    </small> <br>
                    {{ $sales_order->stock->item->name }} ({{ $sales_order->persen }})
                </td>
                <td class="align-middle">
                    <span class="float-right">Rp {{ number_format($sales_order->total) }}</span>
                </td>
                <td class="align-middle">
                    <span class="float-right">Rp {{ number_format($sales_order->komisi) }}</span>
                </td>
                <td class="align-middle">
                    <span class="float-right">Rp {{ number_format($sales_order->buat_sales) }}</span>
                </td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="2">
                    <span class="float-right font-weight-bold">
                        Total:
                    </span>
                </td>
                <td>
                    <span class="float-right font-weight-bold">
                        Rp {{ number_format($data['total']) }}
                    </span>
                </td>
                <td>
                    <span class="float-right font-weight-bold">
                        Rp {{ number_format($data['total_komisi']) }}
                    </span>
                </td>
                <td>
                    <span class="float-right font-weight-bold">
                        Rp {{ number_format($data['total_buat_sales']) }}
                    </span>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <span class="float-right font-weight-bold">
                        Status:
                    </span>
                </td>
                <td>
                    <h4 class="float-right font-weight-bold">
                        @if ($data['achieved'])
                        <span class="badge badge-success">Achieve</span>
                        @else
                        <span class="badge badge-danger">Tidak Achieve</span>
                        @endif
                    </h4>
                </td>
                <td>
                    <span class="float-right font-weight-bold">
                        Rp {{ number_format($data['total_komisi'] * $data['percentage']) }}
                    </span>
                </td>
                <td>
                    <span class="float-right font-weight-bold">
                        Rp {{ number_format($data['total_buat_sales'] * $data['percentage']) }}
                    </span>
                </td>
            </tr>
        </tfoot>
    </table>
</div>
</div>

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
</div> --}}

@endsection
