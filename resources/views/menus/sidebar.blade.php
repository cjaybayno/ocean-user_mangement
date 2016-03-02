<!-- sidebar menu -->
<br><br><br><br>
<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
	<div class="menu_section">
		<h3>Loans</h3>
		<ul class="nav side-menu">
			<li><a><i class="fa fa-dashboard"></i> Dashboard </a></li>
			<li><a><i class="fa fa-users"></i> Member <span class="fa fa-chevron-down"></span></a>
				<ul class="nav child_menu" style="display: none">
					<li><a href="index2.html">List</a>
					<li><a href="index.html">Register</a></li>
					<li><a href="index.html">Batch Registration</a></li>
					</li>
				</ul>
			</li>
			<li><a><i class="fa fa-credit-card"></i> Loan <span class="fa fa-chevron-down"></span></a>
				<ul class="nav child_menu" style="display: none">
					<li><a href="index.html">Application</a></li>
					<li><a href="index.html">Consolidation</a></li>
				</ul>
			</li>
			<li><a><i class="fa fa-money"></i> Payments </a></li>
			<li><a><i class="fa fa-briefcase"></i> Products </a></li>
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