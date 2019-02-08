<form action="{{ @$isEdit ? url('branches/'.$branch->id) : url('branches') }}" method="post">
    @csrf
    {{ @$isEdit ? method_field('PUT') : '' }}
    <div class="modal-header">
        <h5 class="modal-title">{{ @$isEdit ? 'Edit' : 'Tambah' }} Branch</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <div class="form-group row">
            <div class="col-lg-12">
                <label for="name" class="form-control-label">Nama</label>
                <input id="name" class="form-control" name="name" type="text"
                       value="{{ @$isEdit ? $branch->name : '' }}">
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