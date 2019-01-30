<div class="modal-header">
    <h5 class="modal-title">Detail Produk - {{ $inventory->name }}</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
    <div class="table-responsive">
        <table class="table">
            <tbody>
            <tr>
                <td><b>Brand</b></td>
                <td>{{ $inventory->brand }}</td>
            </tr>
            <tr>
                <td><b>Kode Produk</b></td>
                <td>{{ $inventory->code }}</td>
            </tr>
            <tr>
                <td><b>Nama</b></td>
                <td>{{ $inventory->name }}</td>
            </tr>
            <tr>
                <td><b>Cabang</b></td>
                <td>{{ $inventory->branch }}</td>
            </tr>
            <tr>
                <td><b>Stok (per Batang)</b></td>
                <td>{{ $inventory->stock }} pcs</td>
            </tr>
            <tr>
                <td><b>Harga</b></td>
                <td>Rp {{ number_format($inventory->price) }}</td>
            </tr>
            <tr>
                <td><b>Berat</b></td>
                <td>{{ $inventory->weight }} Kg</td>
            </tr>
            <tr>
                <td><b>Area</b></td>
                <td>{{ $inventory->area }} m2</td>
            </tr>
            <tr>
                <td><b>Lebar</b></td>
                <td>{{ $inventory->width }} m</td>
            </tr>
            <tr>
                <td><b>Tinggi</b></td>
                <td>{{ $inventory->height }} m</td>
            </tr>
            <tr>
                <td><b>Panjang</b></td>
                <td>{{ $inventory->length }} m</td>
            </tr>
            </tbody>
        </table>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-danger" data-dismiss="modal"> Tutup</button>
</div>