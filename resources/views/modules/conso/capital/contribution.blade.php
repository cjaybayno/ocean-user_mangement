@extends('layouts.gentelella')
@section('title', 'Consolidation')

@section('addScripts')
	<script>
		$('.number-format').number(true, 2);
	</script>
@endsection

@section('content')
<div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">
			 <div class="x_title">
				<h2>Capital Contributions<small>as of {{ date('l F jS, Y') }}</small></h2>
				<div class="pull-right">
					<div class="btn-group">
						<a href="{{ URL::route('conso.capital')}}">
							<button type="button" class="btn btn-block btn-sm btn-primary"><i class="glyphicon glyphicon-arrow-left"></i> Capital Consolidation</button>
						</a>
					</div>
				</div>
				<div class="clearfix"></div>
			</div>
			<div class="x_content">				
				<table class="table table-hover">
					<thead>
						<tr>
							<th>Member Name</th>
							@foreach ($monthNames as $monthName)
								<th>{{ ucwords($monthName) }}</th>
							@endforeach
							<th>Total</th>
						</tr>
					</thead>
					<tbody>
						@foreach($contributions as $contribution)
							<tr>
								<td>{{ $contribution->member_name }}</td>
								@foreach ($monthNames as $monthName)
									<td class="number-format">{{ $contribution->$monthName or '0'}}</td>
								@endforeach
								<td class="number-format">{{ $contribution->total }}</td>
							</tr>
						@endforeach
					</tbody>
					<tfoot>
						<tr>
							<th>TOTAL</th>
							@foreach ($monthlyTotals as $monthlyTotal)
								<th class="number-format">{{ $monthlyTotal }}</th>
							@endforeach
							<th class="number-format">{{ $overAllTotal }}</th>
						</tr>
					</tfoot>
				</table>
			</div>
		</div>
	</div>
</div>
@endsection

