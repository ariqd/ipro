<form action="{{ @$isEdit ? url('brands/'.$brand->id) : url('brands') }}" method="post">
    @csrf
    {{ @$isEdit ? method_field('PUT') : '' }}
    <div class="modal-header bg-dark text-light">
        <h5 class="modal-title">{{ @$isEdit ? 'Edit' : 'Tambah' }} Merek</h5>
        <button type="button" class="close text-light" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <div class="form-group row">
            <div class="col-lg-12">
                <label for="name" class="form-control-label">Nama Merek</label>
                <input required id="name" class="form-control" name="name" type="text"
                    value="{{ @$isEdit ? $brand->name : '' }}" placeholder="Nama Merek">
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal"> Batal</button>
        <button type="submit" class="btn btn-success"><i class="fa fa-check"></i>
            {{ @$isEdit ? 'Edit' : 'Tambah' }} Merek
        </button>
    </div>
</form>
