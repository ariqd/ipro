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
                <label for="item" class="form-control-label">Pilih Item</label>
                <select class="item form-control" name="item_id" id="item">
                    <option></option>
                    @foreach($items as $item)
                        <option value="{{ $item->id }}" {{ @$isEdit && $item->id == $stock->item->id ? 'selected' : '' }}> {{ $item->name }}
                            ({{ $item->code }})
                        </option>
                    @endforeach
                </select>
                <a href="{{ url('items') }}" class="btn btn-secondary btn-block btn-sm my-3"><i class="fa fa-plus"></i>
                    Lihat Item</a>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-lg-12">
                <label for="branch" class="form-control-label">Cabang</label>
                <select class="branch form-control" name="branch_id" id="branch">
                    <option></option>
                    @foreach($branches as $branch)
                        <option value="{{ $branch->id }}" {{  @$isEdit && $branch->id == $stock->branch->id ? 'selected' : '' }}> {{ $branch->name }} </option>
                    @endforeach
                </select>
                <a href="{{ url('branches') }}" class="btn btn-secondary btn-block btn-sm my-3"><i
                            class="fa fa-plus"></i> Lihat Cabang</a>
            </div>
        </div>
        <div class="form-group">
            <label for="quantity" class="form-control-label">Quantity (per batang)</label>
            <div class="input-group">
                <input type="number" id="quantity" class="form-control" name="quantity"
                       value="{{ @$isEdit ? $stock->quantity : '' }}">
                <div class="input-group-append">
                    <span class="input-group-text">pcs</span>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="price_branch" class="form-control-label">Harga Cabang</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">Rp</span>
                </div>
                <input type="number" id="price_branch" class="form-control" name="price_branch"
                       value="{{ @$isEdit ? $stock->price_branch : '' }}" aria-describedby="price_branchHelpBlock">
                @if(@$isEdit)
                    <br>
                    <small id="price_branchHelpBlock" class="form-text text-muted">
                        Harga Beli: <b>Rp {{ number_format($stock->item->purchase_price) }}</b>
                    </small>
                @endif
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-link" data-dismiss="modal"> Batal</button>
        <button type="submit" class="btn btn-success"><i class="fa fa-check"></i>
            {{ @$isEdit ? 'Edit' : 'Tambah' }}
        </button>
    </div>
</form>

<script type="text/javascript">
    $(".item").select2({
        placeholder: "Pilih Item",
        allowClear: true,
        dropdownParent: $("#modalForm")
    });

    $(".branch").select2({
        placeholder: "Pilih Cabang",
        allowClear: true,
        dropdownParent: $("#modalForm")
    });
</script>