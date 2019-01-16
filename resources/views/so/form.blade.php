@extends('layouts.carbon')

@section('title', 'Sales Order')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="d-flex justify-content-between">
                    <div>
                        <h2>
                            <small>
                                <a href="{{ url('sales-orders') }}">Sales Orders</a> /
                            </small>
                            <b>Create</b>
                        </h2>
                    </div>
                    <div>
                        <div class="form-group row">
                            <label for="payment_method" class="col-5 col-form-label text-right">Quotation ID</label>
                            <div class="col-7">
                                <input type="text" class="form-control" id="customer" name="customer">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <form action="#">
            <div class="row">
                <div class="col-lg-4">
                    <h5 class="mb-2"><b>Input Data Customer</b></h5>
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="customer">Customer</label>
                                {{--<input type="text" class="form-control" id="customer" name="customer">--}}
                                <select class="form-control" id="customer" name="customer">
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                    <option>4</option>
                                    <option>5</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="register_id">Register ID</label>
                                <input type="text" class="form-control" id="register_id" name="register_id">
                            </div>
                            <div class="form-group">
                                <label for="owner">Pemilik Project</label>
                                <input type="text" class="form-control" id="owner" name="owner">
                            </div>
                            <div class="form-group">
                                <label for="address">Alamat</label>
                                <input type="text" class="form-control" id="address" name="address">
                            </div>
                            <div class="form-group">
                                <label for="telp">Telp</label>
                                <input type="text" class="form-control" id="telp" name="telp">
                            </div>
                            <div class="form-group">
                                <label for="fax">Fax</label>
                                <input type="text" class="form-control" id="fax" name="fax">
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email">
                            </div>
                            <div class="form-group">
                                <label for="project">Project</label>
                                <input type="text" class="form-control" id="project" name="project">
                            </div>
                            <div class="form-group">
                                <label for="send_address">Alamat Kirim</label>
                                <input type="text" class="form-control" id="send_address" name="send_address">
                            </div>
                            <div class="form-group">
                                <label for="send_date">Tanggal Kirim</label>
                                <input type="text" class="form-control" id="send_date" name="send_date">
                            </div>
                            <div class="form-group">
                                <label for="telp_pic">No. Telp PIC</label>
                                <input type="text" class="form-control" id="telp_pic" name="telp_pic">
                            </div>
                            <div class="form-group">
                                <label for="notes">Catatan</label>
                                <textarea name="notes" id="notes" class="form-control"></textarea>
                                {{--<input type="text" class="form-control" id="customer" name="customer">--}}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <h5 class="mb-2"><b>Input Data Barang</b></h5>
                    <div class="form-group row">
                        <label for="categories" class="col-sm-2 col-form-label">Kategori</label>
                        <div class="col-sm-10">
                            <select class="form-control" id="categories" name="categories">
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                                <option>5</option>
                            </select>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-light table-bordered">
                            <thead>
                            <tr>
                                <th>Kode</th>
                                <th>Nama</th>
                                <th>Berat / Pcs (Kg)</th>
                                <th>Harga / Unit</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>Barang</td>
                                <td>Barang</td>
                                <td>Barang</td>
                                <td>Barang</td>
                                <td></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="form-group row">
                        <label for="payment_method" class="col-4 col-form-label">Pilih metode pembayaran</label>
                        <div class="col-8">
                            <select class="form-control" id="payment_method" name="payment_method">
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                                <option>5</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <b>Sales:</b> Admin
                        </div>
                        <div class="col-6">
                            <b>Tanggal:</b> 01-01-2019
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">

                </div>
                <div class="col-lg-6">
                    <a href="#" class="btn btn-success float-right">Create Sales Order</a>
                </div>
            </div>
        </form>
    </div>
@endsection