<!-- top navigation -->
<div class="top_nav">

	<div class="nav_menu">
		<nav class="" role="navigation">
			<div class="nav toggle">
				<a id="menu_toggle"><i class="fa fa-bars"></i></a>
			</div>
			<!-- <ul class="nav navbar-nav">
				<li class="">
					<a href="#" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false"> {{$entityNme or ''}} </a>
				</li>
			</ul>-->
			<ul class="nav navbar-nav navbar-right">
				<!-- <li class="">
					<a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
						<img src="{!! asset($avatar) !!}" alt="">{{$name}}
						<span class=" fa fa-angle-down"></span>
					</a>
					<ul class="dropdown-menu dropdown-usermenu animated fadeInDown pull-right">
						<li><a href="{{ URL::to('logout') }}"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
					</ul>
				</li>
				-->
				 <li class="">
					<a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
						<img src="{!! asset($avatar) !!}" alt="">{{$name}}
						<span class=" fa fa-angle-down"></span>
					</a>
					<ul class="dropdown-menu dropdown-usermenu animated fadeInDown pull-right">
						<li><a href="{{ URL::to('logout') }}"><i class="fa fa-sign-out pull-right"></i> Log Out</a>
						</li>
					</ul>
				</li>
			</ul>
		</nav>
	</div>

</div>
<!-- /top navigation -->