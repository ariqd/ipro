@extends('layouts.carbon')

@section('title', 'Goods Receive')

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
</style>
@endpush

@push("js")
<script type="text/javascript">
    $("#purchaseid").select2();
</script>
@endpush

@section('content')
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
                        <small>
                            <a href="{{ url('goods-receive') }}" class="text-dark">Goods Receive</a> /
                        </small>
                        <b>Create</b>
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
                   <select autocomplete="off" name="purchase_id" id="purchaseid" class="form-control brands w-100">
                    @foreach($purchase as $key)
                    <option value="{{ $key->id }}" >{{ $key->purchase_number }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="form-group row">
            <label for="payment_method" class="col-4 col-form-label">Receipt ID</label>
            <div class="col-7">
                <input type="text" class="form-control" id="customer" name="receipt" value="">
            </div>
        </div>
    </div>

</div>
<div class="row">

    <div class="col-lg-12">
        <h4>Cart</h4>
        <div class="card">
            <div class="card-body">
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
                                <th>Price/pcs</th>
                                <th>Total Amount (IDR)</th>
                                <th>No Sales</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody id="purchase-body">
                            <tr>

                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>
<div class="row">
    <div class="col-lg-6">

    </div>
    <div class="col-lg-6">
        <form action="{{url("/purchase-orders")}}" method="POST">
            @csrf
            <div id="input-body">

            </div>
            <input type="submit" class="form-control btn btn-success" value="Create Purchase Order">
        </form>
    </div>
</div>
</div>
@endsection
