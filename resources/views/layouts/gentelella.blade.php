<!DOCTYPE html>
<html lang="en">

<head>
	<!-- Add token -->
	<meta name="_token" content="{!! csrf_token() !!}"/>
    
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	
    <title>Ocean | @yield('title')</title>
	
	<!-- CSS -->
    <link href="{!! asset('resources/assets/gentellela-alela/css/bootstrap.min.css') !!}" rel="stylesheet">
    <link href="{!! asset('resources/assets/gentellela-alela/fonts/css/font-awesome.min.css') !!}" rel="stylesheet">
    <link href="{!! asset('resources/assets/gentellela-alela/css/animate.min.css') !!}" rel="stylesheet">
    <link href="{!! asset('resources/assets/gentellela-alela/css/custom.css') !!}" rel="stylesheet">
    <link href="{!! asset('resources/assets/gentellela-alela/css/icheck/flat/green.css') !!}" rel="stylesheet">
    <script src="{!! asset('resources/assets/gentellela-alela/js/jquery.min.js') !!}"></script>
	
	<!-- Put modal in center -->
	<style>
		.modal {
		  text-align: center;
		}

		@media screen and (min-width: 768px) {
		  .modal:before {
			display: inline-block;
			vertical-align: middle;
			content: " ";
			height: 80%;
		  }
		}

		.modal-dialog {
		  display: inline-block;
		  text-align: left;
		  vertical-align: middle;
		}
    </style>
	
	<!-- Additional Stylesheet -->
	@if (! empty($assets['stylesheets']))
		@foreach ($assets['stylesheets'] as $stylesheet)
			@if ($stylesheet != '')
				<link rel="stylesheet"  href="{!! asset('resources/'.$stylesheet.'') !!}" >
			@endif
		@endforeach
	@endif
	@yield('addStylesheets')
	
    <!--[if lt IE 9]>
        <script src="../assets/js/ie8-responsive-file-warning.js"></script>
        <![endif]-->

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

</head>


<body class="nav-md">

    <div class="container body">
	
        <div class="main_container">

            <div class="col-md-3 left_col">
                <div class="left_col scroll-view">

                    <div class="navbar nav_title" style="border: 0;">
                        <a href="index.html" class="site_title"><i class="fa fa-anchor"></i> <span>OCEAN LOAN</span></a>
                    </div>
                    <div class="clearfix"></div>

                    <!-- menu prile quick info -->
                    <div class="profile">
                        <div class="profile_pic">
                            <img src="{!! asset($avatar) !!}" alt="..." class="img-circle profile_img">
                        </div>
                        <div class="profile_info">
                            <span>Welcome,</span>
                            <h2>{{ $name }}</h2>
                        </div>
                    </div>
                    <!-- /menu prile quick info -->
                    <br />
					
					<!-- side bar -->
                    @include('menus.sidebar')
					<!-- /side bar -->
				</div>
            </div>
			
			<!-- top navigation -->
            @include('menus.topnav')
			<!-- /top navigation -->

            <!-- page content -->
            <div class="right_col" role="main">
                <div class="">
					<!-- content -->
					@yield('content')
					<!-- /content -->
                </div>

                <!-- footer content -->
				 @include('menus.footer')
                <!-- /footer content -->
				
            </div>
            <!-- /page content -->
        </div>
    </div>

    <div id="custom_notifications" class="custom-notifications dsp_none">
        <ul class="list-unstyled notifications clearfix" data-tabbed_notifications="notif-group">
        </ul>
        <div class="clearfix"></div>
        <div id="notif-group" class="tabbed_notifications"></div>
    </div>
	
	<script>
		/* === javascript global variable === */
	
		// base url of application 
		var url = "{{ url('') }}";
		
		// opps message
		var oops = "{{ trans('users.oops') }}";
		
	</script>
	
	<!-- JS -->
	<script src="{!! asset('resources/assets/gentellela-alela/js/bootstrap.min.js') !!}"></script>
	<script src="{!! asset('resources/assets/gentellela-alela/js/nicescroll/jquery.nicescroll.min.js') !!}"></script>
	<script src="{!! asset('resources/assets/gentellela-alela/js/custom.js') !!}"></script>
	<script src="{!! asset('resources/assets/modules/helper-function.js') !!}"></script>
	
	<!-- Additional Script -->
	@if (! empty($assets['scripts']))
		@foreach ($assets['scripts'] as $scripts)
			@if ($scripts != '')
				<script src="{!! asset('resources/'.$scripts.'') !!}" ></script>
			@endif
		@endforeach
	@endif
	@yield('addScripts')
	
	<!-- General modal -->
	<div class="modal fade" id="generic-modal" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
	  <div class="modal-dialog">
		<div class="modal-content">
		  <div class="modal-header">
			<h4 class="modal-title generic-modal-title"></h4>
		  </div>
		  <div class="modal-body">
			<div id="generic-modal-alert">
			  <p id="generic-modal-message"></p>
			</div>
		  </div>
		</div><!-- /.modal-content -->
	  </div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
	
</body>

</html>