@extends('layouts.carbon')

@section('title', 'Form Set Komisi')

@push("js")
    <script src="{{ asset('assets/js/scripts.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cleave.js/1.5.0/cleave.js"
            integrity="sha256-cKDTH0H5beL+NbNqIPKJ9F4o19obOcC07Gd+KLaKbAU=" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function () {
            var cleave = new Cleave('.cleave', {
                numeral: true,
                numeralThousandsGroupStyle: 'thousand'
            });
        });
    </script>
@endpush

@section('content')
    <div class="row">
        <div class="col-8">
            <h2 class="font-weight-bold">Set Komisi {{ $user->name }}</h2>
        </div>
        <div class="col-4">
            <h4 class="float-right">Periode {{ $from }} - {{ $to }}</h4>
        </div>
    </div>

    <div class="row">
        <div class="col-8 offset-2">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('finances.komisi.store', $user) }}" method="post">
                        @csrf

                        <div class="form-group d-none">
                            <label for="percentage" class="font-weight-bold">Persentase Komisi (%)</label>
                            <div class="input-group">
                                <input type="text" value="100" name="percentage" id="percentage" class="form-control">
                                <div class="input-group-append">
                                    <span class="input-group-text">%</span>
                                </div>
                            </div>
                            <small>Persentase komisi untuk periode saat ini</small>
                        </div>

                        <div class="form-group">
                            <label for="achievement" class="font-weight-bold">Achievement</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Rp</span>
                                </div>
                                <input type="text" name="achievement" id="achievement" class="form-control cleave">
                            </div>
                        </div>

                        <button type="submit" class="btn btn-success">Submit</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
