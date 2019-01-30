<div class="modal-header">
    <h5 class="modal-title">Cabang</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
    <div class="row">
        <div class="col-lg-8">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Status</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($branches as $branch)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $branch->id }}</td>
                            <td>{{ $branch->name }}</td>
                            <td>{{ $branch->status }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-lg-4">
            <h3>Tambah Cabang</h3>
        </div>
    </div>
    {{--<a href="#modalForm" data-toggle="modal" data-href="{{ url('branches/create') }}"--}}
       {{--class="btn btn-dark btn-block mb-3"><i class="fa fa-plus"></i> Tambah Cabang</a>--}}

</div>
<div class="modal-footer">
    {{--<a href="#modalForm" data-toggle="modal" data-href="{{ url('branches/create') }}"--}}
       {{--class="btn btn-dark"><i class="fa fa-plus"></i> Tambah Cabang</a>--}}
    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Tutup</button>
</div>
