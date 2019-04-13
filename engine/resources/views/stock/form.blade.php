<form action="{{ @$isEdit ? url('stocks/'.$stock->id) : url('stocks') }}" method="post">
    @csrf
    {{ @$isEdit ? method_field('PUT') : '' }}
    <div class="modal-header">
        <h5 class="modal-title">{{ @$isEdit? 'Edit' : 'Tambah' }} Produk</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <div class="form-group row">
            <div class="col-lg-12">
                <label for="item" class="form-control-label">Item</label>
                {{--@if(@$isEdit)--}}
                {{--<input id="item" class="form-control" type="hidden" name="old_item_id"--}}
                {{--value="{{ @$isEdit ? $stock->brand_id : '' }}">--}}
                {{--@endif--}}
                <select class="item form-control" name="item_id" id="item">
                    <option></option>
                    @foreach($items as $item)
                        <option value="{{ $item->id }}" {{ @$isEdit && $item->id == $stock->item->id ? 'selected' : '' }}> {{ $item->name }}
                            ({{ $item->code }})
                        </option>
                    @endforeach
                </select>
                <a href="{{ url('items') }}" class="btn btn-secondary btn-block btn-sm my-3"><i class="fa fa-plus"></i>
                    View Items</a>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-lg-12">
                <label for="branch" class="form-control-label">Cabang</label>
                {{--@if(@$isEdit)--}}
                    {{--<input id="branch" class="form-control" type="hidden" name="old_branch_id"--}}
                           {{--value="{{ @$isEdit ? $stock->branch_id : '' }}">--}}
                {{--@endif--}}
                <select class="branch form-control" name="branch_id" id="branch">
                    <option></option>
                    @foreach($branches as $branch)
                        <option value="{{ $branch->id }}" {{  @$isEdit && $branch->id == $stock->branch->id ? 'selected' : '' }}> {{ $branch->name }} </option>
                    @endforeach
                </select>
                <a href="{{ url('branches') }}" class="btn btn-secondary btn-block btn-sm my-3"><i
                            class="fa fa-plus"></i> View Branches</a>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-lg-12">
                <label for="quantity" class="form-control-label">Quantity (per batang)</label>
                <input type="number" id="quantity" class="form-control" name="quantity"
                       value="{{ @$isEdit ? $stock->quantity : '' }}">
            </div>
        </div>
{{--        <div class="form-group row">--}}
{{--            <div class="col-lg-12">--}}
{{--                <label for="weight" class="form-control-label">Berat (Kg)</label>--}}
{{--                <input type="number" id="weight" class="form-control" step=".0001" name="weight"--}}
{{--                       value="{{ @$isEdit ? $stock->weight : '' }}">--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="form-group row">--}}
{{--            <div class="col-lg-12">--}}
{{--                <label for="area" class="form-control-label">Area (m2)</label>--}}
{{--                <input type="number" id="area" class="form-control" step=".0001" name="area"--}}
{{--                       value="{{ @$isEdit ? $stock->area : '' }}">--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="form-group row">--}}
{{--            <div class="col-lg-12">--}}
{{--                <label for="width" class="form-control-label">Lebar (m)</label>--}}
{{--                <input type="number" id="width" class="form-control" step=".0001" name="width"--}}
{{--                       value="{{ @$isEdit ? $stock->width : '' }}">--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="form-group row">--}}
{{--            <div class="col-lg-12">--}}
{{--                <label for="height" class="form-control-label">Tinggi (m)</label>--}}
{{--                <input type="number" id="height" class="form-control" step=".0001" name="height"--}}
{{--                       value="{{ @$isEdit ? $stock->height : '' }}">--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="form-group row">--}}
{{--            <div class="col-lg-12">--}}
{{--                <label for="length" class="form-control-label">Panjang (m)</label>--}}
{{--                <input type="number" id="length" class="form-control" step=".0001" name="length"--}}
{{--                       value="{{ @$isEdit ? $stock->length : '' }}">--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="form-group row">--}}
{{--            <div class="col-lg-12">--}}
{{--                <label for="price" class="form-control-label">Harga / unit (Rp)</label>--}}
{{--                <input type="number" id="price" class="form-control" name="price"--}}
{{--                       value="{{ @$isEdit ? $stock->price : '' }}">--}}
{{--            </div>--}}
{{--        </div>--}}
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal"> Batal</button>
        <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i>
            {{ @$isEdit ? 'Edit' : 'Tambah' }}
        </button>
    </div>
</form>

<script type="text/javascript">
    $(".item").select2({
        placeholder: "Choose Items",
        allowClear: true,
        dropdownParent: $("#modalForm")
    });

    $(".branch").select2({
        placeholder: "Choose Branch",
        allowClear: true,
        dropdownParent: $("#modalForm")
    });
</script>