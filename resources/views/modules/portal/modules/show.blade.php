@extends('layouts.gentelella')
@section('title', 'Modules Show')

@section('content')
<div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">
			<div class="x_title">
				<h2> Modules Name : {{ $modules->label }}</h2>
				<div class="pull-right">	
					<div class="btn-group">
						<a href="{{ URL::route('portal.modules') }}">
							<button type="button" class="btn btn-block btn-sm btn-default"><i class="glyphicon glyphicon-th-list"></i> Show List of Modules</button>
						</a>
					</div>
				</div>
				<div class="clearfix"></div>
			</div>
			<div class="x_content">
				<div class="col-xs-3">
					<ul class="nav nav-tabs tabs-left">
						<?php $flag = 0 ?>
						@foreach ($selected_menus as $menu)
							<li class=<?php if ($flag <= 0) echo 'active'?>>
								<a href="#{{ $menu['name'] }}" data-toggle="tab">{{ $menu['label'] }}</a>
							</li>
							<?php $flag++ ?>
						@endforeach
					</ul>
				</div>
				<div class="col-xs-9">
					<!-- Tab panes -->
					<div class="tab-content">
						<?php $flag = 0 ?>
						@foreach ($selected_menus as $menu)
							<div class="tab-pane <?php if ($flag <= 0) echo 'active'?>" id="{{ $menu['name'] }}">
								<p class="lead">{{ $menu['label'] }}  Menu</p>
								<table class="table table-hover table-striped">
									<thead>
										<tr>
											<th>Name</th>
											<th>Label</th>
											<th>Order</th>
											<th>Route</th>
											<th>Icon</th>
											<th></th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>{{ $menu['name'] }}</td>
											<td>{{ $menu['label'] }}</td>
											<td>{{ $menu['order_list'] }}</td>
											<td>{{ $menu['route'] }}</td>
											<td><i class="{{ $menu['icon'] }}"></i> ({{ $menu['icon'] }})</td>
											<td>
												<button class="btn btn-xs btn-info"><span class="fa fa-edit"></span> Edit</button>
											</td>
										</tr>
									</tbody>
								</table>
								<?php $flag++ ?>
								
								@if (! empty($menu['child']))
									<p class="lead">Sub Menus</p>
									<table class="table table-hover table-striped">
										<thead>
											<tr>
												<th>Name</th>
												<th>Label</th>
												<th>Order</th>
												<th>Route</th>
												<th></th>
											</tr>
										</thead>
										<tbody>
											@foreach ($menu['child'] as $menu)
												<tr>
													<td>{{ $menu['name'] }}</td>
													<td>{{ $menu['label'] }}</td>
													<td>{{ $menu['order_list'] }}</td>
													<td>{{ $menu['route'] }}</td>
													<td>
														<button class="btn btn-xs btn-info"><span class="fa fa-edit"></span> Edit</button>
													</td>
												</tr>
											@endforeach
										</tbody>
									</table>
								@endif
							</div>
						@endforeach
					</div>
				</div>
				<div class="clearfix"></div>
			</div>
		</div>
	</div>
</div>
@endsection

