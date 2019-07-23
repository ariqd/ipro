<form action="{{ @$isEdit ? url('items/'.$item->id) : url('items') }}" method="post">
    @csrf
    {{ @$isEdit ? method_field('PUT') : '' }}
    <div class="modal-header">
        <h5 class="modal-title">{{ @$isEdit? 'Edit' : 'Tambah' }} Item</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <div class="form-group">
            <label for="category" class="form-control-label">Kategori</label>
            <select class="category form-control" name="category_id" id="category">
                <option></option>
                @foreach($categories as $category)
                <option value="{{ $category->id }}"
                    {{ @$isEdit && $category->id == $item->category_id ? 'selected' : '' }}>
                    {{ $category->brand->name . ' - ' . $category->name }}
                </option>
                @endforeach
            </select>
        </div>
        <div class="form-group row">
            <div class="col-lg-12">
                <label for="code" class="form-control-label">Kode Produk</label>
                <input autocomplete="off" id="code" class="form-control" name="code"
                    value="{{ @$isEdit ? $item->code : '' }}">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-lg-12">
                <label for="name" class="form-control-label">Nama Produk</label>
                <input autocomplete="off" id="name" class="form-control" name="name"
                    value="{{ @$isEdit ? $item->name : '' }}">
            </div>
        </div>
        <div class="form-group">
            <label for="purchase_price" class="form-control-label">Harga Beli</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">Rp</span>
                </div>
                <input autocomplete="off" id="purchase_price" class="form-control" name="purchase_price"
                    value="{{ @$isEdit ? $item->purchase_price : '' }}">
            </div>
        </div>
        <div class="form-group">
            <label for="weight" class="form-control-label">Berat</label>
            <div class="input-group">
                <input autocomplete="off" id="weight" class="form-control" name="weight"
                    value="{{ @$isEdit ? $item->weight : '' }}">
                <div class="input-group-append">
                    <span class="input-group-text">Kg</span>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="kebutuhan per meter persegi" class="form-control-label">Kebutuhan per Meter Persegi (m2)</label>
            <div class="input-group">
                <input autocomplete="off" id="kebutuhan per meter persegi" class="form-control" name="area"
                    value="{{ @$isEdit ? $item->area : '' }}">
                <div class="input-group-append">
                    <span class="input-group-text">m<sup>2</sup></span>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="width" class="form-control-label">Lebar (mm)</label>
            <div class="input-group">
                <input autocomplete="off" id="width" class="form-control" name="width"
                    value="{{ @$isEdit ? $item->width : '' }}">
                <div class="input-group-append">
                    <span class="input-group-text">mm</span>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="length" class="form-control-label">Panjang (mm)</label>
            <div class="input-group">
                <input autocomplete="off" id="length" class="form-control" name="length"
                    value="{{ @$isEdit ? $item->length : '' }}">
                <div class="input-group-append">
                    <span class="input-group-text">mm</span>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="height" class="form-control-label">Tebal(mm)</label>
            <div class="input-group">
                <input autocomplete="off" id="height" class="form-control" name="height"
                    value="{{ @$isEdit ? $item->height : '' }}">
                <div class="input-group-append">
                    <span class="input-group-text">mm</span>
                </div>
            </div>
        </div>

    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal"> Batal</button>
        <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i>
            {{ @$isEdit ? 'Edit' : 'Tambah' }}
        </button>
    </div>
</form>

<script type="text/javascript">
    $(".category").select2({
        placeholder: "Pilih Kategori",
        allowClear: true,
        dropdownParent: $("#modalForm")
    });
</script>