<form action="{{ @$isEdit ? url('accounts/'.$user->id) : url('accounts') }}" method="post">
    @csrf
    {{ @$isEdit ? method_field('PUT') : '' }}
    <div class="modal-header">
        <h5 class="modal-title">{{ @$isEdit ? 'Edit' : 'Tambah' }} User</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <div class="form-group row">
            <div class="col-lg-12">
                <label for="name" class="form-control-label">Nama</label>
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
                <label for="password" class="col-form-label text-md-right">{{ __('Password') }}</label>
                <input id="password" type="password"
                       class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password">
                <small class="form-text text-muted">Tinggalkan Kosong Jika Tidak Mau Diisi</small>

                @if ($errors->has('password'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif

                <div class="form-check mt-2">
                    <input class="form-check-input" onclick="myFunction()" type="checkbox" value="" id="defaultCheck1">
                    <label class="form-check-label" for="defaultCheck1">
                        Lihat Password
                    </label>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-lg-12">
                <label for="role" class="form-control-label">Jabatan</label>
                <select class="custom-select" id="role" name="role">
                    <option selected disabled>Pilih Jabatan User</option>
                    @foreach($types as $key => $type)
                        <option value="{{ $key }}" {{ @$isEdit && $key == $user->role ? 'selected' : '' }}>{{ $type }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group row {{ @!$isEdit || @$user->role == 'admin' || @$user->role == 'finance' ? 'd-none' : ''  }}" id="branch">
            <div class="col-lg-12">
                <label for="branch_id" class="form-control-label">Cabang</label>
                <select class="custom-select" id="branch_id" name="branch_id">
                    <option selected disabled>Pilih Cabang</option>
                    @foreach($branches as $key => $branch)
                        <option value="{{ $branch->id }}"
                                {{ @$isEdit && $branch->id == @$user->branch->id ? 'selected' : '' }}>
                            {{ $branch->name }}
                        </option>
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

<script>
    function myFunction() {
        var x = document.getElementById("password");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }

    $(document).ready(function () {
        $('#role').on('change', function () {
            var role = $(this).val();
            if (role === 'admin') {
                $('#branch').addClass('d-none');
            } else {
                $('#branch').removeClass('d-none');
            }
        });
    });
</script>