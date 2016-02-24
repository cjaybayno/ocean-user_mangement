<!-- sidebar menu -->
<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">

	<div class="menu_section">
		<h3>General</h3>
		<ul class="nav side-menu">
			<li><a><i class="fa fa-home"></i> Home <span class="fa fa-chevron-down"></span></a>
				<ul class="nav child_menu" style="display: none">
					<li><a href="index.html">Dashboard</a>
					</li>
					<li><a href="index2.html">Dashboard2</a>
					</li>
					<li><a href="index3.html">Dashboard3</a>
					</li>
				</ul>
			</li>
			<li><a><i class="fa fa-edit"></i> Forms <span class="fa fa-chevron-down"></span></a>
				<ul class="nav child_menu" style="display: none">
					<li><a href="form.html">General Form</a>
					</li>
					<li><a href="form_advanced.html">Advanced Components</a>
					</li>
					<li><a href="form_validation.html">Form Validation</a>
					</li>
					<li><a href="form_wizards.html">Form Wizard</a>
					</li>
					<li><a href="form_upload.html">Form Upload</a>
					</li>
					<li><a href="form_buttons.html">Form Buttons</a>
					</li>
				</ul>
			</li>
			<li><a><i class="fa fa-desktop"></i> UI Elements <span class="fa fa-chevron-down"></span></a>
				<ul class="nav child_menu" style="display: none">
					<li><a href="general_elements.html">General Elements</a>
					</li>
					<li><a href="media_gallery.html">Media Gallery</a>
					</li>
					<li><a href="typography.html">Typography</a>
					</li>
					<li><a href="icons.html">Icons</a>
					</li>
					<li><a href="glyphicons.html">Glyphicons</a>
					</li>
					<li><a href="widgets.html">Widgets</a>
					</li>
					<li><a href="invoice.html">Invoice</a>
					</li>
					<li><a href="inbox.html">Inbox</a>
					</li>
					<li><a href="calender.html">Calender</a>
					</li>
				</ul>
			</li>
			<li><a><i class="fa fa-table"></i> Tables <span class="fa fa-chevron-down"></span></a>
				<ul class="nav child_menu" style="display: none">
					<li><a href="tables.html">Tables</a>
					</li>
					<li><a href="tables_dynamic.html">Table Dynamic</a>
					</li>
				</ul>
			</li>
			<li><a><i class="fa fa-bar-chart-o"></i> Data Presentation <span class="fa fa-chevron-down"></span></a>
				<ul class="nav child_menu" style="display: none">
					<li><a href="chartjs.html">Chart JS</a>
					</li>
					<li><a href="chartjs2.html">Chart JS2</a>
					</li>
					<li><a href="morisjs.html">Moris JS</a>
					</li>
					<li><a href="echarts.html">ECharts </a>
					</li>
					<li><a href="other_charts.html">Other Charts </a>
					</li>
				</ul>
			</li>
		</ul>
	</div>
	<div class="menu_section">
		<h3>User Management</h3>
		<ul class="nav side-menu">
			<li class="{{ $userActiveMenu or '' }}"><a href="{{ URL::route('users') }}"><i class="fa fa-user"></i>Users</span></a></li>
			<li class="{{ $userGroupActiveMenu or '' }}" ><a href="{{ URL::route('user.groups') }}"><i class="fa fa-users"></i><span>Groups</span></a></li>
			<li><a href="#"><i class="fa fa-key"></i><span>Access</span></a></li>
		</ul>
	</div>

</div>
<!-- /sidebar menu -->