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
</style>
@endpush

@push("js")
<script>
   var count = 0;

   $("#brands").select2({
    placeholder: "Choose Brand"
});
   $("#brands").change(function () {
    var id = $("#brands").val();

    $("#categories").select2({
        selectOnClose: true,
        placeholder: 'Choose Category',
        ajax: {
            url: "{!! url("categories/search") !!}/" + id,
            dataType: 'json',
            delay: 600,
            processResults: function (data) {

                return {
                    results: $.map(data, function (item) {

                        return {
                            text: item.name,
                            id: item.id

                        }
                    })
                };
            },
            cache: true
        }
    });

});

   $("#categories").change(function () {
    var id = $("#categories").val();

    $("#items").select2({
        selectOnClose: true,
        placeholder: 'Choose Item',
        ajax: {
            url: "{!! url("items/search") !!}/" + id,
            dataType: 'json',
            delay: 600,
            processResults: function (data) {

                return {
                    results: $.map(data, function (item) {

                        return {
                            text: item.name,
                            id: item.id

                        }
                    })
                };
            },
            cache: true
        }
    });

});

   function searchSales(){
      $.ajax({
        url: "{!! url("sales-orders/search") !!}/" + $("#salesorderid").val(),
        method: "get",
        success: function (response) {
         $("#purchase-body").empty()
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
            cell0.setAttribute('class', "form_id");
            cell8.setAttribute('class', "subtotal");

            cell1.innerHTML = value.category.name;
            cell2.innerHTML = value.item.code;
            cell3.innerHTML = value.item.name;
            cell4.innerHTML = value.item.weight;
            cell5.innerHTML = value.qty;
            cell6.innerHTML = value.item.purchase_price;
            cell7.innerHTML = value.total;
            cell8.innerHTML = '<button onclick=voidItem("item-'+count+'") class="btn btn-dark" type="button"/>';

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

            count++;
        });
         updateRowOrder();

     },
     error: function (xhr, statusCode, error) {
     }
 });
  }

  function voidItem(id){
    $("."+id).remove();
    updateRowOrder();
}
</script>)

<script>
    $(document).on('keypress', function (e) {
        if (e.which == 13) {
            e.preventDefault();
            if ($("#qty").val() == 0 || !(/^\d*$/.test($("#qty").val()))) {
                alert('Mohon masukan angka yang sesuai!');
            } else {
                var id = $("#items").val();
                $.ajax({
                    url: "{!! url("items/search/detail") !!}/" + id,
                    method: "get",
                    success: function (response) {
                        console.dir(response);
                        var table = document.getElementById("purchase-body");
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
                        cell0.setAttribute('class', "form_id");
                        cell8.setAttribute('class', "subtotal");

                        cell1.innerHTML = response.item.category.name;
                        cell2.innerHTML = response.item.code;
                        cell3.innerHTML = response.item.name;
                        cell4.innerHTML = response.item.weight;
                        cell5.innerHTML = $("#qty").val();
                        cell6.innerHTML = response.item.purchase_price;
                        cell7.innerHTML = $("#qty").val()*response.item.purchase_price;
                        cell8.innerHTML = '<button onclick=voidItem("item-'+count+'") class="btn btn-dark" type="button"/>';

                        var container = document.getElementById("input-body");
                        var input = document.createElement("input");
                        input.type = "hidden";
                        input.name = "item-id[]";
                        input.setAttribute('value', response.item.id);
                        input.setAttribute('class', "item-"+count);
                        container.appendChild(input);

                        var input = document.createElement("input");
                        input.type = "hidden";
                        input.name = "qty[]";
                        input.setAttribute('value', $("#qty").val());
                        input.setAttribute('class', "item-"+count);
                        container.appendChild(input);
                        count++;
                        updateRowOrder();

                    },
                    error: function (xhr, statusCode, error) {
                    }
                });
            }
        }
    });
</script>


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
        <div class="col-lg-4 d-none">
           {{--  <h4>Cari Item</h4>
            <div class="form-group">
                Brand
                <select autocomplete="off" name="brand" id="brands" class="form-control brands">
                    <option value="" selected disabled></option>
                    @foreach($brands as $brand)
                    <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                Category
                <select autocomplete="off" name="category" id="categories" class="form-control categories">
                    <option value="" selected disabled></option>
                    @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                Item
                <select autocomplete="off" name="items" id="items" class="form-control items">
                    <option value="" selected disabled></option>
                    //@foreach($categories as $category)
                    //<option value="{{ $category->id }}">{{ $category->name }}</option>
                    //@endforeach
                </select>
            </div>
            <div class="form-group">
                Quantity
                <input type="number" class="form-control" step="1" id="qty">
            </div> --}}
        </div>
        <div class="col-lg-12">
            <h4>List PO</h4>
            {{--<div class="card">--}}
                {{--<div class="card-body">--}}

                {{--</div>--}}
            {{--</div>--}}
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
                        </tr>
                    </thead>
                    <tbody id="purchase-body">
                        @foreach($line as $key)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $key->item->category->brand->name }} {{ $key->item->category->name }}</td>
                            <td>{{ $key->item->code }}</td>
                            <td>{{ $key->item->name }}</td>
                            <td>{{ $key->item->weight }}</td>
                            <td>{{ $key->qty }}</td>
                            <td>{{ $key->purchase_price }}</td>
                            <td>{{ $key->total_price }}</td>
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
        {{-- <div class="col-lg-6">
            <form action="{{url("/purchase-orders")}}" method="POST">
                @csrf
                <div id="input-body">

                </div>
                <input type="submit" class="form-control btn btn-success" value="Create Purchase Order">
            </form>
        </div> --}}
    </div>
</div>
@endsection
