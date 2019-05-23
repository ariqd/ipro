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

input:checked + .slider {
  background-color: #2196F3;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
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
{{--@include('layouts.ajax', ['size' => 'lg'])--}}
<div class="loading">
  <i class="fas fa-sync fa-spin fa-2x fa-fw"></i><br/>
  <span>Loading</span>
</div>
<div class="container">
  <div class="row">
    <div class="col-lg-12">
      @include("layouts.feedback")
      <div class="d-flex justify-content-between">
        <div>
          <h2>
            {{--Buat Purchase Order Baru--}}
            <small>
              <a href="{{ url('purchase-orders') }}" class="text-dark">Purchase Orders</a> /
            </small>
            <b>Show</b>
          </h2>
        </div>
      </div>
    </div>
  </div>


  <div class="row">
    <div class="col-lg-6">
      <div class="form-group row">
        <label for="payment_method" class="col-4 col-form-label">Purchase Order ID</label>
        <div class="col-7">
          <input disabled="" type="text" class="form-control" id="customer" name="po_order" value="{{ $header->purchase_number }}">
        </div>
      </div>
    </div>
    <div class="col-lg-6 d-none">
      <div class="form-group row">
        <label for="payment_method" class="col-4 col-form-label">Sales Order ID</label>
        <div class="col-7">
          <input type="text" autocomplete="off" onchange="searchSales()" class="form-control" id="salesorderid" name="so_order">
        </div>
      </div>
    </div>
  </div>
  <div class="row">

    <div class="col-lg-12">
      <h4>List PO</h4>
      <div class="table-responsive">
        <table class="table table-bordered table-light">
          <thead>
            <tr>
              <th>No.</th>
              <th>Kategori</th>
              <th>Kode Barang</th>
              <th>Item</th>
              <th>Berat/pcs</th>
              <th>Order Qty/pcs</th>
              <th>Approval Qty/pcs</th>              
              <th>Price/pcs</th>
              <th>Total Amount (IDR)</th>
              @if(Gate::allows('isFinance'))
              <th>Approve</th>
              @endif
            </tr>
          </thead>
          <tbody id="purchase-body">
            <form action="{{ url("purchase-orders/$header->id/approve") }}" method="post">
              @csrf
              @foreach($line as $key)

              <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $key->item->category->brand->name }} {{ $key->item->category->name }}</td>
                <td>{{ $key->item->code }}</td>
                <td>{{ $key->item->name }}</td>
                <td>{{ $key->item->weight }}</td>
                <td>{{ $key->qty }}</td>
                @if(Gate::allows('isFinance') || Gate::allows('isAdmin'))
                @if($key->approval_finance > 1)
                <td><input type="number" min="1" max="{{ $key->qty }}" value="{{ $key->qty }}" name="{{ "qty-".$key->id }}" class="form-control"></td>
                @else
                <td>{{ $key->qty_approval }}</td>
                @endif
                @else
                <td>{{ $key->qty_approval }}</td>
                @endif
                <td>{{ $key->purchase_price }}</td>
                <td>{{ $key->total_price }}</td>
                @if(Gate::allows('isFinance') || Gate::allows('isAdmin'))
                <td><label class="switch">
                  <input  @if($key->approval_finance == 0)  @else checked="" @endif type="checkbox" name="{{"approve-".$key->id }}">
                  <span class="slider"></span>
                </label>
              </td>
              @endif
            </tr>
            @endforeach

          </tbody>
        </table>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-6">

    </div>
    <div class="col-lg-6">
      @if(Gate::allows('isFinance'))
      @if($header->approval_status == 0)
      <input type="submit" class="form-control btn btn-success" value="Create Purchase Order">
      @endif
      @endif
    </form>
  </div>
</div>
@endsection
