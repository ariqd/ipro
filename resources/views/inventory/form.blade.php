<form action="{{ @$isEdit ? url('inventories/'.$inventory->id) : url('inventories') }}" method="post">
    @csrf
    {{ @$isEdit ? method_field('PUT') : '' }}
    <div class="modal-header">
        <h5 class="modal-title">{{ @$isEdit? 'Edit' : 'Tambah' }} Produk</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <div class="form-group row">
            <div class="col-lg-12">
                <label for="brand" class="form-control-label">Brand</label>
                <input id="brand" class="form-control" name="brand" value="{{ @$isEdit ? $inventory->brand : '' }}">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-lg-12">
                <label for="code" class="form-control-label">Kode Produk</label>
                <input id="code" class="form-control" name="code" value="{{ @$isEdit ? $inventory->code : '' }}">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-lg-12">
                <label for="name" class="form-control-label">Nama Produk</label>
                <input id="name" class="form-control" name="name" value="{{ @$isEdit ? $inventory->name : '' }}">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-lg-12">
                <label for="branch" class="form-control-label">Cabang</label>
                <input id="branch" class="form-control" name="branch" value="{{ @$isEdit ? $inventory->branch : '' }}">
                {{--<small class="text-secondary">e.g. BDG, JKT, JKT2</small>--}}
            </div>
        </div>
        <div class="form-group row">
            <div class="col-lg-12">
                <label for="stock" class="form-control-label">Stok</label>
                <input type="number" id="stock" class="form-control" name="stock"
                       value="{{ @$isEdit ? $inventory->stock : '' }}">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-lg-12">
                <label for="weight" class="form-control-label">Berat (Kg)</label>
                <input type="number" id="weight" class="form-control" step=".0001" name="weight"
                       value="{{ @$isEdit ? $inventory->weight : '' }}">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-lg-12">
                <label for="area" class="form-control-label">Area (m2)</label>
                <input type="number" id="area" class="form-control" step=".0001" name="area"
                       value="{{ @$isEdit ? $inventory->area : '' }}">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-lg-12">
                <label for="width" class="form-control-label">Lebar (m)</label>
                <input type="number" id="width" class="form-control" step=".0001" name="width"
                       value="{{ @$isEdit ? $inventory->width : '' }}">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-lg-12">
                <label for="height" class="form-control-label">Tinggi (m)</label>
                <input type="number" id="height" class="form-control" step=".0001" name="height"
                       value="{{ @$isEdit ? $inventory->height : '' }}">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-lg-12">
                <label for="length" class="form-control-label">Panjang (m)</label>
                <input type="number" id="length" class="form-control" step=".0001" name="length"
                       value="{{ @$isEdit ? $inventory->length : '' }}">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-lg-12">
                <label for="price" class="form-control-label">Harga / unit (Rp)</label>
                <input type="number" id="price" class="form-control" name="price"
                       value="{{ @$isEdit ? $inventory->price : '' }}">
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal"> Batal</button>
        <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Tambah</button>
    </div>
</form>