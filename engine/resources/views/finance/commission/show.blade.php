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
        <table class="table table-light table-bordered table-hover">
            <thead class="text-center">
                <tr>
                    <th>No</th>
                    <th>Keterangan</th>
                    <th>Total (Exclude PPN)</th>
                    <th>Komisi</th>
                    <th>(-10 %)</th>
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
                        {{-- <b> --}}
                            {{ $sales_order->stock->item->name }}
                        {{-- </b> --}}
                        ({{ $sales_order->persen }})
                    </td>
                    {{-- <td class="align-middle">{{ $sales_order->created_at->formatLocalized('%A, %d %B %Y %H:%I:%S') }}
                    </td> --}}
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
            </tfoot>
        </table>
    </div>
</div>
@endsection