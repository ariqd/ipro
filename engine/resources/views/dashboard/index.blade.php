@extends('layouts.carbon')

@section('title', 'Dashboard')

@section('content')
<div class="row">
	<div class="col-lg-12">
		<h1>Dashboard</h1>
	</div>
</div>

<div class="form-row text-white">
	<div class="col-lg-12">
		<div class="card p-3 bg-dark">
			<h2 class="font-weight-bold">Filter</h2>
			<form action="{{ url("dashboard") }}" method="GET">
				Bulan
				<select name="month">
					<option value="{{$month}}" selected="">{{ $monthname }}</option>
					<option disabled=""><hr></option>
					<option value="1">January</option>
					<option value="2">February</option>
					<option value="3">March</option>
					<option value="4">April</option>
					<option value="5">May</option>
					<option value="6">June</option>
					<option value="7">July</option>
					<option value="8">August</option>
					<option value="9">September</option>
					<option value="10">October</option>
					<option value="11">November</option>
					<option value="12">December</option>
				</select>
				Tahun
				<select name="year">
					<option value="2019" selected="">2019</option>
				</select>
				<select name="branch">
					@foreach($branches as $branch)
					<option value="{{ $branch->id }}">{{ $branch->name }}</option>
					@endforeach
				</select>
				<input type="submit" name="" value="Filter!">
			</form>
		</div>
	</div>
	<div class="col-lg-3">
		<div class="card p-3 @if($revenue<=700000000) bg-danger @else bg-success  @endif">
			<h2 class="font-weight-bold">Rp {{ number_format($revenue) }}</h2>
			<span>Dari {{ $salefinish }} penjualan bulan ini</span>
		</div>
	</div>

	<div class="col-lg-3">
		<div class="card p-3 @if($ton<=50) bg-danger @else bg-success  @endif">
			<h2 class="font-weight-bold">{{ $ton }}</h2>
			<span>Ton terjual</span>
		</div>
	</div>

	<div class="col-lg-3">
		<div class="card p-3 @if($salefinish == 0) bg-warning @else bg-success  @endif">
			<h2 class="font-weight-bold">{{ $salefinish }}</h2>
			<span>Sales order selesai</span>
		</div>
	</div>

	<div class="col-lg-3">
		<div class="card p-3 @if($saleunfinish>0) bg-warning @else bg-success  @endif">
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
		<div class="col-lg-12">
			<div class="card">
				<div class="card-body p-0">
					{{--                        <div class="row">--}}
						{{--                            <div class="col-lg-12">--}}
							<canvas id="pie" width="400"></canvas>
						{{--                            </div>--}}
					{{--                        </div>--}}
				</div>
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
	var bar ={
		type: 'bar',
		data: {!! $bar !!},
		options : {
			scales: {
				xAxes: [{
					barPercentage: 0.5,
					barThickness: 6,
					maxBarThickness: 8,
					minBarLength: 2,
					gridLines: {
						offsetGridLines: true
					}
				}]
			}
		}
	};


	window.onload = function () {
		var ctx = document.getElementById('myChart').getContext('2d');
		window.myLine = new Chart(ctx, config);

		var ctpie = document.getElementById('pie').getContext('2d');
		var pieChart = new Chart(ctpie, bar);
	}
</script>
@endpush