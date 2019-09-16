@extends('layouts.carbon')

@section('title')
{{ @$edit ? 'Edit' : 'Tambah' }} Gudang untuk Cabang {{ $branch->name }}
@endsection

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
                <form action="{{ @$edit ? url('warehouse/update') : url('warehouse/store') }}" method="POST">
                    @csrf
                    <div class="row justify-content-center">
                        <div class="col-12">
                            <div class="form-group row">
                                <label for="name" class="col-md-3 col-form-label text-md-right">Nama</label>

                                <div class="col-md-6">
                                    <input id="name" type="text"
                                        class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name"
                                        value="{{ old('name') }}" required autofocus placeholder="Nama Cabang">

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
                                        name="address" value="{{ old('address') }}" required autofocus
                                        placeholder="Alamat Cabang">

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
                                        name="notes" value="{{ old('notes') }}" required autofocus
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
                                <div class="col-md-3 offset-md-3">
                                    <button type="submit" class="btn btn-success">
                                        Submit
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
