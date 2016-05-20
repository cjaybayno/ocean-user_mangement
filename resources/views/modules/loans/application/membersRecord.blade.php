<p class="well well-sm">Loans Availed</p>

<?php $grandTotalPayment = 0 ?>
@foreach ($loanAvails as $loanAvail)
	<div class="col-md-offset-2 col-md-8 col-sm-offset-2 col-sm-8 col-xs-12">
		<div class="x_panel">
			<div class="x_title">
				<h2>{{ $loanAvail['product_name'] }}</h2>
				<div class="clearfix"></div>
			</div>
			<div class="x_content">
				<table class="table table-hover table-striped">
					<thead>
						<tr>
							<th>Date</th>
							<th>Principal</th>
							<th>Interest</th>
							<th>Payment</th>
							<th>Remaining Balance</th>
						</tr>
					</thead>
					<tbody>
						<?php $principalFlag  = 0 ?>
						<?php $totalInterest  = 0 ?>
						<?php $totalPayment   = 0 ?>
						<?php $totalRemainBal = 0 ?>
						@foreach ($loanAvail['data'] as $loanAvailData)
						<tr>
							<td>{{ $loanAvailData->date }}</th>
							<td>
								@if ($principalFlag == 0)
									{{ $loanAvail['principal'] }}
									<?php $principalFlag++ ?>
								@endif
							</td>
							<td>{{ $loanAvail['interest'] }}%</td>
							<td>PHP {{ number_format($loanAvailData->amount, 2) }}</td>
							<td>PHP {{ number_format($loanAvailData->remaining_balance, 2) }} </td>
						</tr>
						<?php $totalInterest  	 = $totalInterest + $loanAvail['interest'] ?>
						<?php $totalPayment   	 = $totalPayment  + $loanAvailData->amount ?>
						<?php $grandTotalPayment = $grandTotalPayment + $loanAvailData->amount ?>
						<?php $totalRemainBal 	 = $loanAvailData->remaining_balance ?>
						@endforeach
					</tbody>
					<tfoot>
						<tr>
							<th>Total</th>
							<td></td>
							<th>{{ $totalInterest }}%</th>
							<th>PHP {{ number_format($totalPayment, 2) }}</th>
							<th>PHP {{ number_format($totalRemainBal, 2) }}</th>
						</tr>
					</tfoot>
				</table>
			</div>
		</div>
	</div>
	<div class="clearfix"></div> <br>
@endforeach

@if (! empty($loanAvails))
	<div class="col-md-offset-2 col-md-8 col-sm-offset-2 col-sm-8 col-xs-12">
		<h2>TOTAL : PHP {{ number_format($grandTotalPayment, 2) }}</h2>
	</div>
@else
	<div class="col-md-offset-2 col-md-8 col-sm-offset-2 col-sm-8 col-xs-12">
		<div class="alert alert-warning">
			<i>
				<center>
					{{ trans('loans.noLoanAvalied') }} <br>
					<b><a href="{{ URL::route('loan.application.form') }}">Apply now click here </a></b>
				</center>
			</i>
		</div>
	</div>
@endif 