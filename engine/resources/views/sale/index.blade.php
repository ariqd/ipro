@extends('layouts.carbon')

@section('title', 'Sales Order')

@section('content')
    <div class="container">
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
                            <th>ID</th>
                            <th>Date</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection