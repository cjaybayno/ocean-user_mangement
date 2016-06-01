@extends('layouts.gentelella')
@section('title', 'Balance Sheet Form')

@section('content')
<div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">
			<div class="x_title">
				<h2>Balance Sheet Form</h2>
				<div class="pull-right">
					<div id="add-btn" class="btn-group"></div>
					<div class="btn-group">
						<a href="#">
							<button type="button" class="btn btn-block btn-sm btn-info"><i class="fa fa-upload"></i> Balance Sheet</button>
						</a>
					</div>
				</div>
				<div class="clearfix"></div>
			</div>
			<div class="x_content">
				<div id="member-registration-result"></div>
				 <div class="" role="tabpanel" data-example-id="togglable-tabs">
					<ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
						<li role="presentation" class="active">
							<a href="#tab_content1" id="assets-tab" class="tab-btn" role="tab" data-toggle="tab" aria-expanded="true">
								ASSETS
							</a>
						</li>
						<li role="presentation" class="">
							<a href="#tab_content2" role="tab" id="lae-tab" class="tab-btn" data-toggle="tab"  aria-expanded="false">
								LIABILITIES AND OWNER'S EQUITY
							</a>
						</li>
					</ul>
					<div id="myTabContent" class="tab-content">
						<div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="assets-tab">
							<div id="assets-result" class="result-pane"></div>
							<form id="balancesheet-assets-form" class="form-horizontal form-label-left">
							    @foreach ($assetParams['child'] as $paramChild) 
									<p class="well well-sm">{{ $paramChild['label'] }}</p>
									@foreach ($paramChild['child'] as $lastChild)
										<div class="form-group">
											<label class="control-label col-md-3 col-sm-3 col-xs-12">{{ $lastChild['label'] }}</label>
											<div class="col-md-6 col-sm-6 col-xs-12">
												<input type="text" name="{{ $lastChild['id'] }}" id="{{ $lastChild['id'] }}" class="number-format form-control col-md-7 col-xs-12" value="0">
											</div>
										</div>									
									@endforeach()
								@endforeach()
								<p class="well well-sm">Total</p>
								<h2 class="col-md-offset-3 col-md-6 col-sm-offset-3 col-sm-6 col-xs-12">TOTAL ASSETS : <span id="total-assets" class="total">0.00</span></h2>
								<div class="form-group">
									<div class="col-md-offset-3 col-md-6 col-sm-offset-3 col-sm-6 col-xs-12">
										<button type="submit" id="form-submit" class="btn btn-info"><i class="fa fa-dollar"></i> Save</button>
									</div>
								</div>
							</form>
						</div>
						<div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="capital-tab">
							<div id="lae-result" class="result-pane"></div>
							<form id="balancesheet-lae-form" class="form-horizontal form-label-left">
							    @foreach ($laeParams['child'] as $paramChild) 
									<p class="well well-sm">{{ $paramChild['label'] }}</p>
									@foreach ($paramChild['child'] as $lastChild)
										<div class="form-group">
											<label class="control-label col-md-3 col-sm-3 col-xs-12">{{ $lastChild['label'] }}</label>
											<div class="col-md-6 col-sm-6 col-xs-12">
												<input type="text" name="{{ $lastChild['id'] }}" id="{{ $lastChild['id'] }}" class="number-format form-control col-md-7 col-xs-12" value= "0">
											</div>
										</div>									
									@endforeach()
								@endforeach()
								<p class="well well-sm">Total</p>
								<h2 class="col-md-offset-3 col-md-6 col-sm-offset-3 col-sm-6 col-xs-12">TOTAL LIABILITIES & EQUITY : <span id="total-lae" class="total">0.00</span></h2>
								<div class="form-group">
									<div class="col-md-offset-3 col-md-6 col-sm-offset-3 col-sm-6 col-xs-12">
										<button type="submit" id="form-submit" class="btn btn-info"><i class="fa fa-dollar"></i> Save</button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
