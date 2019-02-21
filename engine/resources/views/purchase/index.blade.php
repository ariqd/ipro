@extends('layouts.carbon')

@section('title', 'Purchase Order')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="d-flex justify-content-between">
                    <div>
                        <h2><b>Purchase Orders</b></h2>
                    </div>
                    <div>
                        <a href="{{ url('/purchase-orders/create') }}" class="btn btn-dark"><i
                                    class="fa fa-plus"></i> New Purchase Order</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection