<div class="modal-header bg-dark text-light">
    <h5 class="modal-title">Detail Kategori</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
    <div class="row">
        <div class="col-8">
            <p class="text-muted mb-0">{{ $category->brand->name }}</p>
            <h3>{{ $category->name }}</h3>
        </div>
    </div>
    {{-- <div class="row">
        <div class="col-12">
            <hr>
        </div>
    </div> --}}
    <div class="row">
        <div class="col-12">
            <table class="table table-bordered">
                <tr>
                    <th>Tanggal Dibuat</th>
                    <td>{{ $category->created_at->toDayDateTimeString() }}</td>
                </tr>
                <tr>
                    <th>Tanggal Diubah</th>
                    <td>{{ $category->updated_at->toDayDateTimeString() }}</td>
                </tr>
            </table>
        </div>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-danger" data-dismiss="modal"> Tutup</button>
</div>
