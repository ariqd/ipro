<form action="{{ @$isEdit ? url('inventories/'.$inventory->id) : url('inventories') }}" method="post">
    @csrf
    {{ @$isEdit ? method_field('PUT') : '' }}
    <div class="modal-header">
        <h5 class="modal-title">Tambah Produk</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    {{--<div class="modal-body">--}}
        <div class="table-responsive">
            <table class="table table-bordered table-light">
                <thead>
                <tr>
                    <th>Kategori</th>
                    <th>Kode Barang</th>
                    <th>Description</th>
                    <th>Berat/pcs</th>
                    <th>Order Qty/pcs</th>
                    <th>Price/pcs</th>
                    <th>Total Amount (IDR)</th>
                    <th>GR Code</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                            <label class="form-check-label" for="defaultCheck1">
                                <small>Add</small>
                            </label>
                        </div>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>

    {{--</div>--}}
    <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal"> Batal</button>
        <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i>
            {{--{{ @$isEdit ? 'Edit' : 'Tambah' }}--}}
            Tambah
        </button>
    </div>
</form>