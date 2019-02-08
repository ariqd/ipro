<form action="{{ url('accounts') }}" method="post">
    @csrf
    <div class="modal-header">
        <h5 class="modal-title">{{ @$isEdit ? 'Edit' : 'Tambah' }} User</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <div class="form-group row">
            <div class="col-lg-12">
                <label for="name" class="form-control-label">Name</label>
                <input id="name" class="form-control" name="name" type="text"
                       value="{{ @$isEdit ? $user->name : '' }}">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-lg-12">
                <label for="username" class="form-control-label">Username</label>
                <input id="username" class="form-control" name="username" type="text"
                       value="{{ @$isEdit ? $user->username : '' }}">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-lg-12">
                <label for="email" class="form-control-label">Email</label>
                <input id="email" class="form-control" name="email" type="email"
                       value="{{ @$isEdit ? $user->email : '' }}">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-lg-12">
                <label for="role" class="form-control-label">Role</label>
                <select class="custom-select" id="role" name="role">
                    <option selected disabled>Select user role</option>
                    @foreach($types as $key => $type)
                        <option value="{{ $key }}">{{ $type }}</option>
                    @endforeach
                </select>
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