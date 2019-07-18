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
        <h4>Komisi Sales | Periode 15 Juli 2019 - 15 Agustus 2019</h4>
    </div>
    <div class="col-12">
        <table class="table table-light data-table">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Cabang</th>
                    <th>Persentase</th>
                    <th>Komisi</th>
                    <th>Achievement</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($sales as $person)
                <tr>
                    <td>{{ $person->name }}</td>
                    <td>{{ $person->branch->name }}</td>
                    <td>2%</td>
                    <td>Rp 23.000.000</td>
                    <td>Rp 123.000.000</td>
                    <td>
                        <span class="badge badge-danger">Belum Achieve</span>
                    </td>
                    <td>
                        <a href="#" class="btn btn-secondary btn-sm">Detail Komisi</a>
                        <a href="#" class="btn btn-success btn-sm">Print Laporan Komisi</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection