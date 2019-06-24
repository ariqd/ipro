@extends('layouts.carbon')

@section('title', 'Home')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        @if(Gate::allows('isFinance'))
        <div class="col-md-12">
          <div class="alert alert-info alert-dismissible fade show" role="alert">
            <strong><i class="fa fa-info-circle"></i> Ada {{ $unfinished }} Penjualan Belum Di Approve</strong> {!! @session('info') !!}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    </div>
    @endif
    <div class="col-md-8">
        <h1 class="text-center">
            Today's News
        </h1>
        <img src="https://via.placeholder.com/500x300" alt="alt" style="width: 100%">
        <h3 class="mt-3">
            Conwood Membangun Pabrik Baru Seluas 8,2 Hektar di Indonesia
        </h3>
        <p>
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Commodi et quae quibusdam suscipit vero. At doloremque, earum est illo quis sapiente similique temporibus vero. Asperiores beatae culpa maiores nulla sapiente.
        </p>
    </div>
</div>
</div>
@endsection
