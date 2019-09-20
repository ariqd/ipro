@extends('layouts.carbon')

@section('title', 'Goods Receive')

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
                    <h2><b>Goods Receive</b></h2>
                </div>
                <div>
                    <a href="{{ url('/goods-receive/create') }}" class="btn btn-dark"><i class="fa fa-plus"></i> New
                        Goods Receive</a>
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="table-responsive">
                <table class="table table-bordered table-light data-table">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>No Receive</th>
                            <th>No PO</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $key)
                        <tr>
                            <td>{{ date("d-m-Y",strtotime($key->created_at)) }}</td>
                            <td>{{ $key->receipt }}</td>
                            <td>{{ $key->purchase->purchase_number }}</td>
                            <td>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-outline-dark btn-sm dropdown-toggle"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fa fa-bars"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a href="{{ url('goods-receive/'.$key->id) }}" class="dropdown-item">
                                            <i class="fa fa-eye"></i> Detail</a>
                                        <form action="{{ url('goods-receive/'.$key->id) }}" method="post"
                                            class="formDelete d-none">
                                            {!! csrf_field() !!}
                                            {!! method_field('delete') !!}
                                        </form>
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
