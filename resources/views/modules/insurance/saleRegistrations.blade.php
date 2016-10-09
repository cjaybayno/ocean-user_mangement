@extends('layouts.gentelella')
@section('title', 'Sales Registration')
@section('content')
<div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">
			<div class="x_title">
				<h2>Sales Registration</h2>
				<div class="clearfix"></div>
			</div>
			<div class="x_content">
				<div id="wizard" class="form_wizard wizard_horizontal">
					<ul class="wizard_steps">
						<li>
							<a href="#step-1">
								<span class="step_no">1</span>
								<span class="step_descr">Step 1<br /><small>Choose Partner and Program</small></span>
							</a>
						</li>
						<li>
							<a href="#step-2">
								<span class="step_no">2</span>
								<span class="step_descr">Step 2<br /><small>Personal Information</small></span>
							</a>
						</li>						
						<li>
							<a href="#step-3">
								<span class="step_no">3</span>
								<span class="step_descr">Step 3<br /><small>Product Information</small></span>
							</a>
						</li>
					</ul>
					<div id="step-1">
						<form id="" class="form-horizontal form-label-left">
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12">Partner Name<span class="required">*</span></label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									{!! Form::select('partner_name', ['CHOOSE..', 'XIOMI', 'SAMSUNG', 'LENOVO'], null, [
										'class' => 'form-control select2',
										'id'    => 'partner_name',
									]) !!}
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12">Program Name<span class="required">*</span></label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									{!! Form::select('program_name', ['Pre-Populated dependent to partner name', 'Program name 1', 'Program name 1', 'Program name 1'], null, [
										'class' => 'form-control select2',
										'id'    => 'program_name',
									]) !!}
								</div>
							</div>
						</form>
					</div>
					<div id="step-2">
						<form id="" class="form-horizontal form-label-left">
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12">Customer Reference No.</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<input type="text" name="" id="" required="required" class="form-control col-md-7 col-xs-12">
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12">Customer ID</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<input type="text" name="" id="" value="System Generated" class="form-control col-md-7 col-xs-12" readonly>
								</div>
							</div>
							<p class="well well-sm">Name and Address</p>
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12">Title<span class="required">*</span></label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<input type="text" name="" id="" required="required" class="form-control col-md-7 col-xs-12">
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12">First Name<span class="required">*</span></label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<input type="text" name="" id="" required="required" class="form-control col-md-7 col-xs-12">
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12">Middle Name</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<input type="text" name="" id="" class="form-control col-md-7 col-xs-12">
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
								<label class="control-label col-md-3 col-sm-3 col-xs-12">Permanent Address<span class="required">*</span></label>
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
									{!! Form::select('primary_national_id', ['CHOOSE..', 'SSS', 'GSIS', 'TIN', 'Drivers License'], null, [
										'class' => 'form-control select2',
										'id'    => 'primary_national_id',
									]) !!}
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
									{!! Form::select('secondary_national_id', ['CHOOSE..', 'SSS', 'GSIS', 'TIN', 'Drivers License'], null, [
										'class' => 'form-control select2',
										'id'    => 'secondary_national_id',
									]) !!}
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
					<div id="step-3">
						<form id="" class="form-horizontal form-label-left">
							<p class="well well-sm">Choose Product</p>
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12">Code</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<input type="text" name="" id="" class="form-control col-md-7 col-xs-12">
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12">Description</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									{!! Form::select('partner_desc', ['CHOOSE..', 'Product 1', 'Product 2', 'Product 3'], null, [
										'class' => 'form-control select2',
										'id'    => 'partner_desc',
									]) !!}
								</div>
							</div>
							<p class="well well-sm">Product Details</p>
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12">Model</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<input type="text" name="" id="" value="pre-populated if exists or entered by the user " class="form-control col-md-7 col-xs-12" readonly>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12">Manufacturer</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<input type="text" name="" id="" value="Pre-Populated" class="form-control col-md-7 col-xs-12" readonly>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12">Manufacturer Period</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<input type="text" name="" id="" value="Pre-Populated" class="form-control col-md-7 col-xs-12" readonly>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12">Price</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<input type="text" name="" id="" value="$100.00" class="form-control col-md-7 col-xs-12" readonly>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12">Expiration</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<input type="text" name="" id="" value="date(today) + Warranty Period" class="form-control col-md-7 col-xs-12" readonly>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12">Invoice No.<span class="required">*</span></label>
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
							<p class="well well-sm">Service Details</p>
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12">Product Service <span class="required">*</span></label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									{!! Form::select('partner_code', ['Pre-Populated from service mapping table'], null, [
										'class' => 'form-control select2',
										'id'    => 'product_category',
									]) !!}
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12">Category</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									{!! Form::select('partner_code', ['Pre-Populated (display only)'], null, [
										'class' => 'form-control select2',
										'id'    => 'product_category',
									]) !!}
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12">Sub Category</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									{!! Form::select('product_sub_category', ['Pre-Populated (display only)'], null, [
										'class' => 'form-control select2',
										'id'    => 'product_sub_category',
									]) !!}
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12">Policy Plan</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<input type="text" name="" id="" value="Pre-Populated" class="form-control col-md-7 col-xs-12" disabled>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12">Policy Term</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									{!! Form::select('policy_term', ['Pre-Populated dependent to policy plan'], null, [
										'class' => 'form-control select2',
										'id'    => 'policy_term',
									]) !!}
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12">Policy Start Date<span class="required">*</span></label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<input type="text" name="" id="" value=""  class="form-control col-md-7 col-xs-12" >
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12">Policy End Date<span class="required">*</span></label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<input type="text" name="" id="" value=""  class="form-control col-md-7 col-xs-12" >
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12">Policy Price<span class="required">*</span></label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<input type="text" name="" id="" value="$100.00"  class="form-control col-md-7 col-xs-12" >
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection