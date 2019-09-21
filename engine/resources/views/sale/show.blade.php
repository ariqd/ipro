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
                <a href="{{ url('sales-orders') }}" class="btn btn-light">
                    <i class="fa fa-arrow-left"></i> Daftar SO
                </a>
            </div>
        </div>
        <hr>
    </div>
</div>
@if (auth()->user()->role == 'finance' || auth()->user()->role == 'gudang')
@if (empty($sale->no_so))
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form action="{{ url("sales-orders/$sale->id/payment") }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="note">Tanggal Bayar</label>
                        <input type="date" name="tgl_pembayaran" class="form-control" required>
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
            <a href='{{ url("sales-orders/$sale->id/approve/print") }}' class='btn btn-light btn-sm float-right'
                target="_blank"><i class="fa fa-print"></i> Print Kwitansi
            </a>
        </div>
    </div>
</div>
@endif
@endif
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body pb-0">
                <div class="row">
                    <div class="col-12 col-lg-6">
                        <h4>
                            Nomor Sales Order:
                        </h4>
                    </div>
                    <div class="col-12 col-lg-6">
                        <div class="float-right">
                            @if($sale->no_so != null)
                            <h4 class="font-weight-bold">
                                <span class="badge badge-success">Disetujui</span>
                                #{{ $sale->no_so }}
                            </h4>
                            @else
                            <span class="badge badge-danger">Belum disetujui oleh finance</span>
                            @if (auth()->user()->role == 'admin' || auth()->user()->role == 'finance')
                            <a href="{{ url('sales-orders/'.$sale->id.'/payment') }}"
                                class="btn btn-warning btn-sm text-dark"> <i class="fa fa-info-circle"></i> Approve
                                Request
                            </a>
                            @endif
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-lg-6">
                        <h5>Nomor Quotation:</h5>
                    </div>
                    <div class="col-12 col-lg-6">
                        <div class="float-right">
                            <h5 class="font-weight-bold">#{{ $sale->quotation_id }}</h5>
                        </div>
                    </div>
                </div>
                @if($sale->no_so != null)
                <div class="row">
                    <div class="col-12 col-lg-6">
                        <h5>Status Pengiriman:</h5>
                    </div>
                    <div class="col-12 col-lg-6">
                        <div class="float-right">
                            <div class="d-flex align-items-center">

                                @if($sale->delivery)
                                <h5 class="font-weight-bold text-success">Terkirim</h5>
                                <a href="{{ url('sales-orders/'.$sale->id.'/delivery-orders') }}"
                                    class="btn btn-success btn-sm mb-3 ml-3">Cek Detail Pengiriman</a>
                                @else
                                <h5 class="font-weight-bold text-danger">Belum Dikirim</h5>
                                <a href="{{ url('sales-orders/'.$sale->id.'/delivery-orders') }}"
                                    class="btn btn-dark btn-sm mb-3 ml-3">Buat Delivery Order</a>
                                {{-- <form action="{{ url('sales-orders/'.$sale->id.'/delivery-status/change') }}"
                                method="POST"
                                class="mt-4">
                                @csrf
                                <div class="d-flex align-items-center pt-1">
                                    <div class="custom-control custom-checkbox mb-3 float-right">
                                        <input type="checkbox" name="delivery_status" class="custom-control-input"
                                            id="deliveryCheck">
                                        <label class="custom-control-label" for="deliveryCheck">
                                            Terkirim
                                        </label>
                                    </div>
                                    <button type="submit" class="btn btn-success btn-sm ml-3 mb-3" id="deliveryBtn"
                                        disabled>Ubah Status
                                        Pengiriman</button>
                                </div>
                                </form> --}}
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
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
                        {{ $sale->note ?? '-' }}
                    </div>
                </div>

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
                            {{ $details->qty }} pcs
                        </td>
                        <td>
                            <div class="float-right">
                                Rp{{ number_format($details->price, 0, ',', '.') }},00
                            </div>
                        </td>
                        <td>
                            {{ $details->discount}}%
                        </td>
                        <td>
                            <div class="float-right">
                                Rp{{ number_format($details->total, 0, ',', '.')}},00
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="5">
                            <div class="float-right">
                                Jumlah Barang:
                            </div>
                        </th>
                        <th>
                            <div class="float-right">
                                {{ $sale->details()->sum('qty') }} pcs
                            </div>
                        </th>
                    </tr>
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

<div class="row">
    <div class="col-lg-12">
        <div class="row">
            <!-- <div class="col-lg-6">
                <a href="{{ url('sales-orders/'.$sale->id.'/pdf/quotation') }}" class="btn btn-dark btn-block my-2"> Print Quotation</a>
            </div> -->
            <div class="col-lg-6">
                <form action="{{ url("sales-orders/$sale->id/pdf/invoice") }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="form-group col-10">
                            @if(Gate::allows('isFinance') || Gate::allows('isAdmin'))
                            <input type="submit" name="" class="btn btn-success btn-block my-2" value="Print SO">
                            <div class="custom-control custom-checkbox col-2 my-2">
                                <input type="checkbox" name="markup" class="custom-control-input" id="defaultCheck1">
                                <label class="custom-control-label" for="defaultCheck1">
                                    PPN
                                </label>
                            </div>
                            @elseif(Gate::allows('isSales'))
                            <input type="submit" name="" class="btn btn-success btn-block my-2" value="Print SO">
                            <div class="custom-control custom-checkbox col-2 my-2">
                                <input type="checkbox" name="markup" class="custom-control-input" id="defaultCheck1">
                                <label class="custom-control-label" for="defaultCheck1">
                                    PPN
                                </label>
                            </div>
                            @endif
                        </div>

                    </div>
                </form>
            </div>
            {{-- @if($flag != count($sale->details)) --}}
            @if(Gate::allows('isGudang') || Gate::allows('isAdmin'))

            <div class="col-lg-12">
                <a href="{{ url("sales-orders/$sale->id/delivery-orders") }}" class="btn btn-secondary btn-block">
                    Buat Surat Jalan
                </a>
            </div>
            @endif
            {{-- @endif --}}
        </div>
    </div>
</div>
@endsection
