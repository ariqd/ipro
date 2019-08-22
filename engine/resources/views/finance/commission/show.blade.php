@extends('layouts.carbon')

@section('title', 'Finance - Detail Komisi')

@push('css')
<link href="{{ asset('assets/plugins/DataTables/datatables.min.css') }}" rel="stylesheet" />
<link href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css" rel="stylesheet" />
@endpush

@push('js')
<script src="{{ asset('assets/plugins/DataTables/datatables.min.js') }}"></script>
<script src="https://cdn.datatables.net/plug-ins/1.10.19/features/scrollResize/dataTables.scrollResize.min.js"></script>

<script type="text/javascript">
    $('.data-table').DataTable();

</script>
@endpush

@section('content')
<div class="row">
    <div class="col-9">
        <h2 class="font-weight-bold">Finances - Detail Komisi {{ $user->name }} ({{ $user->branch->name }})</h2>
    </div>
    <div class="col-3">
        <a href="{{ url('finances') }}" class="btn btn-secondary float-right"><i class="fa fa-times"></i>
            Kembali</a>
    </div>
</div>

<div class="row">
    <div class="col-6">
        <h4>Periode {{ $from }} - {{ $to }}</h4>
    </div>
    <div class="col-6">
        <h4 class="float-right">
            Achievement: Rp {{ number_format($commission->achievement, '0', ',', '.') }}
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
                    <th>Role</th>
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
                    <td class="align-middle">
                        <span class="">Dengan {{$sales_order->role}}</span>
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
                    <td>
                        {{-- <span class="float-right font-weight-bold">
                                            Rp {{ number_format($data['total_komisi'] * $data['percentage']) }}
                        </span> --}}
                    </td>
                    <td>
                        {{-- <span class="float-right font-weight-bold">
                                            Rp {{ number_format($data['total_buat_sales'] * $data['percentage']) }}
                        </span> --}}
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
@endsection
