<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Login</title>
	<link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap.min.css')}}">
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<h4 class="text-center">Login</h4>
			</div>
		</div>
		@if($errors->any())
			<div class="row">
				<div class="col-sm-4"></div>
				<div class="col-sm-4">
					<div class="alert alert-primary">
					    @foreach($errors->all() as $error)
					    	<h6>{{$error}}</h>
					    @endforeach
				    </div>
				</div>
			</div>
		@endif
		<div class="row my-5">
			<div class="col-sm-4"></div>
			<div class="col-sm-4">
				@if(Session::has('message'))
					<div class="alert alert-success text-center">
						{{Session::get('message')}}
					</div>
				@endif
				<form method="POST" action="{{Route('login-process')}}">
					@csrf
					<div class="mb-3">
						<label for="email" class="form-label">Email</label>
						<input type="email" name="email" class="form-control" id="email" />
					</div>
					<div class="mb-3">
						<label for="password" class="form-label">Password</label>
						<input type="password" name="password" class="form-control" id="password" />
					</div>
					<div class="mb-3">
						<input type="submit" name="login" class="btn btn-primary w-100" value="Login">
					</div>
					<div class="mb-3">
						<button class="btn btn-primary w-100"><a href="{{route('signup')}}">SIGN UP</a></button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<script type="text/javascript" src="{{asset('js/bootstrap.bundle.min.js')}}"></script>
</body>
</html>