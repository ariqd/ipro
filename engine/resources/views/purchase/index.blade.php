@extends('layouts.carbon')

@section('title', 'Purchase Order')

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
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            @include("layouts.feedback")
            <div class="d-flex justify-content-between">
                <div>
                    <h2><b>Purchase Orders</b></h2>
                </div>
                <div>
                    <a href="{{ url('/purchase-orders/create') }}" class="btn btn-dark"><i class="fa fa-plus"></i>
                        Purchase Order Baru</a>
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="table-responsive">
                <table class="table data-table table-hover table-light">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Tanggal</th>
                            <th>No. PO</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $key)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $key->created_at->toDayDateTimeString() }}</td>
                            <td>{{ $key->purchase_number }}</td>
                            <td>
                                @if($key->approval_status == 1)
                                <span
                                    class="badge badge-{{ $key->details()->approved()->count() < $key->details()->count() ? 'warning' : 'success' }}">
                                    Disetujui {{ $key->details()->approved()->count() }} dari
                                    {{ $key->details()->count() }}
                                </span>
                                @else
                                <span class="badge badge-danger">Belum Disetujui</span>
                                @endif
                            </td>
                            <td>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-outline-dark btn-sm dropdown-toggle"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fa fa-bars"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a href="{{ url('purchase-orders/'.$key->id) }}" class="dropdown-item">
                                            <i class="fa fa-eye"></i> Detail Approval</a>
                                        <a class="dropdown-item"
                                            href="{{ url('purchase-orders/'.$key->id.'/pdf/memo') }}">
                                            <i class="fa fa-print"></i> Print Memo Pengambilan
                                        </a>
                                        <a class="dropdown-item"
                                            href="{{ url('purchase-orders/'.$key->id.'/pdf/po') }}">
                                            <i class="fa fa-print"></i> Print Order Form
                                        </a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
