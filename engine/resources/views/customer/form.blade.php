<form action="{{ @$customer ? url('customers/'.@$customer->id) : url('customers') }}" method="post">
    @csrf
    {{ @$customer ? method_field('PUT') : '' }}
    <div class="modal-header bg-dark text-light">
        <h5 class="modal-title"><i class="fa fa-plus"></i> Tambah Customer</h5>
        <button type="button" class="close text-light" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <div class="form-group row">
            <div class="col-lg-12">
                <label for="project_owner" class="form-control-label">Nama Customer / Project Owner</label>
                <input id="project_owner" class="form-control" name="project_owner"
                    value="{{ @$customer ? $customer->project_owner : old('project_owner') }}">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-lg-12">
                <label for="no_ktp" class="form-control-label">No. KTP</label>
                <input id="no_ktp" class="form-control" name="no_ktp"
                    value="{{ @$customer ? $customer->no_ktp : old('no_ktp') }}">
                <small class="text-secondary">Boleh dikosongkan</small>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-lg-12">
                <label for="npwp" class="form-control-label">NPWP</label>
                <input id="npwp" class="form-control" name="npwp"
                    value="{{ @$customer ? $customer->npwp : old('npwp') }}">
                <small class="text-secondary">Boleh dikosongkan</small>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-lg-12">
                <label for="phone" class="form-control-label">No. Telepon Customer</label>
                <input id="phone" class="form-control" name="phone"
                    value="{{ @$customer ? $customer->phone : old('phone') }}">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-lg-12">
                <label for="address" class="form-control-label">Alamat Customer</label>
                <textarea name="address" id="address" class="form-control"
                    rows="5">{{ @$customer ? $customer->address : old('alamat') }}</textarea>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-lg-12">
                <label for="city" class="form-control-label">Kota</label>
                <input id="city" type="text" class="form-control" name="city"
                    value="{{ @$customer->city ?? old('city') }}" placeholder="Ketikkan kota customer">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-lg-12">
                <label for="fax" class="form-control-label">Fax Customer</label>
                <input id="fax" class="form-control" name="fax" value="{{ @$customer ? $customer->fax : old('fax') }}">
                <small class="text-secondary">Boleh dikosongkan</small>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-lg-12">
                <label for="email" class="form-control-label">Email Customer</label>
                <input id="email" type="text" class="form-control" name="email"
                    value="{{ @$customer ? $customer->email : old('email') }}">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-lg-12">
                <label for="notes" class="form-control-label">Catatan</label>
                <input id="notes" type="text" class="form-control" name="notes"
                    value="{{ @$customer->notes ?? old('notes') }}">
                <small class="text-secondary">Boleh dikosongkan</small>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal"> Cancel</button>
        <button type="submit" class="btn btn-success"><i class="fa fa-check"></i>
            Simpan
        </button>
    </div>
</form>
