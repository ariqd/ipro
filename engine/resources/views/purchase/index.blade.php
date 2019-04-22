@extends('layouts.carbon')

@section('title', 'Purchase Order')

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
                    <a href="{{ url('/purchase-orders/create') }}" class="btn btn-dark"><i
                        class="fa fa-plus"></i> New Purchase Order</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="table-responsive">
                    <table class="table table-bordered table-light">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>No Purchase</th>
                                <th>Disetujui</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $key)
                            <tr>
                                <td>{{ date("l, d-m-Y",strtotime($key->created_at)) }}</td>
                                <td>{{ $key->purchase_number }}</td>
                                <td>
                                    <a href="{{ url('purchase-orders/'.$key->id) }}" class="btn btn-dark btn-sm">
                                        Show
                                    </a>
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