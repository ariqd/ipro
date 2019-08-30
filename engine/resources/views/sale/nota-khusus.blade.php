@extends('layouts.carbon')

@section('title', 'Nota Khusus')

@push("css")
<style type="text/css">
    .modal-dialog {
        max-width: 1000px;
    }

    .card-header a,
    .card-header a:hover {
        color: #ffffff;
        font-weight: bold;
    }

    .card-header .fa {
        transition: .3s transform ease-in-out;
    }

    .card-header .collapsed .fa {
        transform: rotate(90deg);
    }

</style>
@endpush

@push("js")
<script src="{{ asset('assets/js/scripts.js') }}"></script>
<script>
    $(document).ready(function () {
        let items_count = 0;

        $("#customer_select").change(function () {
            var id = $(this).val();
            $.ajax({
                // url: '/info/' + $(this).val(),
                url: "{{ url('sales-orders/create/customer/') }}/" + id,
                type: 'get',
                data: {},
                success: function (data) {
                    if (data.success === true) {
                        $("#register_id").val(data.fill.id);
                        $("#name").val(data.fill.project_owner);
                        $("#address").val(data.fill.address);
                        $("#phone").val(data.fill.phone);
                        $("#fax").val(data.fill.fax);
                        $("#email").val(data.fill.email);
                    } else {
                        alert('Cannot find info');
                    }
                },
                error: function (jqXHR, textStatus, errorThrown) {}
            });
        });

        $(".customer").select2({
            selectOnClose: true,
            placeholder: "Pilih Customer",
            allowClear: true
        });
        @if(Gate::allows('isAdmin') || Auth::id() == 5)
        $("#sales").select2({
            selectOnClose: true,
            placeholder: "Pilih Sales"
        });
        @endif
        $("#brands").select2({
            selectOnClose: true,
            placeholder: "Pilih Brand",
            allowClear: true
        });
        $("#categories").select2({
            selectOnClose: true,
            placeholder: 'Pilih brand terlebih dahulu',
            allowClear: true
        });
        $("#branches").select2({
            selectOnClose: true,
            placeholder: 'Pilih cabang',
            allowClear: true
        });

        $("#categories").change(function () {
            $("#branches").val(null).trigger('change');
        })

        $("#brands").change(function () {
            $("#branches").val(null).trigger('change');
            $("#categories").val(null).trigger('change');
            var id = $("#brands").val();
            $("#categories").select2({
                selectOnClose: true,
                placeholder: 'Choose Category',
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

        function searchProduct() {
            items_count = 0;
            var id = $('#categories').val();
            $.ajax({
                url: '{{ url("sales-orders/create/search-stocks") }}',
                method: 'GET',
                data: {
                    category_id: id
                },
                beforeSend: function () {
                    $('.loading').show();
                    $("#items").html("");
                },
                success: function (response) {
                    $('.loading').hide();
                    // console.dir(response);
                    if (response.length > 0) {
                        $.each(response, function (index, value) {
                            var btn;
                            if (parseInt(value.quantity) > 0) {
                                if (parseInt(value.item.purchase_price) > 0) {
                                    btn =
                                        '<button type="button" class="btn btn-outline-dark addProduct-' +
                                        value.id + '  " ' +
                                        'onclick="addProduct(' + value.id +
                                        ')" title="Add to Cart"' +
                                        ' data-name="' + value.item.name + '"' +
                                        ' data-code="' + value.id + '"' +
                                        ' data-quantity="' + value.quantity + '"' +
                                        ' data-price="' + value.item.purchase_price + '"' +
                                        ' data-price-branch="' + value.price_branch + '"' +
                                        ' data-branch="' + value.branch.name + '"' +
                                        '>' +
                                        '<i class="fa fa-cart-plus"></i>' +
                                        '</button>';
                                } else {
                                    btn = '';
                                }
                            } else {
                                btn = '';
                            }
                            $("#items").append(
                                '<div class="card mb-0 item-card item-branch-' + value
                                .branch.id + ' d-none">' +
                                '<div class="card-body item">' +
                                '<div class="d-flex justify-content-between align-items-center">' +
                                '<div>' +
                                '<h5>' + value.item.name + ' (' + value.branch.name +
                                ') ' + '</h5>' +
                                '<p>Quantity: ' + value.quantity + '</p>' +
                                '<p class="m-0">Harga Pricelist: Rp' + value.item
                                .purchase_price + '</p>' +
                                '<p class="m-0">Harga Cabang: Rp' + value
                                .price_branch + '</p>' +
                                '</div>' +
                                '<div>' +
                                btn +
                                '</div>' +
                                '</div>' +
                                '</div>' +
                                '</div>'
                            );
                            items_count++;
                        });
                    } else {
                        $("#items").append(
                            '<div class="card mb-0">' +
                            '<div class="card-body item">' +
                            '<div class="d-flex justify-content-between align-items-center">' +
                            '<div>' +
                            '<h5>No item found</h5>' +
                            '</div>' +
                            '</div>' +
                            '</div>' +
                            '</div>'
                        );
                    }
                    $('#search').focus();
                },
                error: function (error) {
                    console.log(error);
                }
            });
        }

        $('#categories').change(function () {
            searchProduct();
            $("#branches").select2({
                selectOnClose: true,
                placeholder: 'Pilih cabang'
            });
        });

        $('#branches').change(function () {
            let branch_id = $(this).val();
            $('.item-card').addClass('d-none');
            if (items_count <= 0) {
                // alert('Pilih brand dan kategori lebih dulu!');
                $(this).prop('selectedIndex', 0);
            } else {
                $('.item-branch-' + branch_id).removeClass('d-none');
            }
        });
    });
    $("#case_1").change(function () {
        if ($("#case_1").val() == 2) {
            $('#sales').val('5').trigger('change');
            $('#sales').attr("read-only", "true");
        } else {
            $('#sales').attr("read-only", "false");
        }
    });

    $("#case_2").change(function () {
        $(".case4").hide();
        $(".case4").prop("disabled", true);
        $(".case3").hide();
        $(".case3").prop("disabled", true);
        let case2 = $("#case_2").val();
        if (case2 == 3) {
            $(".case3").show();
            $(".case3").prop("disabled", false);

            $(".case4").hide();
            $(".case4").prop("disabled", true);
        } else if (case2 == 4) {
            $(".case4").show();
            $(".case4").prop("disabled", false);

            $(".case3").hide();
            $(".case3").prop("disabled", true);
        } else {
            $(".case3").hide();
            $(".case3").prop("disabled", true);

            $(".case4").hide();
            $(".case4").prop("disabled", true);
        }
    });

    $('#collapse-example').on('shown.bs.collapse', function () {
        document.getElementById('detail-text').innerHTML = 'Sembunyikan';
    })
    $('#collapse-example').on('hidden.bs.collapse', function () {
        document.getElementById('detail-text').innerHTML = 'Tampilkan';
    })

</script>
@endpush

@section('content')
@include("layouts.ajax")
<form action="{{ @$edit ? url('nota-khusus-create/'.$sales->id) : url('nota-khusus-create') }}" method="post">
    @csrf
    {{ @$edit ? method_field('PUT') : '' }}
    <div class="row align-middle">
        <div class="col-12">
            <a href="{{ url('nota-khusus-create') }}" class="text-muted"><i>Sales Orders</i></a>
            <h2 class="mb-0">
                <b>{{ @$isEdit ? 'Edit' : 'Buat' }} Quotation Order</b>
            </h2>
        </div>
        <div class="col-12">
            <hr>
        </div>
        <div class="col-12">
            @include('layouts.feedback')
        </div>
    </div>
    @if(Gate::allows('isAdmin') || Auth::id() == 5)
    <div class="row mb-5">
        <div class="col-lg-12">
            <h4><b><label for="sales"># Pilih Jenis Sales Order</label></b></h4>
            <select name="case_2" id="case_2" class="form-control">
                <option value="1">By Sales (dibuat oleh Sales)</option>
                <option value="2">By Head Sales (dibuat oleh Head Sales)</option>
                <option value="3">Referral (dibuat bersama oleh Head Sales dan Sales)</option>
                <option value="4">By Admin (dibuat oleh Admin Sales)</option>
            </select>
            <div class="case3" style="display: none;">
                Referral
                <select name="sales_id" class="form-control sales case3" style="display: none;">
                    @foreach ($sales as $item)
                    <option value="{{$item->id}}"> {{$item->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="case4" style="display: none;">
                Admin
                <select name="admin_id" class="form-control sales case4" style="display: none;">
                    @foreach ($sales as $item)
                    <option value="{{$item->id}}"> {{$item->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
    @endif
    <div class="row mb-3">
        <div class="col-12">
            <h4><b><label for="customer_select"># Customer</label></b> &nbsp;
                @if(Gate::allows('isAdmin')||Gate::allows('isSales'))
                <a href="#modalForm" data-toggle="modal" data-href="{{ url('sales-orders/create/customer') }}"
                    class="btn btn-secondary btn-sm">
                    <i class="fa fa-plus"></i> Tambah Customer Baru</a>
                @endif
            </h4>
        </div>
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="form-group">
                        <select class="form-control customer mb-0" id="customer_select" name="customer_id" required
                            style="width: 100%">
                            <option></option>
                            @foreach($customers as $customer)
                            <option value="{{ $customer->id }}" class="text-danger"
                                {{ @$isEdit && $customer->id == $sale->customer->id ? 'selected' : '' }}>
                                {{ $customer->project_owner }} {{ $customer->created_at->isToday() ? '- NEW!' : '' }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <h5 class="card-header bg-secondary">
                    <a data-toggle="collapse" href="#collapse-example" aria-expanded="true"
                        aria-controls="collapse-example" id="heading-example"
                        class="d-flex justify-content-between align-items-center collapsed">
                        <div>
                            <span id="detail-text">Tampilkan</span> Detail Customer
                        </div>
                        <div>
                            <i class="fa fa-chevron-down"></i>
                        </div>
                    </a>
                </h5>
                <div class="collapse" id="collapse-example" style="background: #F5F5F5;">
                    <div class="card-body">
                        <div class="form-row">
                            <div class="form-group col-lg-2">
                                <label for="register_id">Register ID</label>
                                <input type="text" class="form-control" id="register_id" disabled name="register_id"
                                    value="{{ @$isEdit ? $sale->customer->id : '' }}">
                            </div>
                            <div class="form-group col-lg-5">
                                <label for="name">Pemilik Project</label>
                                <input type="text" class="form-control" id="name" disabled name="name"
                                    value="{{ @$isEdit ? $sale->customer->project_owner : '' }}">
                            </div>
                            <div class="form-group col-lg-5">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" disabled name="email"
                                    value="{{ @$isEdit ? $sale->customer->email : '' }}">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-lg-6">
                                <label for="address">Alamat</label>
                                <input type="text" class="form-control" id="address" disabled name="address"
                                    value="{{ @$isEdit ? $sale->customer->address : '' }}">
                            </div>
                            <div class="form-group col-lg-3">
                                <label for="phone">Telp</label>
                                <input type="text" class="form-control" id="phone" disabled name="phone"
                                    value="{{ @$isEdit ? $sale->customer->phone : '' }}">
                            </div>
                            <div class="form-group col-lg-3">
                                <label for="fax">Fax</label>
                                <input type="text" class="form-control" id="fax" disabled name="fax"
                                    value="{{ @$isEdit ? $sale->customer->fax : '' }}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-lg-12">
            <h4><b># Barang</b></h4>
            <div class="card">
                <div class="card-body">
                    @if(@$isEdit && !empty($sale->details))
                    <div class="row">
                        <div class="col-12">
                            <h5><b>Barang Saat Ini</b></h5>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>Qty</th>
                                            <th>Harga Beli</th>
                                            <th>Harga Jual</th>
                                            <th>Diskon</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($sale->details as $details)
                                        <tr>
                                            <td>
                                                {{ $details->id }}
                                            </td>
                                            <td>
                                                {{ $details->stock->item->name }}
                                            </td>
                                            <td>
                                                {{ $details->qty }}
                                            </td>
                                            <td>
                                                Rp{{number_format($details->price) }}
                                            </td>
                                            <td>
                                                {{ $details->discount }}%
                                            </td>
                                            <td>
                                                Rp{{number_format($details->total)}}
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="6" class="text-center">No items yet</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            <hr>
                        </div>
                    </div>
                    @endif
                    <div class="row">
                        <div class="col-12">
                            <h5><b>Tambah Barang</b></h5>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="brands">Brand</label>
                                <select class="form-control brand" id="brands" name="brand" style="width: 100%">
                                    <option></option>
                                    @foreach($brands as $brand)
                                    <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="categories">Kategori</label>
                                <select autocomplete="off" name="category" id="categories"
                                    class="form-control categories w-100">
                                    <option value="" selected disabled></option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="branches">Cabang</label>
                                <select autocomplete="off" name="branches" id="branches"
                                    class="form-control branches w-100 select2">
                                    <option></option>
                                    @foreach($branches as $branch)
                                    <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="card mb-0" id="itemsList">
                                <div class="card-body p-0" id="items">
                                    <div id="items-text" class="text-secondary p-3">
                                        <i class="fa fa-shopping-cart"></i> Hasil pencarian akan muncul disini
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <div class="card mt-3 mt-lg-0">
                                <div class="d-flex justify-content-between align-items-center p-3">
                                    <div id="items2-text" class="count text-secondary">
                                        <i class="fa fa-shopping-cart"></i> Belum ada barang dipilih
                                    </div>
                                    <div>
                                        <b>Total:</b> <span id="grand-total-span">Rp 0</span>
                                    </div>
                                </div>
                                <div class="card-body p-0" id="items2">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <h4 class="card-title"><b># Detail Sales Order</b></h4>
            <div class="card">
                <div class="card-body">
                    <div class="form-group row">
                        <label for="quotation_id" class="col-12 col-md-2 col-form-label">Quotation
                            ID</label>
                        <div class="col-8 col-md-4">
                            <input  type="text" class="form-control" id="quotation_id" name="quotation_id"
                                value="{{ @$isEdit ? $sale->quotation_id : $no_qo }}" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="project" class="col-12 col-lg-2 col-form-label">Project</label>
                        <div class="col-12 col-md-8">
                            <input type="text" class="form-control" id="project" name="project"
                                value="{{ @$isEdit ? $sale->project : '' }}" required
                                class="form-row">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="pic" class="col-12 col-lg-2 col-form-label">Person in Charge</label>
                        <div class="col-12 col-md-8">
                            <input type="text" class="form-control" id="pic" name="pic"
                                value="{{ @$isEdit ? $sale->pic : '' }}" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="send_address" class="col-12 col-lg-2 col-form-label">Alamat Kirim</label>
                        <div class="col-12 col-md-8">
                            <textarea name="send_address" id="send_address" class="form-control"
                                rows="5">{{ @$isEdit ? $sale->send_address : '' }}</textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="send_date" class="col-12 col-lg-2 col-form-label">Tanggal Kirim</label>
                        <div class="col-8 col-md-4">
                            <input type="date" class="form-control" id="send_date" name="send_date"
                                min="{{ date('Y-m-d') }}" value="{{ @$isEdit ? $sale->send_date : date('Y-m-d') }}"
                                required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="telp_pic" class="col-12 col-lg-2 col-form-label">No. Telp PIC</label>
                        <div class="col-8 col-md-4">
                            <input type="text" class="form-control" id="telp_pic" name="send_pic_phone"
                                value="{{ @$isEdit ? $sale->send_pic_phone : '' }}" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="ongkir" class="col-12 col-lg-2 col-form-label">Ongkos Kirim</label>
                        <div class="col-8 col-md-4">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">Rp</span>
                                </div>
                                <input type="number" name="ongkir" id="ongkir" class="form-control" required
                                    value="{{ @$isEdit ? $sale->ongkir : '' }}">
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="grand-total-span-input" class="col-12 col-lg-2 col-form-label">Total Harga
                            Barang</label>
                        <div class="col-8 col-md-4">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">Rp</span>
                                </div>
                                <input type="number" name="grand_total" readonly id="grand-total-span-input"
                                    class="form-control cleave" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="note" class="col-12 col-lg-2 col-form-label">Catatan</label>
                        <div class="col-12 col-md-8">
                            <textarea name="note" id="note" class="form-control"
                                rows="5">{{ @$isEdit ? $sale->note : '' }}</textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="payment_method" class="col-12 col-lg-2 col-form-label">Pembayaran</label>
                        <div class="col-12 col-md-8">
                            <div class="custom-control custom-radio">
                                <input type="radio" id="payment_method_cbd" checked="checked" name="payment_method"
                                    class="custom-control-input" value="CBD">
                                <label class="custom-control-label" for="payment_method_cbd">Cash Before Delivery
                                    (CBD)</label>
                            </div>
                            @if(Gate::allows("isAdmin")||Gate::allows("isFinance"))
                            <div class="custom-control custom-radio mt-2">
                                <input type="radio" id="payment_method_cod" name="payment_method"
                                    class="custom-control-input" value="COD">
                                <label class="custom-control-label" for="payment_method_cod">Cash On Delivery
                                    (COD)</label>
                            </div>
                            <div class="custom-control custom-radio mt-2">
                                <input type="radio" id="payment_method_credit" name="payment_method"
                                    class="custom-control-input" value="Credit">
                                <label class="custom-control-label" for="payment_method_credit">Down Payment /
                                    Credit</label>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row pb-5">
        <div class="col-12">
            <button type="submit" class="btn btn-success">
                <i class="fa fa-check"></i> {{ @$isEdit ? 'Edit' : 'Buat' }} Quotation Order
            </button>
        </div>
    </div>
</form>
@endsection
