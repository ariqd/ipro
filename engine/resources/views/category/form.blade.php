<form action="{{ @$isEdit ? url('categories/'.$category->id) : url('categories') }}" method="post">
    @csrf
    {{ @$isEdit ? method_field('PUT') : '' }}
    <div class="modal-header bg-dark text-light border border-dark">
        <h5 class="modal-title">{{ @$isEdit ? 'Edit' : 'Tambah' }} Kategori</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <div class="form-group">
            <label for="brand" class="form-control-label">Brand</label> <br>
            <select class="brand custom-select" name="brand_id" style="width: 100%" required>
                <option value="" selected disabled></option>
                @foreach($brands as $brand)
                <option value="{{ $brand->id }}" {{ @$isEdit && $brand->id == $category->brand->id ? 'selected' : '' }}>
                    {{ $brand->name }}
                </option>
                @endforeach
            </select>
        </div>
        <div class="form-group row">
            <div class="col-lg-12">
                <label for="name" class="form-control-label">Nama Kategori</label>
                <input id="name" class="form-control" name="name" type="text"
                    value="{{ @$isEdit ? $category->name : '' }}" required placeholder="Nama kategori">
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal"> Batal</button>
        <button type="submit" class="btn btn-success"><i class="fa fa-check"></i>
            {{ @$isEdit ? 'Edit' : 'Simpan' }}
        </button>
    </div>
</form>

<script type="text/javascript">
    $(".brand").select2({
        placeholder: "Pilih Brand",
        allowClear: true,
        dropdownParent: $("#modalForm")
    });
</script>
