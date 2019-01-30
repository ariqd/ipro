<form action="{{ url('branches') }}" method="post">
    @csrf
    <div class="modal-header">
        <h5 class="modal-title">{{ @$isEdit ? 'Edit' : 'Tambah' }} Cabang</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">

    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal"> Batal</button>
        <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i>
            {{ @$isEdit ? 'Edit' : 'Tambah' }}
        </button>
    </div>
</form>