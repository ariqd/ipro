@extends('layouts.carbon')

@section('title', 'Dashboard')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <h1>Dashboard</h1>
    </div>
</div>
<div class="form-row text-light">
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
            <h2 class="font-weight-bold">{{ $salefinish }}</h2>
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
<div class="form-row">
    <div class="col-lg-8">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body p-0">
                        <canvas id="myChart" width="400"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="row">
            <div class="col-12">
                <div class="card text-dark">
                    <div class="card-body">
                        <h5 class="card-title"><i class="fa fa-exclamation-circle"></i> Notifikasi Pengiriman</h5>
                        @foreach ($salesByDate as $date => $sales)
                        <p class="mb-0"><b>{{ $date }}</b></p>
                        <ul class="list-unstyled">
                            @forelse ($sales as $sale)
                            <li><a href="{{ url('sales-orders/'.$sale->id) }}">{{ $sale->no_so ?? $sale->quotation_id }} ({{ $sale->delivery ? 'Terkirim' : 'Belum Dikirim' }})</a></li>
                            @empty
                            <li class="text-muted">Tidak ada pengiriman</li>
                            @endforelse
                        </ul>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push("script")
@php
 $salebydayf = json_encode(array_values($salebydayf));
 $salebydayu = json_encode(array_values($salebydayu));
@endphp
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
                data: {{ $salebydayf }},
                fill: false,
            }, {
                label: 'Unfinished Sales',
                fill: false,
                backgroundColor: 'rgba(255, 99, 132, 1)',
                borderColor: 'rgba(255, 99, 132, 1)',
                data: {{ $salebydayu }},
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
