<form action="{{ @$isEdit ? url('items/'.$item->id) : url('items') }}" method="post">
    @csrf
    {{ @$isEdit ? method_field('PUT') : '' }}
    <div class="modal-header">
        <h5 class="modal-title">{{ @$isEdit? 'Edit' : 'Tambah' }} Item</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <div class="form-group row">
            <div class="col-lg-12">
                <label for="category" class="form-control-label">Category</label>
                <select class="category form-control" name="category_id" id="category">
                    <option></option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ @$isEdit && $category->id == $item->category_id }}>
                            {{ $category->brand->name . ' - ' . $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-lg-12">
                <label for="code" class="form-control-label">Kode Produk</label>
                <input autocomplete="off" id="code" class="form-control" name="code"
                       value="{{ @$isEdit ? $item->code : '' }}">
            </div>
        </div>
        {{--<div class="form-group row">--}}
        {{--<div class="col-lg-12">--}}
        {{--<label for="brand" class="form-control-label">Brand</label>--}}
        {{--@if(@$isEdit)--}}
        {{--<input id="brand" class="form-control" type="hidden" name="old_brand_id"--}}
        {{--value="{{ @$isEdit ? $item->brand_id : '' }}">--}}
        {{--@endif--}}
        {{--<select class="brand form-control" name="brand_id">--}}
        {{--<option></option>--}}
        {{--@foreach($brands as $brand)--}}
        {{--<option value="{{ $brand->id }}"> {{ $brand->name }} </option>--}}
        {{--@endforeach--}}
        {{--</select>--}}
        {{--</div>--}}
        {{--</div>--}}
        <div class="form-group row">
            <div class="col-lg-12">
                <label for="name" class="form-control-label">Nama Produk</label>
                <input autocomplete="off" id="name" class="form-control" name="name"
                       value="{{ @$isEdit ? $item->name : '' }}">
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

<script type="text/javascript">
    // $(".brand").select2({
    //     placeholder: "Pilih Brand",
    //     allowClear: true,
    //     dropdownParent: $("#modalForm")
    // });
    $(".category").select2({
        placeholder: "Pilih Kategori",
        allowClear: true,
        dropdownParent: $("#modalForm")
    });
</script>
