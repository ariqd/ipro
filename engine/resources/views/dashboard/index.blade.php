@extends('layouts.carbon')

@section('title', 'Dashboard')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1>Dashboard</h1>
        </div>
    </div>

    <div class="form-row text-white">

        <div class="col-lg-3">
            <div class="card p-3 bg-dark">
                <h2 class="font-weight-bold">Rp {{ number_format($revenue) }}</h2>
                <span>Dari {{ $salefinish }} penjualan bulan ini</span>
            </div>
        </div>

        <div class="col-lg-3">
            <div class="card p-3 bg-info">
                <h2 class="font-weight-bold">{{ $ton }}</h2>
                <span>Ton terjual</span>
            </div>
        </div>

        <div class="col-lg-3">
            <div class="card p-3 bg-success">
                <h2 class="font-weight-bold">{{ $salefinish}}</h2>
                <span>Sales order selesai</span>
            </div>
        </div>

        <div class="col-lg-3">
            <div class="card p-3 bg-danger">
                <h2 class="font-weight-bold">{{ $saleunfinish }}</h2>
                <span>Sales order belum selesai</span>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body p-0">
                    {{--                        <div class="row">--}}
                    {{--                            <div class="col-lg-12">--}}
                    <canvas id="myChart" width="400"></canvas>
                    {{--                            </div>--}}
                    {{--                        </div>--}}
                </div>
            </div>
        </div>
    </div>
@endsection

@push("script")
    <script>
        var Day = {!! json_encode(array_values($countday)) !!};
        var config = {
            type: 'line',
            data: {
                labels: Day,
                datasets: [{
                    label: 'Finished Sales',
                    borderColor: 'rgba(20, 99, 255, 1)',
                    backgroundColor: 'rgba(20, 99, 255, 1)',
                    data: {!! json_encode(array_values($salebydayf)) !!},
                    fill: false,
                }, {
                    label: 'Unfinished Sales',
                    fill: false,
                    backgroundColor: 'rgba(255, 99, 132, 1)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    data: {!! json_encode(array_values($salebydayu)) !!},
                }]
            },
            options: {
                responsive: true,
                title: {
                    display: true,
                    text: 'Sales Vs Date'
                },
                tooltips: {
                    mode: 'index',
                    intersect: false,
                },
                hover: {
                    mode: 'nearest',
                    intersect: true
                },
                scales: {
                    xAxes: [{
                        display: true,
                        scaleLabel: {
                            display: true,
                            labelString: 'Hari'
                        }
                    }],
                    yAxes: [{
                        display: true,
                        scaleLabel: {
                            display: true,
                            labelString: 'Value'
                        },
                        ticks: {
                            min: 0,
                            stepSize: 1
                        }
                    }]
                }
            }
        };

        window.onload = function () {
            var ctx = document.getElementById('myChart').getContext('2d');
            window.myLine = new Chart(ctx, config);
        };

    </script>
@endpush