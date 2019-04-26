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
    $("#purchaseid").select2({
        placeholder:"Choose PO"
    });
</script>

<script type="text/javascript">
    count = 0;
    $("#purchaseid").change(function(){
        $("#purchase-body").empty();
        $.ajax({
            url: "{!! url("purchase-orders/") !!}/" + $("#purchaseid").val()+"/search",
            method: "get",
            success: function (response) {
             var table = document.getElementById("purchase-body");
             $(response.detail).each(function(key,value) {
                var row = table.insertRow();
                row.setAttribute('class', 'item-' + count);
                var cell0 = row.insertCell(0);
                var cell1 = row.insertCell(1);
                var cell2 = row.insertCell(2);
                var cell3 = row.insertCell(3);
                var cell4 = row.insertCell(4);
                var cell5 = row.insertCell(5);
                var cell6 = row.insertCell(6);
                var cell7 = row.insertCell(7);
                var cell8 = row.insertCell(8);
                var cell9 = row.insertCell(9);
                var cell10 = row.insertCell(10);
                cell0.setAttribute('class', "form_id");
                cell7.setAttribute('class', "subtotal");

                cell1.innerHTML = value.category.name;
                cell2.innerHTML = value.item.code;
                cell3.innerHTML = value.item.name;
                cell4.innerHTML = value.item.weight;
                cell5.innerHTML = value.qty;
                cell6.innerHTML = '<input class="form-control" onchange="calculateAmmount('+count+','+value.item.purchase_price+')" id="qtyget-'+count+'" value="'+value.qty+'"></input>';
                cell7.innerHTML = value.item.purchase_price;
                cell8.innerHTML = '<input class="form-control totalammount" id="purchase-'+count+'" disabled value="'+value.total_price+'"></input>';
                if(value.sales !=null){
                    cell9.innerHTML = value.sales.no_so;                    
                }else{
                    cell9.innerHTML = "-";
                }
                cell10.innerHTML = '<button onclick=voidItem("item-'+count+'") class="btn btn-dark" type="button"/>';

                var container = document.getElementById("input-body");
                var input = document.createElement("input");
                input.type = "hidden";
                input.name = "item-id[]";
                input.setAttribute('value', value.item.id);
                input.setAttribute('class', "item-"+count);
                container.appendChild(input);

                var input = document.createElement("input");
                input.type = "hidden";
                input.name = "qty[]";
                input.setAttribute('value', value.qty);
                input.setAttribute('class', "item-"+count);
                container.appendChild(input);


                var input = document.createElement("input");
                input.type = "hidden";
                input.name = "qtyget[]";
                input.setAttribute('value', $("#qtyget-"+count).val());
                input.setAttribute('class', "item-"+count);
                container.appendChild(input);

                  var input = document.createElement("input");
                input.type = "hidden";
                input.name = "purchasedetailid[]";
                input.setAttribute('value', value.id);
                input.setAttribute('class', "item-"+count);
                container.appendChild(input);

                count++;
            });
             updateRowOrder();
             calculateTotalAmmount();

         },
         error: function (xhr, statusCode, error) {
         }
     });
    });


    function calculateAmmount(count, purchase_price){
        var total = $("#qtyget-"+count).val()*purchase_price;
        $("#purchase-"+count).val(total);
        calculateTotalAmmount();
    }

    function calculateTotalAmmount(){
        var grandtotal = 0;
        $(".totalammount").each(function(){
            grandtotal += parseInt(this.value);
        });
        $("#grandtotal").text("Rp. "+grandtotal);
    }
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
                    <option></option>
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
        <div class="col-lg-12 text-right">
            <h2>Total : <span id="grandtotal">Rp. 0,-</span><h2>
            </div>
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
                                    <th>Get Qty/pcs</th>
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
            <form action="{{url("/goods-receive")}}" method="POST">
                @csrf
                <div id="input-body">

                </div>
                <input type="submit" class="form-control btn btn-success" value="Create Goods Receive">
            </form>
        </div>
    </div>
</div>
@endsection
