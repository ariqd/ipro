<form action="{{ @$customer ? url('customers/'.@$customer->id) : url('customers') }}" method="post">
    @csrf
    {{ @$customer ? method_field('PUT') : '' }}
    <div class="modal-header">
        <h5 class="modal-title">{{ @$customer ? 'Edit' : 'Tambah' }} Customer</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <div class="form-group row">
            <div class="col-lg-12">
                <label for="project_owner" class="form-control-label">Project Owner</label>
                <input id="project_owner" class="form-control" name="project_owner"
                       value="{{ @$customer ? @$customer->project_owner : '' }}">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-lg-12">
                <label for="no_ktp" class="form-control-label">No. KTP</label>
                <input id="no_ktp" type="number" class="form-control" maxlength="16" name="no_ktp"
                       value="{{ @$customer ? @$customer->no_ktp : '' }}">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-lg-12">
                <label for="npwp" class="form-control-label">NPWP</label>
                <input id="npwp" type="text" class="form-control" name="npwp"
                       value="{{ @$customer ? @$customer->npwp : '' }}">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-lg-12">
                <label for="phone" class="form-control-label">No. Telepon</label>
                <input id="phone" class="form-control" name="phone" value="{{ @$customer ? @$customer->phone : '' }}">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-lg-12">
                <label for="address" class="form-control-label">Alamat</label>
                <textarea name="address" id="address"
                          class="form-control">{{ @$customer ? @$customer->address : '' }}</textarea>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-lg-12">
                <label for="fax" class="form-control-label">Fax</label>
                <input id="fax" class="form-control" name="fax" value="{{ @$customer ? @$customer->fax : '' }}">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-lg-12">
                <label for="email" class="form-control-label">Email</label>
                <input id="email" type="email" class="form-control" name="email"
                       value="{{ @$customer ? @$customer->email : '' }}">
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal"> Batal</button>
        <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i>
            {{ @$customer ? 'Edit' : 'Tambah' }}
        </button>
    </div>
</form>