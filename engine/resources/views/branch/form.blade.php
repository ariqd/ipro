<form action="{{ @$isEdit ? url('branches/'.$branch->id) : url('branches') }}" method="post">
    @csrf
    {{ @$isEdit ? method_field('PUT') : '' }}
    <div class="modal-header">
        <h5 class="modal-title">{{ @$isEdit ? 'Edit' : 'Tambah' }} Cabang</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <div class="form-group">
            <label for="name" class="form-control-label">Nama</label>
            <input id="name" class="form-control" name="name" type="text" value="{{ @$isEdit ? $branch->name : '' }}"
                placeholder="Nama Cabang">
        </div>
        <div class="form-group">
            <label for="notes" class="form-control-label">Catatan</label>
            <input id="notes" class="form-control" name="notes" type="text"
                value="{{ @$isEdit ? $branch->notes : '' }}" placeholder="Catatan">
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal"> Batal</button>
        <button type="submit" class="btn btn-success"><i class="fa fa-check"></i>
            {{ @$isEdit ? 'Edit' : 'Tambah' }}
        </button>
    </div>
</form>
