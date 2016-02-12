@extends('layouts.login')
@section('title', 'Login')

@section('content')
<div class="">
	<a class="hiddenanchor" id="toregister"></a>
	<a class="hiddenanchor" id="tologin"></a>

	<div id="wrapper">
		<div id="login" class="animate form">
			<section class="login_content">
				<form  method="POST" action="{{ URL::to('login') }}">
					{!! csrf_field() !!}
					<h1>Login</h1>
					@if (isset($errors) AND count($errors) > 0)
						<div class="alert alert-danger alert-dismissible fade in" role="alert">
							@foreach ($errors->all() as $error)
								{{ $error }}</ br>
							@endforeach
						</div>
					@endif

					<div>
						<input type="text" name="username" class="form-control" placeholder="Username" required="" />
					</div>
					<div>
						<input type="password" name="password" class="form-control" placeholder="Password" required="" />
					</div>
					<div>
						<button type="submit" class="btn btn-default submit">Log in</button>
						<a class="reset_pass" href="#">Lost your password?</a>
					</div>
					<div class="clearfix"></div>
					<div class="separator">
						<div class="clearfix"></div>
						<br />
						
						<div>
							<h1><i class="fa fa-paw" style="font-size: 26px;"></i> Gentelella Alela!</h1>
							<p>©2015 All Rights Reserved. Gentelella Alela! is a Bootstrap 3 template. Privacy and Terms</p>
						</div>
					</div>
				</form>
				<!-- form -->
			</section>
			<!-- content -->
		</div>
	</div>
</div>
@endsection