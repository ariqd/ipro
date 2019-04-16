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

        // $("#items").select2({
        //     placeholder: "Choose Item"
        // });

        function searchSales(){
          $.ajax({
            url: "{!! url("sales-orders/search") !!}/" + $("#salesorderid").val(),
            method: "get",
            success: function (response) {
             $("#purchase-body").empty()
             var table = document.getElementById("purchase-body");
             $(response.detail).each(function(key,value) {
                console.dir(value);
                var row = table.insertRow();
                            // row.setAttribute('id', 'row' + count);
                            var cell0 = row.insertCell(0);
                            var cell1 = row.insertCell(1);
                            var cell2 = row.insertCell(2);
                            var cell3 = row.insertCell(3);
                            var cell4 = row.insertCell(4);
                            var cell5 = row.insertCell(5);
                            var cell6 = row.insertCell(6);
                            var cell7 = row.insertCell(7);

                            // cell0.setAttribute('class', "form_id");
                            cell0.innerHTML = value.category.name;
                            cell1.innerHTML = value.item.code;
                            cell2.innerHTML = value.item.name;
                            cell3.innerHTML = value.item.weight;
                            cell4.innerHTML = value.qty;
                            cell5.innerHTML = value.item.purchase_price;
                            cell6.innerHTML = value.total;
                            cell7.innerHTML = "";

                            var container = document.getElementById("input-body");
                            var input = document.createElement("input");
                            input.type = "hidden";
                            input.name = "item-id[]";
                            input.setAttribute('value', value.item.id);
                            container.appendChild(input);

                            var input = document.createElement("input");
                            input.type = "hidden";
                            input.name = "qty[]";
                            input.setAttribute('value', value.qty);
                            container.appendChild(input);
                        });
         },
         error: function (xhr, statusCode, error) {
         }
     });
      }

  </script>

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
                        var table = document.getElementById("purchase-body");
                        var row = table.insertRow();
                            // row.setAttribute('id', 'row' + count);
                            var cell0 = row.insertCell(0);
                            var cell1 = row.insertCell(1);
                            var cell2 = row.insertCell(2);
                            var cell3 = row.insertCell(3);
                            var cell4 = row.insertCell(4);
                            var cell5 = row.insertCell(5);
                            var cell6 = row.insertCell(6);

                            // cell0.setAttribute('class', "form_id");
                            cell0.innerHTML = response.catname;
                            cell1.innerHTML = response.code;
                            cell2.innerHTML = response.name;
                            cell3.innerHTML = response.weight;
                            cell4.innerHTML = $("#qty").val();
                            cell5.innerHTML = response.purchase_price;
                            cell6.innerHTML = response.purchase_price * $("#qty").val();

                            var container = document.getElementById("input-body");
                            var input = document.createElement("input");
                            input.type = "hidden";
                            input.name = "item-id[]";
                            input.setAttribute('value', response.id);
                            container.appendChild(input);

                            var input = document.createElement("input");
                            input.type = "hidden";
                            input.name = "qty[]";
                            input.setAttribute('value', $("#qty").val());
                            container.appendChild(input);

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
            <div class="d-flex justify-content-between">
                <div>
                    <h2>
                        {{--Buat Purchase Order Baru--}}
                        <small>
                            <a href="{{ url('purchase-orders') }}" class="text-dark">Purchase Orders</a> /
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
                    <input disabled="" type="text" class="form-control" id="customer" name="po_order" value="{{ $no_po }}">
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group row">
                <label for="payment_method" class="col-4 col-form-label">Sales Order ID</label>
                <div class="col-7">
                    <input type="text" autocomplete="off" onchange="searchSales()" class="form-control" id="salesorderid" name="so_order">
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4">
            <h4>Cari Item</h4>
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
                    {{--@foreach($categories as $category)--}}
                    {{--<option value="{{ $category->id }}">{{ $category->name }}</option>--}}
                    {{--@endforeach--}}
                </select>
            </div>
            <div class="form-group">
                Quantity
                <input type="number" class="form-control" step="1" id="qty">
            </div>
        </div>
        <div class="col-lg-8">
            <h4>Cart</h4>
            {{--<div class="card">--}}
                {{--<div class="card-body">--}}

                {{--</div>--}}
            {{--</div>--}}
            <div class="table-responsive">
                <table class="table table-bordered table-light">
                    <thead>
                        <tr>
                            <th>Kategori</th>
                            <th>Kode Barang</th>
                            <th>Item</th>
                            <th>Berat/pcs</th>
                            <th>Order Qty/pcs</th>
                            <th>Price/pcs</th>
                            <th>Total Amount (IDR)</th>
                            <th>GR Code</th>
                        </tr>
                    </thead>
                    <tbody id="purchase-body">
                        <tr>
                            <td>-</td>
                            <td>-</td>
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
