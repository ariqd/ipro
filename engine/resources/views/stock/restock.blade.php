<form action="{{ url('stocks/'.$stock->id.'/restock')  }}" method="post">
    @csrf
    <div class="modal-header">
        <h5 class="modal-title">Restock {{ $stock->branchname .' | '. $stock->itemname }}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <div class="form-group row">
            <div class="col-lg-12">
                <label for="add" class="form-control-label">Restock Qty</label>
                <input id="add" class="form-control" name="add" type="number">
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
        <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i>
            Submit
        </button>
    </div>
</form>