<style>
    <style>.loading {
        background: lightgrey;
        padding: 15px;
        position: fixed;
        border-radius: 4px;
        left: 50%;
        top: 50%;
        text-align: center;
        margin: -40px 0 0 -50px;
        z-index: 2000;
        display: none;
    }

    /* The switch - the box around the slider */
    .switch {
        position: relative;
        display: inline-block;
        width: 60px;
        height: 34px;
    }

    /* Hide default HTML checkbox */
    .switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    /* The slider */
    .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        -webkit-transition: .4s;
        transition: .4s;
    }

    .slider:before {
        position: absolute;
        content: "";
        height: 26px;
        width: 26px;
        left: 4px;
        bottom: 4px;
        background-color: white;
        -webkit-transition: .4s;
        transition: .4s;
    }

    input:checked+.slider {
        background-color: #2196F3;
    }

    input:focus+.slider {
        box-shadow: 0 0 1px #2196F3;
    }

    input:checked+.slider:before {
        -webkit-transform: translateX(26px);
        -ms-transform: translateX(26px);
        transform: translateX(26px);
    }

    /* Rounded sliders */
    .slider.round {
        border-radius: 34px;
    }

    .slider.round:before {
        border-radius: 50%;
    }

</style>
<form action="{{ @$edit ? url('categories/'.$category->id) : url('categories') }}" method="post">
    @csrf
    {{ @$edit ? method_field('PUT') : '' }}
    <div class="modal-header bg-dark text-light border border-dark">
        <h5 class="modal-title">{{ @$edit ? 'Edit' : 'Tambah' }} Kategori</h5>
        <button type="button" class="close text-light" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true"><i class="fa fa-times"></i></span>
        </button>
    </div>
    <div class="modal-body">
        <div class="form-group">
            <label for="brand" class="form-control-label">Brand</label> <br>
            <select class="brand custom-select" name="brand_id" style="width: 100%" required>
                <option value="" selected disabled></option>
                @foreach($brands as $brand)
                <option value="{{ $brand->id }}" {{ @$edit && $brand->id == $category->brand->id ? 'selected' : '' }}>
                    {{ $brand->name }}
                </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="name" class="form-control-label">Nama Kategori</label>
            <input id="name" class="form-control" name="name" type="text" value="{{ @$edit ? $category->name : '' }}"
                required placeholder="Nama kategori">
        </div>
        <div class="form-group">
            <label for="lainlain" class="form-control-label">Lain Lain</label>
            <br>
            <label class="switch">
                <input @if(@$category->lainlain==0) @else checked=""
                @endif type="checkbox" name="lainlain">
                <span class="slider"></span>
            </label>
        </div>
        <div class="form-group">
            <label for="notes" class="form-control-label">Catatan</label>
            <input id="notes" class="form-control" name="notes" type="text"
                value="{{ @$edit ? $category->notes : '' }}" placeholder="Catatan">
            <small class="text-muted">Boleh dikosongkan</small>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal"> Batal</button>
        <button type="submit" class="btn btn-success"><i class="fa fa-check"></i>
            {{ @$edit ? 'Edit' : 'Simpan' }}
        </button>
    </div>
</form>

<script type="text/javascript">
    $(".brand").select2({
        placeholder: "Pilih Brand",
        allowClear: true,
        dropdownParent: $("#modalForm")
    });

</script>
