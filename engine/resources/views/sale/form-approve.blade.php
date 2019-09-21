@extends('layouts.carbon')

@if($sale->no_so == null || isset($sale->no_so))
@section('title', 'Quotation Order #' . $sale->quotation_id .' - '. $sale->created_at)
@else
@section('title', 'Sales Order #' . $sale->no_so .' - '. $sale->updated_at)
@endif

@section('content')
@include('layouts.feedback')
<div class="row">
    <div class="col-lg-12">
        <div class="d-flex justify-content-between">
            <div>
                @if($sale->no_so == null)
                <h4>Approval</h4>
                <h2><b>Quotation Order #{{ $sale->quotation_id }}</b></h2>
                @else
                <h2><b>Sales Order #{{ $sale->no_so }}</b></h2>
                @endif
            </div>
            <div>
                <a href="{{ url('sales-orders/check/approve') }}" class="btn btn-light">
                    <i class="fa fa-times"></i> Back
                </a>
            </div>
        </div>
        <hr>
    </div>
</div>
@if (empty($sale->no_so))
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form action="{{ url("sales-orders/$sale->id/payment") }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="note">Tanggal Bayar</label>
                        <input type="date" name="tgl_pembayaran" class="form-control" required
                            value="{{ date('Y-m-d') }}">
                    </div>
                    <div class="form-group">
                        <label for="atas_nama">Pembayaran Atas Nama</label>
                        <input type="text" name="atas_nama" id="atas_nama" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="perihal">Untuk Perihal</label>
                        <input type="text" name="perihal" id="perihal" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="note">Notes Payment</label>
                        <input type="text" name="notes" id="note" class="form-control">
                    </div>
                    <input type="submit" class="btn btn-success form-control" value="Setujui SO dan Print Kwitansi">
                </form>
            </div>
        </div>
    </div>
</div>
@else
<div class="alert alert-success" role="alert">
    <div class="d-flex justify-content-between align-items-center">
        <div class="font-weight-bold">
            <i class="fa fa-exclamation-circle"></i> Sales Order ini telah disetujui.
        </div>
        <div>
            <a href='approve/print' class='btn btn-light btn-sm float-right' target="_blank"><i class="fa fa-print"></i>
                Print Kwitansi
            </a>
        </div>
    </div>
</div>
@endif
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
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <h4>Detail Sales Order</h4>
        <div class="card">
            <div class="card-body">

                <div class="row">
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


                {{-- <div class="row mt-3">
                    <div class="col-4">
                        <b>
                            Ongkir
                        </b>
                    </div>
                    <div class="col-8">
                        Rp {{ number_format($sale->ongkir) }}
            </div>
        </div> --}}

    </div>
</div>
</div>
</div>

<div class="row">
    <div class="col-12">
        <h4>Detail Barang</h4>
        <div class="table-responsive">
            <table class="table table-light table-hover table-bordered">
                <thead class="text-center">
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Qty</th>
                        <th>Price</th>
                        <th>Discount</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    @foreach($sale->details as $details)
                    <tr>
                        <td>
                            {{ $loop->iteration }}
                        </td>
                        <td>
                            <div class="text-left">
                                <small class="text-secondary">
                                    {{ $details->stock->item->category->brand->name }}
                                    -
                                    {{ $details->stock->item->category->name }}
                                </small> <br>
                                {{ $details->stock->item->name }}
                            </div>
                        </td>
                        <td>
                            {{ $details->qty }}
                        </td>
                        <td>
                            <div class="float-right">
                                Rp{{number_format($details->price) }},00
                            </div>
                        </td>
                        <td>
                            {{ $details->discount}}%
                        </td>
                        <td>
                            <div class="float-right">
                                Rp{{number_format($details->total)}},00
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="5">
                            <div class="float-right">
                                Total:
                            </div>
                        </th>
                        <th>
                            <div class="float-right">
                                Rp {{ number_format($sale->grand_total) }}
                            </div>
                        </th>
                    </tr>
                    <tr>
                        <th colspan="5">
                            <div class="float-right">
                                Ongkos Kirim:
                            </div>
                        </th>
                        <th>
                            <div class="float-right">
                                Rp {{ number_format($sale->ongkir) }}
                            </div>
                        </th>
                    </tr>
                    <tr>
                        <th colspan="5">
                            <div class="float-right">
                                Grand Total:
                            </div>
                        </th>
                        <th>
                            <div class="float-right">
                                Rp {{ number_format($sale->grand_total + $sale->ongkir) }}
                            </div>
                        </th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
@endsection
