<div class="form-group">
	<div class="col-md-6 col-sm-6 col-xs-12">
		<input type="text" name="payment_or" id="payment_or" class="payment_or form-control col-md-7 col-xs-12"
			required
			data-parsley-required-message= "{{ trans('loans.paymentRequired') }}"
			data-parsley-remote
			data-parsley-remote-validator="validateOR"
			data-parsley-remote-message = "{{ trans('loans.validatePaymentOR') }}"
			style="text-transform:uppercase"
		>
	</div>
</div>