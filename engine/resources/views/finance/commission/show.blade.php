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
    <div class="col-lg-9">
        <h2 class="font-weight-bold">Finances - Detail Komisi</h2>
    </div>
    <div class="col-3">
        <a href="{{ url('finances') }}" class="btn btn-secondary float-right"><i class="fa fa-times"></i> Kembali</a>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <h4>Komisi {{ $user->name }} ({{ $user->branch->name }}) | Periode 15 Juli - 14 Agustus</h4>
    </div>
    <div class="col-12">
        <table class="table table-light table-borderless border">
            <tr>
                <td class="text-secondary w-25">Nama Sales:</td>
                <td>{{ $user->name }}</td>
            </tr>
            <tr>
                <td class="text-secondary">Cabang:</td>
                <td>{{ $user->branch->name }}</td>
            </tr>
            <tr>
                <td class="text-secondary">Persentase Komisi:</td>
                <td>{{ $user->commission->percentage }} %</td>
            </tr>
            <tr>
                <td class="text-secondary">Komisi Hari Ini:</td>
                <td>Rp {{ number_format($user->commission->today_commission) ?? '0' }}</td>
            </tr>
            <tr>
                <td class="text-secondary">Total Komisi:</td>
                <td>Rp {{ number_format($user->commission->total_commission) ?? '0' }}</td>
            </tr>
            <tr>
                <td class="text-secondary">Achievement:</td>
                <td>Rp {{ number_format($user->commission->achievement) ?? '0' }}</td>
            </tr>
            <tr>
                <td class="text-secondary">Status:</td>
                <td>
                    @if (empty($user->commission->percentage))
                    <span class="badge badge-warning">Komisi periode ini belum diatur</span>
                    @else
                    <span class="badge badge-danger">Belum Achieve</span>
                    @endif
                </td>
            </tr>
        </table>
    </div>
</div>
@endsection