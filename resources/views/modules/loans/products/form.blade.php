@extends('layouts.gentelella')
@section('title', 'Loan Products')

@section('addStylesheets')
	
@endsection

@section('addScripts')
	
@endsection

@section('content')
<div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">
			<div class="x_title">
				@if ($viewType === 'create') 
					<h2>Create Products</h2>
				@endif 
				<div class="pull-right">
					@if ($viewType === 'create') 
						<div id="add-btn"  class="btn-group"></div> &nbsp
						<div id="edit-btn" class="btn-group"></div> &nbsp
					@endif
					<div class="btn-group">
						<a href="{{ URL::route('loan.products') }}">
							<button type="button" class="btn btn-block btn-sm btn-default"><i class="glyphicon glyphicon-th-list"></i> Show List</button>
						</a>
					</div>
				</div>
				<div class="clearfix"></div>
			</div>
			<div class="x_content">
				<form id="loan-products-create-form" class="form-horizontal form-label-left">
					<div id="loan-products-creation-result" class="col-sm-12"></div>
					
					<!-- left side form -->
					<div class="col-sm-6">
					
						<div class="col-md-offset-3">
							<div class="form-group col-md-10">
								<label class="control-label">Products Name<span class="required"> *</span></label><br>
								<div class="form-group has-feedback">
									<input type="text" name="product_name" class="form-control" id="product_name" style="text-transform:capitalize;"
										minlength="6"
										data-parsley-minlength-message= "{{ trans('users.min', ['min' => 6]) }}"
										required 
										data-parsley-required-message= "{{ trans('users.required') }}"
										value="{{ $loanProduct->name or '' }}">
								</div>
							</div>
						</div>
						
						<div class="col-md-offset-3">
							<div class="form-group col-md-10">
								<label class="control-label">Principal Amount<span class="required"> *</span></label><br>
								<div class="form-group has-feedback">
									<input type="text" name="principal_amount" class="form-control" id="principal_amount" placeholder ="0.00"
									required 
									data-parsley-required-message= "{{ trans('users.required') }}"
									value="{{ $loanProduct->principal or '' }}">
								</div>
							</div>
						</div>
						
						<div class="col-md-offset-3">
							<div class="form-group col-md-10">
								<label class="control-label">Term<span class="required"> *</span></label><br>
								<div class="form-group has-feedback">
									<input type="text" name="term" class="form-control" id="term" placeholder ="no. of months (minimun 12)"
									required 
									data-parsley-required-message= "{{ trans('users.required') }}"
									data-parsley-type='digits'
									data-parsley-min="12"
									value="{{ $loanProduct->principal or '' }}">
								</div>
							</div>
						</div>
						
					</div>
					
					<!-- right side form -->
					<div class="col-sm-6">
					
						<div class="form-group col-md-7">
							<label class="control-label">Interest Rate %<span class="required"> *</span></label><br>
							<div class="form-group has-feedback">
								<input type="text" name="interest_rate" class="form-control" id="interest_rate" placeholder="percentage %"
								required 
									data-parsley-required-message= "{{ trans('users.required') }}"
									data-parsley-pattern="\d+(\.\d{1,2})?"
									value="{{ $loanProduct->interest or '' }}">
							</div>
						</div>
						
						<div class="form-group col-md-7">
							<label class="control-label">Entity<span class="required"> *</span></label><br>
							<div class="form-group has-feedback">
								{!! Form::select('entity', $entities, null, ['class' => 'form-control select2', 'id' => 'entity', 'required']) !!}
							</div>
						</div>
						
						<div class="form-group col-md-7">
							<label class="control-label">Remarks<span class="required"></span></label><br>
							<textarea name="remarks" id="remarks" class="form-control" rows="3"></textarea>
						</div>
					
					</div>
					
					<div class="form-group">
						<div class="col-md-offset-2">
							<button type="submit" class="btn btn-default clear-btn">Clear</button>
							<button type="submit" id="form-submit" class="btn btn-success">Submit</button>
						</div>
					</div>
					
				</form>
			</div>
		</div>
	</div>
</div>
@endsection
