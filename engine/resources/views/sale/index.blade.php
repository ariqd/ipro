@extends('layouts.carbon')

@section('title', 'Sales Order')

@section('content')
    {{--    <div class="container">--}}
    <div class="row">
        <div class="col-lg-12">
            <div class="d-flex justify-content-between">
                <div>
                    <h2><b>Sales Orders</b></h2>
                </div>
                <div>
                    <a href="{{ url('sales-orders/create') }}" class="btn btn-dark"><i
                                class="fa fa-plus"></i> Create Sales Quotation</a>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="table-responsive">
                <table class="table table-light">
                    <thead>
                    <tr>
                        <th>Date</th>
                        <th>Customer</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($sales as $sale)
                        <tr>
                            <td>{{ $sale->created_at }}</td>
                            <td>{{ $sale->customer->project_owner }}</td>
                            <td>
                                <a href="{{ url('sales-orders/'.$sale->id) }}" class="btn btn-dark btn-sm">
                                    Show
                                </a>
                                <a href="{{ url('sales-orders/'.$sale->id.'/edit') }}" class="btn btn-secondary btn-sm">
                                    Edit
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    {{--    </div>--}}
@endsection