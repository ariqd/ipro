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
<div class="row">
    <div class="col-9">
        <h2 class="font-weight-bold">Finances - Detail Komisi {{ $user->name }} ({{ $user->branch->name }})</h2>
    </div>
    <div class="col-3">
        <a href="{{ url('finances') }}" class="btn btn-secondary float-right"><i class="fa fa-times"></i> Kembali</a>
    </div>
</div>

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
@endsection
