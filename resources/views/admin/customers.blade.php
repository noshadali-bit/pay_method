<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Customers</title>
	<link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap.min.css')}}">
	<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
</head>
<body>
	<nav class="navbar navbar-expand-lg bg-light">
	  <div class="container-fluid">
	    <a class="navbar-brand" href="#">Navbar</a>
	    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
	      <span class="navbar-toggler-icon"></span>
	    </button>
	    <div class="collapse navbar-collapse" id="navbarSupportedContent">
	      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
	        <li class="nav-item">
	          <a class="nav-link active" aria-current="page" href="{{Route('admin-dashboard')}}">Dashboard</a>
	        </li>
	        <li class="nav-item">
	          <a class="nav-link" href="{{Route('customers')}}">Customers</a>
	        </li>
	        <li class="nav-item dropdown">
	          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
	            Dropdown
	          </a>
	          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
	            <li><a class="dropdown-item" href="#">Action</a></li>
	            <li><a class="dropdown-item" href="#">Another action</a></li>
	            <li><hr class="dropdown-divider"></li>
	            <li><a class="dropdown-item" href="#">Something else here</a></li>
	          </ul>
	        </li>
	        <li class="nav-item">
	          <a class="nav-link disabled">Disabled</a>
	        </li>
	      </ul>
	      <div class="d-flex">
	      	<div class="dropdown">
	      	  <button class="btn btn-outline-success dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
	      	    {{Auth::user()->name}}
	      	  </button>
	      	  <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
	      	    <li><a class="dropdown-item" href="#">Profile</a></li>
	      	    <li><a class="dropdown-item" href="{{Route('logout')}}">Logout</a></li>
	      	  </ul>
	      	</div>
	      </div>
	      
	    </div>
	  </div>
	</nav>
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<h4 class="text-center">Customers</h4>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12" style="overflow-x: scroll;">
				{{-- {{dd($customers)}} --}}
				<table class="table table-responsive" id="myTable">
					<thead>
						<tr>
							<td>Email</td>
							<td>First Name</td>
							<td>Last Name</td>
							<td>Address</td>
							<td>City</td>
							<td>State</td>
							<td>Postal/Zip Code</td>
							<td>Country</td>
							<td>Billing Email</td>
							<td>Phone No.</td>
							<td>Sales Email</td>
						</tr>
					</thead>
					<tbody>
						@forelse($customers as $customer)
							<tr>
								<td>{{$customer->customer_email}}</td>
								<td>{{$customer->billing_firstname}}</td>
								<td>{{$customer->billing_lastname}}</td>
								<td>{{$customer->billing_address}}</td>
								<td>{{$customer->billing_city}}</td>
								<td>{{$customer->billing_state}}</td>
								<td>{{$customer->postal_code}}</td>
								<td>{{$customer->billing_country}}</td>
								<td>{{$customer->billing_email}}</td>
								<td>{{$customer->billing_phonenumber}}</td>
								<td>{{$customer->sales_email}}</td>
							</tr>
						@empty
							<tr>
								<td colspan="10" align="center">Data Not Found</td>
							</tr>
						@endforelse
						{{-- <tr>
							<td>Hello</td>
							<td>Hello</td>
							<td>Hello</td>
						</tr>
						<tr>
							<td>Hello</td>
							<td>Hello</td>
							<td>Hello</td>
						</tr>
						<tr>
							<td>Hello</td>
							<td>Hello</td>
							<td>Hello</td>
						</tr> --}}
					</tbody>

				</table>
			</div>
		</div>
	</div>
	<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
	<script type="text/javascript" src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" src="{{asset('js/bootstrap.bundle.min.js')}}"></script>
	<script type="text/javascript">
		$(document).ready( function () {
		    $('#myTable').DataTable();
		} );
	</script>
</body>
</html>