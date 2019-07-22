@extends('layouts.carbon')

@section('title', 'Sales Order')

@push('css')
<link href="{{ asset('assets/plugins/DataTables/datatables.min.css') }}" rel="stylesheet" />
<link href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css" rel="stylesheet" />
@endpush

@push('js')
<script src="{{ asset('assets/plugins/DataTables/datatables.min.js') }}"></script>
<script src="https://cdn.datatables.net/plug-ins/1.10.19/features/scrollResize/dataTables.scrollResize.min.js"></script>

<script type="text/javascript">
    $('.data-table').DataTable({
        "ordering": false
    });
</script>
@endpush

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="d-flex justify-content-between">
            <div>
                <h2><b>Sales Orders @if (Auth::user()->role == 'finance') Approve @endif</b></h2>
            </div>
            @if (Auth::user()->role != 'finance')
            <div>
                <a href="{{ url('sales-orders/create') }}" class="btn btn-dark">
                    <i class="fa fa-plus"></i> Create Sales Quotation
                </a>
            </div>
            @endif
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="table-responsive">
            <table class="table data-table table-light">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>No. Quotation</th>
                        <th>No. SO</th>
                        <th>Customer</th>
                        <th>Sales</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($sales as $sale)
                    <tr>
                        <td>{{ $sale->created_at->format('l, d F Y H:i') }}</td>
                        <td>{{ $sale->quotation_id }}</td>
                        <td>
                            {{ $sale->no_so}}
                            @if($sale->no_so != null)
                            <span class="badge badge-success">Approved</span>
                            @else
                            <span class="badge badge-danger">Not Approved</span>
                            @endif
                        </td>
                        <td>{{ $sale->customer->project_owner }}</td>
                        <td>{{ $sale->user->name }} ({{ $sale->user->branch->name }})</td>
                        <td>
                            @if(Gate::allows("isAdmin"))
                            @if($sale->no_so == null)
                            <a href="{{ url('sales-orders/'.$sale->id.'/payment') }}"
                                class="btn btn-warning btn-sm my-1 text-dark"> <i class="fa fa-check"></i>
                                Approve
                                Request
                            </a>
                            @endif
                            <a href="{{ url('sales-orders/'.$sale->id) }}" class="btn btn-dark btn-sm" my-1>
                                Show </a>
                            <a href="{{ url('sales-orders/'.$sale->id.'/edit') }}" class="btn btn-secondary btn-sm"
                                my-1> Edit </a>
                            @elseif(Gate::allows("isFinance"))
                            @if($sale->no_so == null)
                            <a href="{{ url('sales-orders/'.$sale->id.'/payment') }}"
                                class="btn btn-warning btn-sm my-1 text-dark"> <i class="fa fa-check"></i>
                                Approve
                                Request
                            </a>
                            @else
                            <a href="{{ url('sales-orders/'.$sale->id) }}" class="btn btn-dark btn-sm" my-1>
                                Show </a>
                            @endif
                            @elseif(Gate::allows("isSales"))
                            <a href="{{ url('sales-orders/'.$sale->id) }}" class="btn btn-dark btn-sm" my-1>
                                Show </a>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection