@extends('layouts.carbon')

@section('title', 'Dashboard')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-lg-12">
			<h1>Dashboard</h1>
		</div>
	</div>

	<div class="card">
		<div class="card-body">
			<div class="row" style="color: white">
				<div class="card col-lg-3 bg-success">
					<h5>Monthly Sales ({{ $salefinish }})</h5>
					<p><span>Rp {{ number_format($revenue) }}</span></p>
				</div>

				<div class="card col-lg-3 bg-info">
					<h5>Unit Sold (TON)</h5>
					<p><span>{{ $ton }}</span></p>

				</div>

				<div class="card col-lg-3 bg-warning">
					<h5>Sales Orders</h5>
					<p><span>{{ $totalsale }}</span></p>

				</div>

				<div class="card col-lg-3 bg-danger">
					<h5>Unfinished Sales Order</h5>
					<p><span>{{ $saleunfinish }}</span></p>
				</div>
			</div>

			<div class="row">
				<div class="col-lg-12">
					<canvas id="myChart" width="400"></canvas>
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

	window.onload = function() {
		var ctx = document.getElementById('myChart').getContext('2d');
		window.myLine = new Chart(ctx, config);	
	};

</script>   
@endpush