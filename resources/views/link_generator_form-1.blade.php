<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<title>Link Generator</title>
	<style type="text/css">
		.pay_methods_logo{
		   width:100px !important;
		}
		#regForm {
 		  	background-color: #ffffff;
 		  	margin: 100px auto;
 		  	padding: 40px;
 		  	width: 70%;
 		  	min-width: 300px;
 		}
	</style>
</head>
<body>
	{{-- {{dd($request)}} --}}
	<form method="POST" action="{{Route('formSubmit_1')}}" id="regForm" onsubmit="return validation(this)">
		@csrf
		<div class="row" >
			<div class="col-md-12">
				<div class="panel-heading">
					<h1 class="panel-title">LINK GENERATOR FOR PAYMENT</h1>
				</div>
			</div>
			<div class="col-md-12">
				<div class="panel-heading">
					<h4 class="panel-title">
					Payment Type
					</h4>
				</div>
			</div>
			<div class="col-md-12" >
				<div class="form-group">
					<label>Choose one option *</label>
					<select class="form-control" name="sale_status" id="sale_status" required="">
					<option value="" selected="" disabled="">Please choose an option</option>
					<option value="1">New Payment</option>
					<option value="2">Up-Sale Payment</option>
					</select>
				</div>
			</div>
			<div class="col-md-12">
				<div class="panel-heading">
					<h4 class="panel-title">
					Payment Details
					</h4>
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label>Amount *</label>
					<input type="number" class="form-control" name="sale_amount" id="sale_amount" required="" min="1">
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label>Currency *</label>
					<select class="form-control" name="sale_currency">
					<option value="USD"> USD</option>
					</select>
				</div>
			</div>

			<div class="col-md-12">
				<div class="form-group">
					<label for="description">Description *</label>
					<textarea name="description" id="description" rows="3" cols="120" >{{$request->description??''}}</textarea>
				</div>
			</div>
			<div class="col-md-12">
				<div class="panel-heading">
					<h4 class="panel-title">
					Payment Gateway
					</h4>
				</div>
			</div>
			<div class="col-md-3" id="paypal_merchant">
				<div class="form-group" >
					<input id="radio1000" type="radio" class="form-control" name="payment_gateway" value="paypal" >
					<label for="radio1000"><img src="https://creativewebsitestudios.softpaymentterminal.com/public/images/paypal_logo.png" class="pay_methods_logo"></label>
				</div>
			</div>
                                    
			<div class="col-md-3" id="stripe_merchant">
				<div class="form-group">
					<input id="radio1001" type="radio" class="form-control" name="payment_gateway" value="stripe" >
					<label for="radio1001"><img src="https://creativewebsitestudios.softpaymentterminal.com/public/images/stripe_logo.png" class="pay_methods_logo"></label>
				</div>
			</div>
                                                                        
			<div class="col-md-3" id="authorize_merchant">
				<div class="form-group">
					<input id="radio1002" type="radio" class="form-control" name="authorize" value="3" >
					<label for="radio1002"><img src="https://creativewebsitestudios.softpaymentterminal.com/public/images/authorize_logo.png" class="pay_methods_logo"></label>
				</div>
			</div>
								
			<div class="col-md-3" id="authorize_merchant">
				<div class="form-group">
					<input id="radio1006" type="radio" class="form-control" name="authorize3" value="3.1" >
					<label for="radio1006"><img src="https://creativewebsitestudios.softpaymentterminal.com/public/images/Authorize-net-3-0.png" class="pay_methods_logo"></label>
				</div>
			</div>
                                    
			<div class="col-md-12">
				<div class="panel-heading">
					<h4 class="panel-title">
					Packages Name
					</h4>
				</div>
			</div>
			<div class="col-md-12">
				<input type="checkbox" id="pack0" name="package[]" value="Logo Design">
                <label for="pack0">Logo Design</label>
               </div>
               <div class="col-md-12">
                  <input type="checkbox" id="pack1" name="package[]" value="Client Questionnaire">
                  <label for="pack1">Client Questionnaire</label>
               </div>
               <div class="col-md-12">
                  <input type="checkbox" id="pack2" name="package[]" value="Stationery Design">
                  <label for="pack2">Stationery Design</label>
               </div>
            </div>

			<div class="col-md-12">
				<div class="panel-heading">
					<h4 class="panel-title">
					Other Details :
					</h4>
				</div>
			</div>
		
		<div class="col-md-12">
			<div class="form-group">
				<label for="sales_email">Sales person email *</label>
				<input type="email" name="sales_email" id="sales_email" value="{{$request->sales_email??''}}" class="form-control">
			</div>
		</div>
		
		<div class="col-md-12">
			<div class="form-group">
				<label for="customer_email">Customer email *</label>
				<input type="email" name="customer_email" id="customer_email" value="{{$request->customer_email??''}}" class="form-control">
			</div>
		</div>
		
		<div class="col-md-12">
			<input type="submit" name="next" value="Next" class="btn btn-primary">
		</div>
	</form>
	<script type="text/javascript">
		function validation(){
			var sale_status		= document.getElementById('sale_status').value;
			var sale_amount		= document.getElementById('sale_amount').value;
			var description		= document.getElementById('description').value;
			var sale_currency	= document.getElementById('sale_currency').value;
			var customer_email	= document.getElementById('customer_email').value;
			var sales_email		= document.getElementById('sales_email').value;
			var paypal	 		= document.getElementById('paypalGateway').checked;
			var stripeCheck		= document.getElementById('stripeCheck').checked;
			var authorize		= document.getElementById('authorizeCheck').checked;
			var authorize3		= document.getElementById('authorize3Check').checked;
			var getwaySpan		= document.getElementById('getwaySpan');
			// return false;

			if ([sale_amount, description, sales_email, customer_email].includes("") || (!paypal && !stripeCheck && !authorize && !authorize3)) {
				alert('Fields With "*" are Required');
				return false
			}else{
				return true;
			}

		}
	</script>
</body>
</html>