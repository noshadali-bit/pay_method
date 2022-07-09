<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Signup</title>
	<link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap.min.css')}}">
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<h4 class="text-center">Signup</h4>
			</div>
		</div>
		@if($errors->any())
			<div class="row">
				<div class="col-sm-4"></div>
				<div class="col-sm-4">
					<div class="alert alert-info">
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
				<form method="POST" action="{{Route('signup-process')}}">
					@csrf
					<div class="mb-3">
						<label for="name" class="form-label">Name</label>
						<input type="text" name="name" class="form-control" id="name" placeholder="John Doe" />
					</div>
					<div class="mb-3">
						<label for="email" class="form-label">Email</label>
						<input type="email" name="email" class="form-control" id="email" placeholder="abc@example.com" />
					</div>
					<div class="mb-3">
						<label for="password" class="form-label">Password</label>
						<input type="password" name="password" class="form-control" id="password" placeholder="**********" />
					</div>
					<div class="mb-3">
						<input type="submit" name="signup" class="btn btn-primary w-100" value="Signup">
					</div>
				</form>
			</div>
		</div>
	</div>
	<script type="text/javascript" src="{{asset('js/bootstrap.bundle.min.js')}}"></script>
</body>
</html>