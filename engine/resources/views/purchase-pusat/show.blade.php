@extends('layouts.carbon')

@section('title', 'Purchase Order')

@push("css")
<style>
    .loading {
        background: lightgrey;
        padding: 15px;
        position: fixed;
        border-radius: 4px;
        left: 50%;
        top: 50%;
        text-align: center;
        margin: -40px 0 0 -50px;
        z-index: 2000;
        display: none;
    }

    /* The switch - the box around the slider */
    .switch {
        position: relative;
        display: inline-block;
        width: 60px;
        height: 34px;
    }

    /* Hide default HTML checkbox */
    .switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    /* The slider */
    .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        -webkit-transition: .4s;
        transition: .4s;
    }

    .slider:before {
        position: absolute;
        content: "";
        height: 26px;
        width: 26px;
        left: 4px;
        bottom: 4px;
        background-color: white;
        -webkit-transition: .4s;
        transition: .4s;
    }

    input:checked+.slider {
        background-color: #2196F3;
    }

    input:focus+.slider {
        box-shadow: 0 0 1px #2196F3;
    }

    input:checked+.slider:before {
        -webkit-transform: translateX(26px);
        -ms-transform: translateX(26px);
        transform: translateX(26px);
    }

    /* Rounded sliders */
    .slider.round {
        border-radius: 34px;
    }

    .slider.round:before {
        border-radius: 50%;
    }

</style>
@endpush

@push("js")
@endpush

@section('content')
<div class="loading">
    <i class="fas fa-sync fa-spin fa-2x fa-fw"></i><br />
    <span>Loading</span>
</div>
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            @include("layouts.feedback")
            <div class="d-flex justify-content-between">
                <div>
                    <h2>
                        <small>
                            <a href="{{ url('purchase-orders') }}" class="text-dark">Purchase Orders</a> /
                        </small>
                        <b>Detail</b>
                    </h2>
                </div>
                <div>
                    <a href="{{ url('purchase-orders') }}" class="btn btn-light"><i class="fa fa-arrow-left"></i>
                        Purchase Orders</a>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group row">
                <label for="payment_method" class="col-4 col-form-label">Purchase Order ID</label>
                <div class="col-7">
                    <input disabled="" type="text" class="form-control" id="customer" name="po_order"
                        value="{{ $header->purchase_number }}">
                </div>
            </div>
        </div>
        <div class="col-lg-6 d-none">
            <div class="form-group row">
                <label for="payment_method" class="col-4 col-form-label">Sales Order ID</label>
                <div class="col-7">
                    <input type="text" autocomplete="off" onchange="searchSales()" class="form-control"
                        id="salesorderid" name="so_order">
                </div>
            </div>
        </div>
    </div>
    <form action="{{ url("purchase-orders/$header->id/approve") }}" method="post">
        <div class="row">
            <div class="col-lg-12">
                <h4>List PO</h4>
                <div class="table-responsive">
                    <table class="table table-hover table-light border">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Produk</th>
                                <th>Berat/pcs</th>
                                <th>Order Qty/pcs</th>
                                {{-- <th>Approved Qty/pcs</th> --}}
                                {{-- <th>Total Amount (IDR)</th> --}}
                                {{-- @if(Gate::allows('isFinance') || Gate::allows('isAdmin'))
                                <th>Approve</th>
                                @endif --}}
                            </tr>
                        </thead>
                        <tbody id="purchase-body">
                            @csrf
                            @foreach($line as $key)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <small class="text-secondary">{{ $key->item->category->brand->name }} -
                                        {{ $key->item->category->name }}</small> <br>
                                    {{ $key->item->code }} - {{ $key->item->name }}
                                </td>
                                <td>{{ $key->item->weight }} Kg</td>
                                <td>{{ $key->qty }} pcs</td>
                                {{-- <td>
                                    <div class="input-group">
                                        <input type="number" min="1" max="{{ $key->qty }}"
                                            value="{{ $key->approval_finance >= 1 ? $key->qty_approval : 1 }}"
                                            name="{{ "qty-".$key->id }}" class="form-control"
                                            {{ Gate::allows('isFinance') || Gate::allows('isAdmin') ? '' : 'disabled' }}>
                                        <div class="input-group-append">
                                            <span class="input-group-text">pcs</span>
                                        </div>
                                    </div>
                                </td> --}}
                                {{-- <td class="text-right">Rp{{ number_format($key->total_price, 0, ',', '.') }}</td> --}}
                                {{-- @if(Gate::allows('isFinance') || Gate::allows('isAdmin'))
                                <td>
                                    <label class="switch">
                                        <input @if($key->approval_finance == 0) @else checked=""
                                        @endif type="checkbox" name="{{"approve-".$key->id }}">
                                        <span class="slider"></span>
                                    </label>
                                </td>
                                @endif --}}
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="2">
                                    <div class="float-right">
                                        <b>Total</b>
                                    </div>
                                </td>
                                <td>
                                    {{ $total_weight }} Kg
                                </td>
                                <td>
                                    {{ $total_qty }} pcs
                                </td>
                                {{-- <td>
                                    {{ $total_qty_approved }} pcs
                                </td> --}}
                                {{-- <td class="text-right">
                                    Rp{{ number_format($total_amount, 0, ',', '.') }}
                                </td> --}}
                                {{-- <td></td> --}}
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">

            </div>
            <div class="col-lg-6">
                @if(Gate::allows('isFinance') || Gate::allows('isAdmin'))
                @if($header->approval_status == 0)
                <input type="submit" class="form-control btn btn-success" value="Approve & Create Purchase Order"
                    name="button">
                @else
                <input type="submit" class="form-control btn btn-warning" value="Update Approve" name="button">
                @endif
                @endif
            </div>
        </div>
    </form>
</div>
@endsection
