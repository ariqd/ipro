<form action="{{  url('sales-orders/create/customer') }}" method="post">
    @csrf
    <div class="modal-header">
        <h5 class="modal-title">Add Customer</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <div class="form-group row">
            <div class="col-lg-12">
                <label for="project_owner" class="form-control-label">Project Owner</label>
                <input id="project_owner" class="form-control" name="project_owner"
                       value="{{ @$isEdit ? $customer->project_owner : '' }}">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-lg-12">
                <label for="no_ktp" class="form-control-label">No. KTP</label>
                <input id="no_ktp" class="form-control" name="no_ktp" value="{{ @$isEdit ? $customer->no_ktp : '' }}">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-lg-12">
                <label for="phone" class="form-control-label">Phone</label>
                <input id="phone" class="form-control" name="phone" value="{{ @$isEdit ? $customer->phone : '' }}">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-lg-12">
                <label for="address" class="form-control-label">Address</label>
                <textarea name="address" id="address" class="form-control"></textarea>
                {{--<input id="phone" class="form-control" name="phone" value="{{ @$isEdit ? $customer->phone : '' }}">--}}
            </div>
        </div>
        <div class="form-group row">
            <div class="col-lg-12">
                <label for="fax" class="form-control-label">Fax</label>
                <input id="fax" class="form-control" name="fax" value="{{ @$isEdit ? $customer->fax : '' }}">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-lg-12">
                <label for="email" class="form-control-label">Email</label>
                <input id="email" type="email" class="form-control" name="email" value="{{ @$isEdit ? $customer->email : '' }}">
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal"> Cancel</button>
        <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i>
            Submit
        </button>
    </div>
</form>