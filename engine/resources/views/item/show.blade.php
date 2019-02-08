<div class="modal-header">
    <h5 class="modal-title">Detail Produk - {{ $item->name }}</h5>
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
                    <td>{{ $item->brandname }}</td>
                </tr>
                <tr>
                    <td><b>Category</b></td>
                    <td>{{ $item->categoryname }}</td>
                </tr>
                <tr>
                    <td><b>Nama</b></td>
                    <td>{{ $item->name }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-danger" data-dismiss="modal"> Tutup</button>
</div>