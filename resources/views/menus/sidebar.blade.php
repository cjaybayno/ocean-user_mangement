<!-- sidebar menu -->
<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
	@foreach ($menus as $menu)
		<?php $value = json_decode($menu['value'], TRUE) ?>
		@can('moduleRole', $value['role'])
			@can('menuAccess', $menu['id'])
			<div class="menu_section">
				<h3>{{ $menu['label'] }}</h3>
				<ul class="nav side-menu">
					@foreach ($menu['child'] as $menu)
						@can('menuAccess', $menu['id'])
							<?php $value    = json_decode($menu['value'], TRUE) ?>
							<?php $route    = (isset($value['route'])) ? 'href='.URL::route($value['route']) : null  ?>
							<?php $hasChild = count($menu['child']) ?>
							<li>
								<a {{ $route }}>
									<i class="{{ $value['icon'] }}"></i>
									{{ $menu['label'] }}
									@if ($hasChild)
										<span class="fa fa-chevron-down"></span>
									@endif
								</a>
								<ul class="nav child_menu" style="display: none">
									@foreach ($menu['child'] as $menu)
										@can('menuAccess', $menu['id'])
											<?php $value = json_decode($menu['value'], TRUE) ?>
											<?php $route    = (isset($value['route'])) ? 'href='.URL::route($value['route']) : null  ?>
											<li><a {{ $route }}>{{ $menu['label'] }}</a></li>
										@endcan
									@endforeach
								</ul>
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