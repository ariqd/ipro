<div class="modal-header">
    <h5 class="modal-title">Detail Stock - {{ $stock->item->name }}</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
    <div class="table-responsive">
        <table class="table table-borderless">
            <tbody>
            <tr>
                <td><b>Kode Produk</b></td>
                <td>{{ $stock->item->code }}</td>
            </tr>
            <tr>
                <td><b>Brand</b></td>
                <td>{{ $stock->item->category->brand->name }}</td>
            </tr>
            <tr>
                <td><b>Kategori</b></td>
                <td>{{ $stock->item->category->name }}</td>
            </tr>
            <tr>
                <td><b>Nama</b></td>
                <td>{{ $stock->item->name }}</td>
            </tr>
            <tr>
                <td><b>Cabang</b></td>
                <td>{{ $stock->branch->name }}</td>
            </tr>
            <tr>
                <td><b>Stok (per Batang)</b></td>
                <td>{{ $stock->quantity }} pcs</td>
            </tr>
            <tr>
                <td><b>Harga</b></td>
                <td>Rp {{ number_format($stock->price) }}</td>
            </tr>
            <tr>
                <td><b>Berat</b></td>
                <td>{{ $stock->weight }} Kg</td>
            </tr>
            <tr>
                <td><b>Area</b></td>
                <td>{{ $stock->area }} m2</td>
            </tr>
            <tr>
                <td><b>Lebar</b></td>
                <td>{{ $stock->width }} m</td>
            </tr>
            <tr>
                <td><b>Tinggi</b></td>
                <td>{{ $stock->height }} m</td>
            </tr>
            <tr>
                <td><b>Panjang</b></td>
                <td>{{ $stock->length }} m</td>
            </tr>
            </tbody>
        </table>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
</div>