@extends('layouts.carbon')

@section('title', 'Surat Jalan' . $sale->quotation_id .' - '. $sale->created_at)


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

@section('content')
<div class="row">
  <div class="col-lg-12">
    <div class="d-flex justify-content-between">
      <div>
        <h2><b>Quotation Order #{{ $sale->quotation_id }}</b></h2>
      </div>
      <div>
        <a href="{{ url('sales-orders/'.$sale->id.'/edit') }}" class="btn btn-secondary mr-3">
          Edit
        </a>
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
            {{ $sale->no_so }}
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
              <th>Kirim</th>
            </tr>
          </thead>
          <tbody>
           @php 
           $flag = 0
           @endphp
            <form method="post" action="{{ url("sales-orders/$sale->id/delivery-orders") }}">
              @foreach($sale->details as $details)
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
                <td><label class="switch">
                  <input type="checkbox" name="{{"approve-".$details->id }}" @if($details->status==1) checked="on" disabled="" {{ $flag++ }} @endif>
                  <span class="slider"></span>
                </label>
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
  <div class="col-lg-6">

  </div>
  <div class="col-lg-6">
    <input type="hidden" name="count" value="{{ count($sale->details) }}">
    @if($flag != count($sale->details))
    <input type="submit" class="form-control btn btn-success" value="Create Delivery Order">
    @endif
    @csrf
  </form>
</div>
</div>

@endsection