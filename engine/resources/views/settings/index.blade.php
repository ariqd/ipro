@extends('layouts.carbon')

@section('title', 'Settings')

@section('content')
<div class="row">
    <div class="col-12">
        <h2 class="font-weight-bold">Settings</h2>
    </div>
    <div class="col-12">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            {{-- <li class="nav-item">
                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home"
                    aria-selected="true">Summary</a>
            </li> --}}
            @if(Gate::allows('isFinance') || Gate::allows('isAdmin'))
            <li class="nav-item">
                <a class="nav-link active" id="periode-tab" data-toggle="tab" href="#periode" role="tab"
                    aria-controls="periode" aria-selected="false">Periode Finance</a>
            </li>
            @endif
        </ul>
        <div class="tab-content" id="myTabContent">
            {{-- <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">Summary</div> --}}
            @if(Gate::allows('isFinance') || Gate::allows('isAdmin'))
            <div class="tab-pane fade show active" id="periode" role="tabpanel" aria-labelledby="periode-tab">
                <form action="" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group row">
                                <label for="finance-period-start" class="col-sm-3 font-weight-bold col-form-label">
                                    Awal Periode :
                                </label>
                                <div class="col-sm-8">
                                    <input type="date" class="form-control" id="finance-period-start"
                                        value="{{ $settings['finance-period-start']->value }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group row">
                                <label for="finance-period-end" class="col-sm-3 font-weight-bold col-form-label">
                                    Akhir Periode :
                                </label>
                                <div class="col-sm-8">
                                    <input type="date" class="form-control" id="finance-period-end"
                                        value="{{ $settings['finance-period-end']->value }}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success">Simpan</button>
                </form>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection