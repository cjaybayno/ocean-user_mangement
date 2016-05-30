@extends('layouts.gentelella')
@section('title', 'Balance Sheet Form')

@section('content')
<div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">
			<div class="x_title">
				<h2>Balance Sheet Form</h2>
				<div class="pull-right">
					<div class="btn-group">
						<a href="#">
							<button type="button" class="btn btn-block btn-sm btn-info"><i class="fa fa-upload"></i> Balance Sheet</button>
						</a>
					</div>
				</div>
				<div class="clearfix"></div>
			</div>
			<div class="x_content">
				 <div class="" role="tabpanel" data-example-id="togglable-tabs">
					<ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
						<li role="presentation" class="active">
							<a href="#tab_content1" id="assets-tab" role="tab" data-toggle="tab" aria-expanded="true">
								ASSETS
							</a>
						</li>
						<li role="presentation" class="">
							<a href="#tab_content2" role="tab" id="capital-tab" data-toggle="tab"  aria-expanded="false">
								LIABILITIES AND OWNER'S EQUITY
							</a>
						</li>
					</ul>
					<div id="myTabContent" class="tab-content">
						<div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="assets-tab">
							Assets panel form
						</div>
						<div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="capital-tab">
							Liabilities and equity form
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
