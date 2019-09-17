@extends('layouts.carbon')

@section('title')
{{ @$edit ? 'Edit' : 'Tambah' }} Gudang untuk Cabang {{ $branch->name }}
@endsection

@push('js')
<script type="text/javascript">
    $('.btnDelete').on('click', function (e) {
        e.preventDefault();
        var parent = $(this).parent();

        swal({
                title: "Apa anda yakin?",
                text: "Data akan terhapus secara permanen!",
                icon: "warning",
                buttons: true,
                dangerMode: true
            })
            .then(function (willDelete) {
                if (willDelete) {
                    parent.find('.formDelete').submit();
                }
            });
    });

</script>
@endpush

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="d-flex justify-content-between">
            <h2>
                {{ @$edit ? 'Edit' : 'Tambah' }} Gudang untuk Cabang {{ $branch->name }}
            </h2>
            <div>
                <a href="{{ url('branches') }}" class="btn btn-light">
                    <i class="fa fa-arrow-left"></i> Kembali
                </a>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form action="{{ @$edit ? url('warehouse/'.$warehouse->id.'/update') : url('warehouse/store') }}"
                    method="POST">
                    @csrf
                    {{ @$edit ? method_field('PUT') : '' }}
                    <div class="row justify-content-center">
                        <div class="col-12">
                            <div class="form-group row">
                                <label for="name" class="col-md-3 col-form-label text-md-right">Nama Gudang</label>

                                <div class="col-md-6">
                                    <input id="name" type="text"
                                        class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name"
                                        value="{{ $edit ? $warehouse->name : old('name') }}" required
                                        placeholder="Nama Cabang">

                                    @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="address" class="col-md-3 col-form-label text-md-right">Alamat</label>

                                <div class="col-md-6">
                                    <input id="address" type="text"
                                        class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}"
                                        name="address" value="{{ $edit ? $warehouse->address : old('address') }}"
                                        required placeholder="Alamat Cabang">

                                    @if ($errors->has('address'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('address') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="notes" class="col-md-3 col-form-label text-md-right">Catatan</label>

                                <div class="col-md-6">
                                    <input id="notes" type="text"
                                        class="form-control{{ $errors->has('notes') ? ' is-invalid' : '' }}"
                                        name="notes" value="{{ $edit ? $warehouse->notes : old('notes') }}" required
                                        placeholder="Catatan">

                                    @if ($errors->has('notes'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('notes') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <input type="hidden" name="branch_id" value="{{ $branch->id }}">

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-3">
                                    <button type="submit" class="btn btn-success">
                                        <i class="fa fa-check"></i> Submit
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <a href="#" class="btn btn-danger float-right btnDelete">
                    <i class="fa fa-exclamation-circle"></i> Hapus Gudang
                </a>
                <form action="{{ url('warehouse/'.$warehouse->id . '/destroy') }}" method="post"
                    class="formDelete d-none">
                    {!! csrf_field() !!}
                    {!! method_field('delete') !!}
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
