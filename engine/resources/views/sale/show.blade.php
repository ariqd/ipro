@extends('layouts.carbon')
@if($sale->no_so == null || isset($sale->no_so))
@section('title', 'Quotation Order #' . $sale->quotation_id .' - '. $sale->created_at)
@else
@section('title', 'Sales Order #' . $sale->no_so .' - '. $sale->updated_at)
@endif

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="d-flex justify-content-between">
            <div>
                @if($sale->no_so == null)
                <h2><b>Quotation Order #{{ $sale->quotation_id }}</b></h2>
                @else
                <h2><b>Sales Order #{{ $sale->no_so }}</b></h2>
                @endif
            </div>
            <div>
                {{--                    <a href="{{ url('sales-orders/'.$sale->id.'/edit') }}" class="btn btn-secondary mr-3">--}}
                    {{--                        Edit--}}
                {{--                    </a>--}}
                <a href="{{ url('sales-orders') }}" class="btn btn-light">
                    <i class="fa fa-times"></i> Back
                </a>
            </div>
        </div>
        <hr>
    </div>
</div>
<div class="row">
    <div class="col-lg-6">
        <h4>Detail Customer</h4>
        <div class="card">
            <div class="card-body">

                <div class="row">
                    <div class="col-4">
                        <b>
                            Register ID
                        </b>
                    </div>
                    <div class="col-8">
                        {{ $sale->customer->id }}
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-4">
                        <b>
                            Pemilik Project
                        </b>
                    </div>
                    <div class="col-8">
                        {{ $sale->customer->project_owner }}
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-4">
                        <b>
                            Email
                        </b>
                    </div>
                    <div class="col-8">
                        {{ $sale->customer->email }}
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-4">
                        <b>
                            Alamat
                        </b>
                    </div>
                    <div class="col-8">
                        {{ $sale->customer->address }}
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-4">
                        <b>
                            Phone
                        </b>
                    </div>
                    <div class="col-8">
                        {{ $sale->customer->phone }}
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-4">
                        <b>
                            Fax
                        </b>
                    </div>
                    <div class="col-8">
                        {{ $sale->customer->fax }}
                    </div>
                </div>

                {{--                <div class="row mt-3">--}}
                    {{--                    <div class="col-4">--}}
                        {{--                        <b>--}}
                            {{--                            Email--}}
                        {{--                        </b>--}}
                    {{--                    </div>--}}
                    {{--                    <div class="col-8">--}}
                        {{--                        {{ $sale->customer->email }}--}}
                    {{--                    </div>--}}
                {{--                </div>--}}

            </div>
        </div>
    </div>
    <div class="col-6">
        <h4>Detail Sales Order</h4>
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-4">
                        <b>
                            Nomor SO
                        </b>
                    </div>
                    <div class="col-8">
                        @if($sale->no_so != null)
                        {{ $sale->no_so }}
                        <span class="badge badge-success">Approved</span>
                        @else
                        <span class="badge badge-danger">Not Approved</span>
                        <a href="{{ url('sales-orders/'.$sale->id.'/payment') }}"
                           class="btn btn-warning btn-sm text-dark"> <i class="fa fa-check"></i> Approve Request
                       </a>
                       @endif
                       {{--                            {!! $sale->no_so != null ? $sale->no_so : '<p></p>' !!}--}}
                   </div>
               </div>

               <div class="row mt-3">
                <div class="col-4">
                    <b>
                        Project
                    </b>
                </div>
                <div class="col-8">
                    {{ $sale->project }}
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-4">
                    <b>
                        Send Address
                    </b>
                </div>
                <div class="col-8">
                    {{ $sale->send_address }}
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-4">
                    <b>
                        Send Date
                    </b>
                </div>
                <div class="col-8">
                    {{ date("d-m-Y",strtotime($sale->send_date)) }}
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-4">
                    <b>
                        PIC Phone
                    </b>
                </div>
                <div class="col-8">
                    {{ $sale->send_pic_phone }}
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-4">
                    <b>
                        Payment Method
                    </b>
                </div>
                <div class="col-8">
                    {{ $sale->payment_method }}
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-4">
                    <b>
                        Notes
                    </b>
                </div>
                <div class="col-8">
                    {{ $sale->note }}
                </div>
            </div>

        </div>
    </div>
</div>
</div>

<div class="row">
    <div class="col-12">
        <h4>Detail Barang</h4>
        <div class="card">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Qty</th>
                            <th>Price</th>
                            <th>Discount</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $flag = 0;
                        @endphp
                        @foreach($sale->details as $details)
                        @if($details->status==1) @php $flag++ @endphp @endif
                        <tr>
                            <td>
                                {{ $loop->iteration }}
                            </td>
                            <td>
                                {{ $details->stock->item->name }}
                            </td>
                            <td>
                                {{ $details->qty }}
                            </td>
                            <td>
                                Rp{{number_format($details->price) }},00
                            </td>
                            <td>
                                {{ $details->discount}}%
                            </td>
                            <td>
                                Rp{{number_format($details->total)}},00
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="row">
            <div class="col-lg-6">
                <a href="#" class="btn btn-dark btn-block"> Print Quotation</a>
            </div>
            <div class="col-lg-6">
                <form action = "{{ url("sales-orders/$sale->id/pdf/invoice") }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="form-group col-11">
                            <input type="submit" name="" class="btn btn-success btn-block" value="Print Invoice">
                        </div>
                        <div class="form-group col-1">
                            <input type="checkbox" name="markup" class="form-control">                        
                        </div>
                    </div>
                </form>

            </div>
            @if($flag != count($sale->details))
            <div class="col-lg-12 mt-2">
                <a href="{{ url("sales-orders/$sale->id/delivery-orders") }}"
                   class="btn btn-secondary btn-block"> Buat Surat Jalan</a>
               </div>
               @endif
           </div>
       </div>
   </div>
   @endsection