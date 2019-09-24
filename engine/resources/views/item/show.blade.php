<div class="modal-header bg-dark text-light">
    <h5 class="modal-title">Detail Produk</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
    <div class="row">
        <div class="col-8">
            <p class="text-muted mb-0">{{ $item->category->brand->name }} - {{ $item->category->name }}</p>
            <h3><small>{{ $item->code }}</small> <br> {{ $item->name }}</h3>
        </div>
        <div class="col-4">
            <p class="float-right mb-0 text-muted">Harga Pricelist</p>
            <h4 class="float-right">Rp{{ number_format($item->purchase_price, 0, ',', '.') }}</h4>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <hr>
        </div>
    </div>
    <div class="row">
        <div class="col-4">
            <div class="text-center">
                <p class="text-muted mb-0">Berat</p>
                <h3>{{ $item->weight }} <small>Kg</small></h3>
            </div>
        </div>
        <div class="col-4">
            <div class="text-center">
                <p class="text-muted mb-0">Panjang</p>
                <h3>{{ $item->width }} <small>mm</small></h3>
            </div>
        </div>
        <div class="col-4">
            <div class="text-center">
                <p class="text-muted mb-0">Lebar</p>
                <h3>{{ $item->height }} <small>mm</small></h3>
            </div>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-4">
            <div class="text-center">
                <p class="text-muted mb-0">Kebutuhan per meter persegi</p>
                <h3>{{ $item->area }} <small>m2</small></h3>
            </div>
        </div>
        <div class="col-4">
            <div class="text-center">
                <h3 class="mb-0">{{ $item->pcs_per_pack }}</h3>
                <p class="text-muted mb-0">Pcs / Pack</p>
            </div>
        </div>
        <div class="col-4">
            <div class="text-center">
                <p class="text-muted mb-0">Kebutuhan per meter persegi</p>
                <h3>{{ $item->area }} <small>m2</small></h3>
            </div>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-12">
            <hr>
            <p class="text-muted mb-0">Catatan</p>
            <p>
                {{ $item->notes ?? '-' }}
            </p>
        </div>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-danger" data-dismiss="modal"> Tutup</button>
</div>
