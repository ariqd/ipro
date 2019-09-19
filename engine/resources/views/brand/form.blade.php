<form action="{{ @$isEdit ? url('brands/'.$brand->id) : url('brands') }}" method="post" enctype="multipart/form-data">
    @csrf
    {{ @$isEdit ? method_field('PUT') : '' }}
    <div class="modal-header bg-dark text-light">
        <h5 class="modal-title">{{ @$isEdit ? 'Edit' : 'Tambah' }} Merek</h5>
        <button type="button" class="close text-light" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <div class="form-group">
            <label for="name" class="form-control-label">Nama Merek</label>
            <input required id="name" class="form-control" name="name" type="text"
                value="{{ @$isEdit ? $brand->name : '' }}" placeholder="Nama Merek">
        </div>
        @if(@$isEdit)
        <div class="form-group">
            <label for="name" class="form-control-label">Logo Saat Ini</label> <br>
            <img src="{{ asset("assets/img/logo/$brand->logo") }}" alt="{{ $brand->name }}" class="img-fluid"
                width="100">
        </div>
        @endif
        <div class="form-group">
            <label for="name" class="form-control-label">{{ @$isEdit ? 'Ganti' : '' }} Logo</label>
            <input {{ @$isEdit ? '' : 'required' }} id="logo" class="form-control" name="logo" type="file"
                value="{{ @$isEdit ? $brand->logo : '' }}" placeholder="Nama Merek">
            @if(@$isEdit)
            <small class="text-muted">Kosongkan jika tidak ganti logo</small>
            @endif
        </div>
        <div class="form-group">
            <label for="notes" class="form-control-label">Catatan</label>
            <input id="notes" class="form-control" name="notes" type="text" value="{{ @$isEdit ? $brand->notes : '' }}"
                placeholder="Catatan">
            <small class="text-muted">Boleh dikosongkan</small>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal"> Batal</button>
        <button type="submit" class="btn btn-success"><i class="fa fa-check"></i>
            {{ @$isEdit ? 'Edit' : 'Tambah' }} Merek
        </button>
    </div>
</form>
