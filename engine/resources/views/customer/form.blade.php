<form action="{{ @$isEdit ? url('customers/'.$stock->id) : url('customers') }}" method="post">
    @csrf
    {{ @$isEdit ? method_field('PUT') : '' }}
    <div class="modal-header">
        <h5 class="modal-title">{{ @$isEdit ? 'Edit' : 'Tambah' }} Customer</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <div class="form-group row">
            <div class="col-lg-12">
                <label for="project_owner" class="form-control-label">Project Owner</label>
                <input id="project_owner" class="form-control" name="project_owner"
                       value="{{ @$isEdit ? $customer->name : '' }}">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-lg-12">
                <label for="no_ktp" class="form-control-label">No. KTP</label>
                <input id="no_ktp" type="number" class="form-control" maxlength="16" name="no_ktp" value="{{ @$isEdit ? $customer->no_ktp : '' }}">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-lg-12">
                <label for="phone" class="form-control-label">Phone</label>
                <input id="phone" class="form-control" name="phone" value="{{ @$isEdit ? $customer->phone : '' }}">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-lg-12">
                <label for="address" class="form-control-label">Address</label>
                <textarea name="address" id="address" class="form-control"></textarea>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-lg-12">
                <label for="fax" class="form-control-label">Fax</label>
                <input id="fax" class="form-control" name="fax" value="{{ @$isEdit ? $customer->fax : '' }}">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-lg-12">
                <label for="email" class="form-control-label">Email</label>
                <input id="email" type="email" class="form-control" name="email" value="{{ @$isEdit ? $customer->email : '' }}">
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