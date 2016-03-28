<input type="hidden" class="payment_id" value="{{ $encryptID }}">

<div class="form-group">
	<div class="col-md-6 col-sm-6 col-xs-12">
		<input type="text" name="payment_amount" id="payment_amount" class="payment_amount form-control col-md-7 col-xs-12" placeholder=0.00
			required
			data-parsley-required-message= "{{ trans('loans.paymentRequired') }}"
			data-parsley-pattern="{{ config('loans.amountRegex') }}" 
			data-parsley-pattern-message="{{ trans('loans.amount') }}"
		> 
	</div>
</div>

<script>
	$(".payment_amount").blur(function(){
		$(this).val(addTwoZero($(this).val()));
	});
</script>