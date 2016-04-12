@extends('layouts.gentelella')
@section('title', 'Loan Products')
@section('content')
<div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">
			<div class="x_title">
				@if ($viewType === 'create')
					<h2>Create Products</h2>
				@elseif ($viewType === 'view')
					<h2>Loan Product</h2>
				@elseif ($viewType === 'edit')
					<h2>Edit Loan Product</h2>
				@endif 
				<div class="pull-right">
					@if ($viewType === 'create') 
						<div id="add-btn"  class="btn-group"></div> &nbsp
						<div id="edit-btn" class="btn-group"></div> &nbsp
					@elseif ($viewType === 'view')
						<div class="btn-group">
							<a href="{{ URL::route('loan.products.edit', $encryptId) }}">
								<button class="btn btn-block btn-sm btn-info pull-right"><i class="fa fa-edit"></i> Edit</button>
							</a>
						</div> &nbsp
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
					@if ($viewType != 'create')
						<input type="hidden" name="encrypt_id" id="encrypt_id" value="{{ $encryptId }}">
					@endif
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
									data-parsley-pattern="{{ config('loans.amountRegex') }}"
									data-parsley-pattern-message="{{ trans('loans.amount') }}"
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
									data-parsley-pattern="{{ config('loans.amountRegex') }}"
									data-parsley-pattern-message="{{ trans('loans.percentage') }}"
									value="{{ $loanProduct->interest or '' }}">
							</div>
						</div>
						
						@if (session('role') == 0)
						<div class="form-group col-md-7">
							<label class="control-label">Entity<span class="required"> *</span></label><br>
							<div class="form-group has-feedback">
								<?php $loanProductEntity = (isset($loanProduct->entity_id)) ? $loanProduct->entity_id : (session('entity_id')) ? session('entity_id') : null ?>
								{!! Form::select('entity', $entities, $loanProductEntity, [
									'class'    => 'form-control select2', 
									'id'       => 'entity', 
									'required', 
									'data-parsley-required-message="This field is required"']) !!}
							</div>
						</div>
						@endif
						
						<div class="form-group col-md-7">
							<label class="control-label">Remarks<span class="required"></span></label><br>
							<textarea name="remarks" id="remarks" class="form-control" rows="3">{{ $loanProduct->remarks or ''}}</textarea>
						</div>
					</div>
					
					@if ($viewType != 'view')
					<div class="form-group">
						<div class="col-md-offset-2">
							@if ($viewType !== 'edit')
							 <button type="submit" class="btn btn-default clear-btn">Clear</button>
							@endif
							<button type="submit" id="form-submit" class="btn btn-success">Submit</button>
							@if ($viewType === 'edit')
								<a href="{{ URL::route('loan.products.show', $encryptId) }}">
									<div class="btn btn-danger cancel-edit-btn">Cancel</div>
								</a>
							@endif
						</div>
					</div>
					@endif
					
				</form>
			</div>
		</div>
	</div>
</div>
@endsection

