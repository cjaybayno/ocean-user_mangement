<!-- sidebar menu -->
<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
	@foreach ($menus as $menu)
		@can('moduleRole', $menu['role'])
			@can('moduleAccessById', $menu['id'])
				<div class="menu_section">
					<h3>{{ $menu['label'] }}</h3>
					<ul class="nav side-menu">
						@foreach ($menu['child'] as $menu)
							@can('moduleAccessById', $menu['id'])
								<li>
									<a 
										@if (isset($menu['route']))
											@menuRoute($menu['route'])
										@endif
									>
										<i class="{{ $menu['icon'] }}"></i>
										{{ $menu['label'] }}
										@if (count($menu['child']))
											<span class="fa fa-chevron-down"></span>
										@endif
									</a>
									@if (count($menu['child']))
										<ul class="nav child_menu" style="display: none">
											@foreach ($menu['child'] as $menu)
												@can('moduleAccessById', $menu['id'])
													<li>
														<a 
															@if (isset($menu['route']))
																@menuRoute($menu['route'])
															@endif
														>
															{{ $menu['label'] }}
														</a>
													</li>
												@endcan
											@endforeach
										</ul>
									@endif
								</li>
							@endcan
						@endforeach
					</ul>
				</div>
			@endcan
		@endcan
	@endforeach
</div>
<!-- /sidebar menu -->