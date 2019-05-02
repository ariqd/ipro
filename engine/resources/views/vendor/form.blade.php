<form action="{{ @$isEdit ? url('vendors/'.$vendor->id) : url('vendors') }}" method="post">
    @csrf
    {{ @$isEdit ? method_field('PUT') : '' }}
    <div class="modal-header">
        <h5 class="modal-title">{{ @$isEdit ? 'Edit' : 'Tambah' }} Vendor</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <div class="form-group row">
            <div class="col-lg-12">
                <label for="name" class="form-control-label">Nama</label>
                <input id="name" class="form-control" name="name"
                       value="{{ @$isEdit ? $vendor->name : '' }}" required>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-lg-12">
                <label for="phone" class="form-control-label">Phone</label>
                <input id="phone" class="form-control" name="phone" value="{{ @$isEdit ? $vendor->phone : '' }}"
                       required>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-lg-12">
                <label for="address" class="form-control-label">Address</label>
                <textarea name="address" id="address" class="form-control" rows="5" required>{{ @$isEdit ? $vendor->address : '' }}</textarea>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-lg-12">
                <label for="email" class="form-control-label">Email</label>
                <input id="email" type="email" class="form-control" name="email"
                       value="{{ @$isEdit ? $vendor->email : '' }}" required>
            </div>
        </div>
        <hr>
        <h5>Vendor PIC</h5>
        <div class="form-group row">
            <div class="col-lg-12">
                <label for="pic_name" class="form-control-label">PIC Name</label>
                <input id="pic_name" type="text" class="form-control" name="pic_name"
                       value="{{ @$isEdit ? $vendor->pic_name : '' }}">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-lg-12">
                <label for="pic_phone" class="form-control-label">PIC Phone</label>
                <input id="pic_phone" type="text" class="form-control" name="pic_phone"
                       value="{{ @$isEdit ? $vendor->pic_phone : '' }}">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-lg-12">
                <label for="pic_email" class="form-control-label">PIC Email</label>
                <input id="pic_email" type="email" class="form-control" name="pic_email"
                       value="{{ @$isEdit ? $vendor->pic_email : '' }}">
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal"> Batal</button>
        <button type="submit" class="btn btn-success"><i class="fa fa-check"></i>
            {{ @$isEdit ? 'Edit' : 'Tambah' }}
        </button>
    </div>
</form>