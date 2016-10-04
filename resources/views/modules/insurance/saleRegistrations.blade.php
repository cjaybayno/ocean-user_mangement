@extends('layouts.gentelella')
@section('title', 'Sales Registration')
@section('addScripts')
	<script type="text/javascript">
        $(document).ready(function () {
			$('.select2').select2();
			
            // Smart Wizard 	
            $('#wizard').smartWizard({
				labelFinish:'Save',
				transitionEffect: 'slide',
				hideButtonsOnDisabled: true,
				onShowStep: function () {
					scrollTop();
				},
				onFinish: function () {
					alert('tapus na');
					$('#wizard').smartWizard('setError',{stepnum:1,iserror:true});
					$('#wizard').smartWizard('showMessage','Please correct the errors in the steps and continue');
				}
			});

            function onFinishCallback() {
                $('#wizard').smartWizard('showMessage', 'Finish Clicked');
                //alert('Finish Clicked');
            }
			
			function setError(stepnumber){
            $('#wizard').smartWizard('setError',{stepnum:1, iserror:true});
        }
			
			birthDateHandler();
			
			function birthDateHandler() {
				var selector = "#birth_date";
				$(selector).daterangepicker({
					singleDatePicker : true,
					calender_style : "picker_2",
					showDropdowns: true,
					startDate : moment().format('MM/DD/YYYY'),
					maxDate :  moment().format('MM/DD/YYYY'),
				});
			}
        });
    </script>
@endsection

@section('content')

<div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">
			<div class="x_title">
				<h2>Sales Registration</h2>
				<div class="clearfix"></div>
			</div>
			<div class="x_content">
				<!-- Smart Wizard -->
				<p>Please fill up the following forms completely.</p>
				<div id="wizard" class="form_wizard wizard_horizontal">
					<ul class="wizard_steps">
						<li>
							<a href="#step-1">
								<span class="step_no">1</span>
								<span class="step_descr">Step 1<br /><small>Personal Information</small></span>
							</a>
						</li> 
						<li>
							<a href="#step-2">
								<span class="step_no">2</span>
								<span class="step_descr">Step 2<br /><small>Product Information</small></span>
							</a>
						</li>
						<li>
							<a href="#step-3">
								<span class="step_no">3</span>
								<span class="step_descr">Step 3<br /><small>Policy Information</small></span>
							</a>
						</li>
					</ul>
					<div id="step-1">
						<form id="" class="form-horizontal form-label-left">
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12">Customer Reference<span class="required">*</span></label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<input type="text" name="" id="" required="required" class="form-control col-md-7 col-xs-12">
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12">Customer ID<span class="required">*</span></label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<input type="text" name="" id="" required="required" class="form-control col-md-7 col-xs-12">
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12">Title<span class="required">*</span></label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<input type="text" name="" id="" required="required" class="form-control col-md-7 col-xs-12">
								</div>
							</div>
							<p class="well well-sm">Name and Address</p>
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12">First Name<span class="required">*</span></label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<input type="text" name="" id="" required="required" class="form-control col-md-7 col-xs-12">
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12">Middle Name<span class="required">*</span></label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<input type="text" name="" id="" required="required" class="form-control col-md-7 col-xs-12">
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12">Last Name<span class="required">*</span></label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<input type="text" name="" id="" required="required" class="form-control col-md-7 col-xs-12">
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12">Current Address<span class="required">*</span></label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<input type="text" name="" id="" required="required" class="form-control col-md-7 col-xs-12">
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12">Present Address<span class="required">*</span></label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<input type="text" name="" id="" required="required" class="form-control col-md-7 col-xs-12">
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12">Date of Birth<span class="required">*</span></label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<input type="text" name="" id="birth_date" required="required" class="form-control col-md-7 col-xs-12">
								</div>
							</div>
							<p class="well well-sm">Contact Details</p>
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12">Mobile #1<span class="required">*</span></label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<input type="text" name="" id="" required="required" class="form-control col-md-7 col-xs-12">
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12">Mobile #2</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<input type="text" name="" id="" required="required" class="form-control col-md-7 col-xs-12">
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12">Landline Number</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<input type="text" name="" id="" required="required" class="form-control col-md-7 col-xs-12">
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12">Email Address</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<input type="text" name="" id="" required="required" class="form-control col-md-7 col-xs-12">
								</div>
							</div>
							<p class="well well-sm">ID's</p>
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12">Primary National ID<span class="required">*</span></label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<input type="text" name="" id="" required="required" class="form-control col-md-7 col-xs-12">
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12">Primary ID Number<span class="required">*</span></label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<input type="text" name="" id="" required="required" class="form-control col-md-7 col-xs-12">
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12">Secondary National ID</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<input type="text" name="" id="" required="required" class="form-control col-md-7 col-xs-12">
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12">Secondary ID Number</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<input type="text" name="" id="" required="required" class="form-control col-md-7 col-xs-12">
								</div>
							</div>
						</form>
					</div>
					<div id="step-2">
						<form id="" class="form-horizontal form-label-left">
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12">Country Code<span class="required"></span></label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<input type="text" name="" id="" value="Re-Populated" class="form-control col-md-7 col-xs-12" disabled>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12">Partner Code<span class="required">*</span></label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									{!! Form::select('partner_code', ['CHOOSE..', 'XIOMI', 'SAMSUNG', 'LENOVO'], null, [
										'class' => 'form-control select2',
										'id'    => 'partner_code',
									]) !!}
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12">Code<span class="required"></span></label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<input type="text" name="" id="" value="Pre-Populated" class="form-control col-md-7 col-xs-12" readonly>
								</div>
							</div>
							<p class="well well-sm">Product Details</p>
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12">Category<span class="required">*</span></label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									{!! Form::select('partner_code', ['CHOOSE..', 'Handsets', 'Phone', 'Screen'], null, [
										'class' => 'form-control select2',
										'id'    => 'product_category',
									]) !!}
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12">Sub Category<span class="required">*</span></label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									{!! Form::select('product_sub_category', ['CHOOSE..', 'Smartphone', 'TV'], null, [
										'class' => 'form-control select2',
										'id'    => 'product_sub_category',
									]) !!}
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12">Model</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<input type="text" name="" id="" value="TGHB-5235-AJ" class="form-control col-md-7 col-xs-12" readonly>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12">Description</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<input type="text" name="" id="" value="sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi" class="form-control col-md-7 col-xs-12" readonly>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12">Manufacturer</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<input type="text" name="" id="" value="This is the manufacturer data" class="form-control col-md-7 col-xs-12" readonly>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12">Price</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<input type="text" name="" id="" value="$ 100.00" class="form-control col-md-7 col-xs-12" readonly>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12">Warranty Period</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<input type="text" name="" id="" value="3 Months" class="form-control col-md-7 col-xs-12" readonly>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12">Expiration</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<input type="text" name="" id="" value="date(today) + Warranty Period" class="form-control col-md-7 col-xs-12" readonly>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12">Service Rate Band Code</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<input type="text" name="" id="" value="Phones from 100$ to 500$" class="form-control col-md-7 col-xs-12" readonly>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12">IMEI 1<span class="required">*</span></label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<input type="text" name="" id="" value="" class="form-control col-md-7 col-xs-12">
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12">IMEI 2<span class="required">*</span></label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<input type="text" name="" id="" value="" class="form-control col-md-7 col-xs-12">
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12">Serial Number<span class="required">*</span></label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<input type="text" name="" id="" value="" class="form-control col-md-7 col-xs-12">
								</div>
							</div>
						 </form>
					</div>
					<div id="step-3">
						<form id="" class="form-horizontal form-label-left">
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12">Policy Reference Number</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<input type="text" name="" id="" value="63564-85432-7-7" class="form-control col-md-7 col-xs-12" disabled>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12">Certificate Number<span class="required">*</span></label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<input type="text" name="" id=""  class="form-control col-md-7 col-xs-12" >
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12">Invoice Sales Date</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<input type="text" name="" id="" value="{{ date('Y/m/d') }}"  class="form-control col-md-7 col-xs-12" >
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12">Invoice Number<span class="required">*</span></label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<input type="text" name="" id="" value=""  class="form-control col-md-7 col-xs-12" >
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12">Price<span class="required">*</span></label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<input type="text" name="" id="" value=""  class="form-control col-md-7 col-xs-12" >
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12">Broker<span class="required">*</span></label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<input type="text" name="" id="" value=""  class="form-control col-md-7 col-xs-12" >
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12">Insurance Plan<span class="required">*</span></label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<input type="text" name="" id="" value=""  class="form-control col-md-7 col-xs-12" >
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12">Policy Start Date<span class="required">*</span></label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<input type="text" name="" id="" value=""  class="form-control col-md-7 col-xs-12" >
								</div>
							</div>
							<div class="form-group"><div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12">Policy End Date<span class="required">*</span></label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<input type="text" name="" id="" value=""  class="form-control col-md-7 col-xs-12" >
								</div>
							</div>
						</form>
					</div>
			</div>
		</div>
	</div>
</div>
@endsection