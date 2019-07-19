@extends('layouts.carbon')

@section('title', 'Finances')

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
    <div class="col-lg-12">
        <h2 class="font-weight-bold">Finances</h2>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <h4>Komisi Sales | Periode 15 Juli - 14 Agustus</h4>
    </div>
    <div class="col-12">
        <table class="table table-light data-table table-hover">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Persentase</th>
                    <th>Total Komisi</th>
                    <th>Achievement</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($sales as $user)
                <tr>
                    <td>{{ $user->name }} ({{ $user->branch->name }})</td>
                    <td>{{ @$user->commission->percentage ?? '0' }} %</td>
                    <td>Rp {{ number_format(@$user->commission->total_commission) ?? '-' }}</td>
                    <td>Rp {{ number_format(@$user->commission->achievement) ?? '-' }}</td>
                    <td>
                        @if (empty($user->commission->percentage))
                        <span class="badge badge-warning">Komisi periode ini belum diatur</span>
                        @else
                        @if ($user->commission->total_commission < $user->commission->achievement)
                            <span class="badge badge-danger">Belum Achieve</span>
                            @else
                            <span class="badge badge-success">Achieved</span>
                            @endif
                            @endif
                    </td>
                    <td>
                        @if (empty($user->commission->percentage))
                        <small class="text-danger">
                            <a href="{{ route("finances.komisi.set", $user) }}" class="btn btn-dark btn-sm my-1">
                                <i class="fa fa-plus"></i> Set Komisi
                            </a>
                        </small>
                        @else
                        <a href="{{ route('finances.komisi.show', $user) }}" class="btn btn-secondary btn-sm">Detail
                            Komisi</a>
                        <a href="{{ route("finances.komisi.print", $user) }}" class="btn btn-success btn-sm my-1">
                            Print Laporan Komisi</a>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection