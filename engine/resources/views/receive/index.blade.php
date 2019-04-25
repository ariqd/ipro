@extends('layouts.carbon')

@section('title', 'Goods Receive')

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
                    <a href="{{ url('/goods-receive/create') }}" class="btn btn-dark"><i
                        class="fa fa-plus"></i> New Goods Receive</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="table-responsive">
                    <table class="table table-bordered table-light">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>No Receive</th>
                                <th>No PO</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                          <tr>
                              <td>-</td>
                              <td>-</td>
                              <td>-</td>
                              <td>-</td>
                          </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @endsection