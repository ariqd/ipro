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
        <a href="{{ url('finances') }}" class="btn btn-secondary float-right"><i class="fa fa-times"></i> Kembali</a>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <h4>Periode {{ $from->format('d F') }} - {{ $to->format('d F') }}</h4>
    </div>
    <div class="col-12">
        <table class="table table-light table-bordered">
            <thead class="text-center">
                <tr>
                    <th>No. SO</th>
                    <th>Tanggal</th>
                    <th>Total</th>
                    {{-- <th>Persentase</th> --}}
                    <th>Komisi ({{ $user->commission->percentage }}%)</th>
                </tr>
            </thead>
            <tbody class="text-center">
                @foreach ($sales_orders as $sales_order)
                <tr>
                    <td>
                        <a class="text-success" href="{{ url("sales-orders/$sales_order->id") }}">{{ $sales_order->no_so }}</a>
                    </td>
                    <td>{{ $sales_order->created_at->formatLocalized('%A, %d %B %Y %H:%I:%S') }}</td>
                    <td>
                        <span class="float-right">Rp {{ number_format($sales_order->grand_total) }}</span>
                    </td>
                    {{-- <td>
                        {{ $user->commission->percentage }} %
                    </td> --}}
                    <td>
                        <span class="float-right">Rp {{ number_format($sales_order->total_komisi) }}</span>
                    </td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="3">
                        <span class="float-right">Total Komisi : </span>
                    </th>
                    <th>
                        <span class="float-right">
                            Rp {{ number_format($total) }}
                        </span>
                    </th>
                </tr>
                <tr>
                    <th colspan="3">
                        <span class="float-right">Achievement : </span>
                    </th>
                    <th>
                        <span class="float-right">
                            Rp {{ number_format($user->commission->achievement) }}
                        </span>
                    </th>
                </tr>
                <tr>
                    <th colspan="3">
                        <span class="float-right">Status : </span>
                    </th>
                    <th class="text-center">
                        @if ($total < $user->commission->achievement)
                            <span class="badge badge-danger">Belum Achieve</span>
                            @else
                            <span class="badge badge-success">Achieved</span>
                            @endif
                    </th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
@endsection