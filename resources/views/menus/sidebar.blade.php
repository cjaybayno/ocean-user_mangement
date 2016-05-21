<!-- sidebar menu -->
<br><br><br><br>
<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
	<div class="menu_section">
		<h3>Loans</h3>
		<ul class="nav side-menu">
			<li><a><i class="fa fa-dashboard"></i> Dashboard </a></li>
			<li class="{{ $memberActiveMenu or '' }}"><a><i class="fa fa-users"></i> Member <span class="fa fa-chevron-down"></span></a>
				<ul class="nav child_menu" style="display: none">
					<li><a href="{{ URL::route('members') }}">List</a>
					<li><a href="{{ URL::route('members.register') }}">Register</a></li>
					<li><a href="index.html">Batch Registration</a></li>
					</li>
				</ul>
			</li>
			<li class="{{ $loanActiveMenu or '' }}"><a><i class="fa fa-credit-card"></i>Application<span class="fa fa-chevron-down"></span></a>
				<ul class="nav child_menu" style="display: none">
					<li><a href="{{ URL::route('loan.application.current')}}">Current Applications</a></li>
					<li><a href="{{ URL::route('loan.application.form') }}">Form Application</a></li>
					<li><a href="{{ URL::route('loan.application.members') }}">Members Application</a></li>
				</ul>
			</li>
			</li>
			<li class="{{ $consoActive or '' }}"><a><i class="fa fa-cubes"></i> Consolidation <span class="fa fa-chevron-down"></span></a>
				<ul class="nav child_menu" style="display: none">
					<li><a href="{{ URL::route('conso.loan') }}">Loan</a></li>
					<li><a href="#">Capital</a></li>
					<li><a href="#">Savings</a></li>
				</ul>
			</li>
			<li class="{{ $loanPaymentsActiveMenu or '' }}"><a><i class="fa fa-money"></i> Payment <span class="fa fa-chevron-down"></span></a>
				<ul class="nav child_menu" style="display: none">
					<li><a href="{{ URL::route('loan.payments.list') }}">List of Payments</a></li>
					<li><a href="{{ URL::route('loan.payments.form') }}">Make Payments</a></li>
				</ul>
			</li>
			<li class="{{ $loanProductsActiveMenu or '' }}">
				<a href="{{ URL::route('loan.products') }}">
					<i class="fa fa-briefcase"></i> Products
				</a>
			</li>
	</div>
	<div class="menu_section">
		<h3>BackOffice</h3>
		<ul class="nav side-menu">
			<li><a><i class="fa fa-file-text-o"></i> Balance Sheet</a></li>
			<li><a><i class="fa fa-file-text"></i> Income Statement</a></li>
		</ul>
	</div>
	@can('adminRole')
	<div class="menu_section">
		<h3>User Management</h3>
		<ul class="nav side-menu">
			<li class="{{ $userActiveMenu or '' }}"><a href="{{ URL::route('users') }}"><i class="fa fa-user"></i>Users</span></a></li>
			<li class="{{ $userGroupActiveMenu or '' }}" ><a href="{{ URL::route('user.groups') }}"><i class="fa fa-users"></i><span>Groups</span></a></li>
			<li><a href="#"><i class="fa fa-key"></i><span>Access</span></a></li>
		</ul>
	</div>
	@endcan

</div>
<!-- /sidebar menu -->