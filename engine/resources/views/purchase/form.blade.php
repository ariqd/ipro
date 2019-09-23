@extends('layouts.carbon')

@section('title', 'Purchase Orders')

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
    $("#salesorderid").select2({
        placeholder: "Pilih Nomor Sales Order"
    });
    $("#brands").select2({
        placeholder: "Pilih Brand"
    });
    $("#brands").change(function () {
        var id = $("#brands").val();

        $("#categories").select2({
            selectOnClose: true,
            placeholder: 'Pilih Kategori',
            ajax: {
                url: "{!! url('categories/search') !!}/" + id,
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
                url: "{!! url('items/search') !!}/" + id,
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

    $("#items").change(function(){
        $.ajax({
            url: "{!! url('items/search/detail') !!}/" + $("#items").val(),
            method: "get",
            success: function (response) {
                $("#modal").val(response.item.purchase_price);
            },
            error: function (xhr, statusCode, error) {}
        });
    })


    $("#salesorderid").change(function () {
        $.ajax({
            url: "{!! url('sales-orders/search') !!}/" + $("#salesorderid").val(),
            method: "get",
            success: function (response) {
                var table = document.getElementById("purchase-body");
                $(response.detail).each(function (key, value) {
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
                    cell0.setAttribute('class', "form_id");
                    cell6.setAttribute('class', "subtotal");

                    cell1.innerHTML = value.category.name;
                    cell2.innerHTML = value.item.code;
                    cell3.innerHTML = value.item.name;
                    cell4.innerHTML = '<input type="hidden" id="berat-'+count+'" value="value.item.weight">'+value.item.weight + " Kg";
                    cell5.innerHTML = '<input type="number" onchange="updateharga('+count+')" class="form-control" id="harga-'+count+'"  name="modal[]" value="'+value.item.purchase_price+'" required/>';
                    cell6.innerHTML = value.qty + ' pcs';
                    cell7.innerHTML = response.header.no_so;
                    cell8.innerHTML =
                        '<input type="number" class="form-control" id="total-harga-'+count+'" required/>';
                    cell9.innerHTML = "";
                    // '<a style="cursor:pointer" onclick=voidItem("item-' + count + '") class=""> <i class="fa fa-trash"></i> </a>';

                    var container = document.getElementById("input-body");
                    var input = document.createElement("input");
                    input.type = "hidden";
                    input.name = "item-id[]";
                    input.setAttribute('value', value.item.id);
                    input.setAttribute('class', "item-" + count);
                    container.appendChild(input);

                    var input = document.createElement("input");
                    input.type = "hidden";
                    input.name = "qty[]";
                    input.setAttribute('value', value.qty);
                    input.setAttribute('id', "qty-" + count);
                    container.appendChild(input);

                    var input = document.createElement("input");
                    input.type = "hidden";
                    input.name = "sales[]";
                    input.setAttribute('value', response.header.id);
                    input.setAttribute('class', "sales-" + count);
                    container.appendChild(input);

                    count++;

                        jmlhitem++;
                        jmlhberat += value.item.weight * value.qty;
                        jmlhqty += parseInt(value.qty);

                        //tambah footer
                        $("#jmlh-item").text(jmlhitem);
                        $("#jmlh-berat").text(jmlhberat);
                        $("#jmlh-qty").text(jmlhqty);
                });
                updateRowOrder();

            },
            error: function (xhr, statusCode, error) {}
        });
    });


    function voidItem(id) {
        //cek
        console.log("Berat "+$("#berat-"+id).val());
        console.log("Berat "+$("#berat-"+id).val());

        $("." + id).remove();
        updateRowOrder();
    }

    function updateharga(count){
        jmlhamount -= $('#total-harga-'+count).val() / $('#qty-'+count).val();

        var hargalama = $('#total-harga-'+count).val();
        jmlhharga -= hargalama

        var harga = $('#harga-'+count).val() * $('#qty-'+count).val()
        $('#total-harga-'+count).val(harga);

        jmlhharga += harga;
        jmlhamount += parseInt($('#harga-'+count).val());
        $("#jmlh-harga").text(jmlhharga);
        $("#jmlh-amount").text(jmlhamount);

    }

    //setvariableuntukfooter
    var jmlhitem = 0;
    var jmlhberat = 0;
    var jmlhqty = 0;
    var jmlhamount = 0;
    var jmlhharga = 0;

    $(document).on('keypress', function (e) {
        if (e.which == 13) {
            e.preventDefault();
            if ($("#qty").val() == 0 || !(/^\d*$/.test($("#qty").val()))) {
                alert('Mohon masukan angka yang sesuai!');
            } else {
                var id = $("#items").val();
                $.ajax({
                    url: "{!! url('items/search/detail') !!}/" + id,
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
                        // var cell6 = row.insertCell(6);
                        var cell6 = row.insertCell(6);
                        var cell7 = row.insertCell(7);
                        var cell8 = row.insertCell(8);
                        var cell9 = row.insertCell(9);
                        cell0.setAttribute('class', "form_id");
                        cell7.setAttribute('class', "subtotal");

                        cell1.innerHTML = response.item.category.name;
                        cell2.innerHTML = response.item.code;
                        cell3.innerHTML = response.item.name;
                        cell4.innerHTML = '<input type="hidden" id="berat-'+count+'" value="response.item.weight">'+response.item.weight + " Kg";
                        // cell6.innerHTML = "Rp " + number_format(response.item.purchase_price);
                        cell5.innerHTML = "Rp "+ number_format($("#modal").val(), 0, ',', '.');
                        cell6.innerHTML = $("#qty").val() + ' pcs';
                        cell7.innerHTML = "";
                        cell8.innerHTML = "Rp " + number_format($("#qty").val() * $("#modal").val(), 0, ',', '.');
                        cell9.innerHTML = "";
                        // '<a style="cursor:pointer" onclick=voidItem("item-' + count + '") class=""> <i class="fa fa-trash"></i> </a>';

                        var container = document.getElementById("input-body");
                        var input = document.createElement("input");
                        input.type = "hidden";
                        input.name = "item-id[]";
                        input.setAttribute('value', response.item.id);
                        input.setAttribute('class', "item-" + count);
                        container.appendChild(input);

                        var container = document.getElementById("input-body");
                        var input = document.createElement("input");
                        input.type = "hidden";
                        input.name = "modal[]";
                        input.setAttribute('value', $("#modal").val());
                        input.setAttribute('id', "harga-" + count);
                        container.appendChild(input);

                        var input = document.createElement("input");
                        input.type = "hidden";
                        input.name = "qty[]";
                        input.setAttribute('value', $("#qty").val());
                        input.setAttribute('id', "qty-" + count);
                        container.appendChild(input);
                        count++;
                        updateRowOrder();

                        jmlhitem++;
                        jmlhharga += $("#modal").val() * $("#qty").val();
                        jmlhberat += response.item.weight * $("#qty").val();
                        jmlhqty += parseInt($("#qty").val());
                        jmlhamount += parseInt($("#modal").val());
                        //tambah footer
                        $("#jmlh-item").text(jmlhitem);
                        $("#jmlh-berat").text(jmlhberat);
                        $("#jmlh-qty").text(jmlhqty);
                        $("#jmlh-harga").text(jmlhharga);
                        $("#jmlh-amount").text(jmlhamount);
                    },
                    error: function (xhr, statusCode, error) {}
                });
            }
        }
    });

    function number_format(number, decimals, decPoint, thousandsSep) {
        number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
        var n = !isFinite(+number) ? 0 : +number;
        var prec = !isFinite(+decimals) ? 0 : Math.abs(decimals);
        var sep = (typeof thousandsSep === 'undefined') ? ',' : thousandsSep;
        var dec = (typeof decPoint === 'undefined') ? '.' : decPoint;
        var s = '';

        var toFixedFix = function (n, prec) {
            var k = Math.pow(10, prec);
            return '' + (Math.round(n * k) / k)
                .toFixed(prec)
        };

        s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
        if (s[0].length > 3) {
            s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep)
        }
        if ((s[1] || '').length < prec) {
            s[1] = s[1] || '';
            s[1] += new Array(prec - s[1].length + 1).join('0')
        }

        return s.join(dec)
    }

</script>
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
                        {{-- <small>
                            <a href="{{ url('purchase-orders') }}" class="text-dark">Purchase Orders</a> /
                        </small> --}}
                        <b>Buat Purchase Order Baru</b>
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
                        value="{{ $no_po }}">
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group row">
                <label for="payment_method" class="col-4 col-form-label">Sales Order ID</label>
                <div class="col-7">
                    {{-- <input type="text" autocomplete="off" onchange="searchSales()" class="form-control" id="salesorderid" name="so_order"> --}}
                    <select autocomplete="off" name="so_order" id="salesorderid" class="form-control brands w-100">
                        <option value="" selected disabled></option>
                        @foreach($sales as $sale)
                        <option value="{{ $sale->no_so}}">{{ $sale->no_so }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <h4><b># Tambah Produk</b></h4>
        </div>
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="form-row">
                        <div class="form-group col-lg-6">
                            <label for="brands">Brand</label>
                            <select autocomplete="off" name="brand" id="brands" class="form-control brands w-100">
                                <option value="" selected disabled></option>
                                @foreach($brands as $brand)
                                <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-lg-6">
                            <label for="categories">Category</label>
                            <select autocomplete="off" name="category" id="categories" class="form-control categories">
                                <option value="" selected disabled></option>
                                @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-lg-12">
                            <label for="items">Produk</label>
                            <select autocomplete="off" name="items" id="items" class="form-control items">
                                <option value="" selected disabled></option>
                                {{--@foreach($categories as $category)--}}
                                {{--<option value="{{ $category->id }}">{{ $category->name }}</option>--}}
                                {{--@endforeach--}}
                            </select>
                        </div>
                        <br>
                        <div class="form-group col-lg-6">
                            <label for="modal">Modal satuan</label>
                            <input type="number" class="form-control" step="1" min="0" id="modal">
                        </div>
                        <div class="form-group col-lg-6">
                            <label for="qty">Quantity</label>
                            <input type="number" class="form-control" step="1" min="0" id="qty">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <form action="{{url("/purchase-orders")}}" method="POST">
                @csrf
                <h4><b># Cart</b></h4>
                <div class="card">
                    <div class="table-responsive">
                        <table class="table table-hover table-light m-0">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Kategori</th>
                                    <th>Kode Barang</th>
                                    <th>Item</th>
                                    <th>Berat/pcs</th>
                                    <th>Harga/pcs</th>
                                    <th>Order Qty/pcs</th>
                                    {{-- <th>Price/pcs</th> --}}
                                    <th>No. Sales</th>
                                    <th>Harga Total</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody id="purchase-body">
                                <tr>

                                </tr>
                            </tbody>
                            <tfoot>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th id="jmlh-item">Item</th>
                                <th id="jmlh-berat">Berat/pcs</th>
                                <th id="jmlh-amount">Total Amount (IDR)</th>
                                <th id="jmlh-qty">Order Qty/pcs</th>
                                <th></th>
                                <th id="jmlh-harga">Harga PO</th>
                                <th></th>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <div id="input-body">
                </div>
                <input type="submit" class="btn btn-success float-right" value="Buat Purchase Order">
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">

        </div>
        <div class="col-lg-6">
        </div>
    </div>
</div>
@endsection
