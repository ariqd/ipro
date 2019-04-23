@extends('layouts.carbon')

@section('title', 'Sales Order')

@section('content')
{{--    <div class="container">--}}
	@if(!Gate::allows('isFinance'))
	<div class="row">
		<div class="col-lg-12">
			<div class="d-flex justify-content-between">
				<div>
					<h2><b>Sales Orders</b></h2>
				</div>
				<div>
					<a href="{{ url('sales-orders/create') }}" class="btn btn-dark"><i
						class="fa fa-plus"></i> Create Sales Quotation</a>
					</div>
				</div>
			</div>
		</div>
		@else
		<div class="row">
			<div class="col-lg-12">
				<div class="d-flex justify-content-between">
					<div>
						<h2><b>Sales Orders Approve</b></h2>
					</div>
				</div>
			</div>
		</div>
		@endif
		<div class="row">
			<div class="col-lg-12">
				<div class="table-responsive">
					<table class="table table-light">
						<thead>
							<tr>
								<th>Date</th>
								<th>Customer</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							@foreach($sales as $sale)
							<tr>
								<td>{{ $sale->created_at }}</td>
								<td>{{ $sale->customer->project_owner }}</td>
								<td>
									@if(!Gate::allows('isFinance'))
									<a href="{{ url('sales-orders/'.$sale->id) }}" class="btn btn-dark btn-sm">
										Show
									</a>
									<a href="{{ url('sales-orders/'.$sale->id.'/edit') }}" class="btn btn-secondary btn-sm">
										Edit
									</a>
									@else
									<a href="{{ url('sales-orders/'.$sale->id.'/payment') }}" class="btn btn-dark btn-sm">
										Approve Payment
									</a>
									@endif
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	{{--    </div>--}}
	@endsection
