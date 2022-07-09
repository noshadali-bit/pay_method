<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<title>Paypal Payment Gateway</title>
	<style type="text/css">
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
	<div class="container">
	<form id="regForm" action="{{Route('paypal-gateway')}}" method="POST">
		@csrf
		<h1>LINK GENERATOR FOR PAYMENT</h1>
		<input type="hidden" name="payment_id" value="" />
    	<input type="hidden" name="payer_id" value="" />
    	<input type="hidden" name="payment_status" value="" />
    	<input type="hidden" name="respon_data" value="" />
    	<input type="hidden" name="description" value="{{$request->description??''}}" />
    	<input type="hidden" name="payment_gateway" value="{{$request->payment_gateway??''}}" />
    	<input type="hidden" name="sales_email" value="{{$request->sales_email??''}}" />
    	<input type="hidden" name="customer_email" value="{{$request->customer_email??''}}" />
    	@if(is_array($request->package))
	    	@forelse($request->package as $pkg)
		    	<input type="hidden" name="package[]" value="{{$pkg}}" />
	    	@empty
	    	@endforelse
    	@endif
		<p>
			<label for="sale_amount">Amount *</label>
			<input class="form-control" type="number" id="sale_amount" value="{{$request->sale_amount}}" name="sale_amount" readonly>
		</p>
		<p>
			<label for="sale_currency">Amount Currency *</label>
			<input class="form-control" type="text" id="sale_currency" value="{{$request->sale_currency}}" name="sale_currency" readonly>
		</p>
		<h4>
			BILLING DETAILS :
		</h4>
		<p>
			<label for="billing_firstname">First Name *</label>
			<input class="form-control" type="text" name="billing_firstname" id="billing_firstname" >
		</p>
		<p>
			<label for="billing_lastname">Last Name *</label>
			<input class="form-control" type="text" name="billing_lastname" id="billing_lastname" >
		</p>
		<p>
			<label for="billing_address">Address *</label>
			<input class="form-control" type="text" name="billing_address" id="billing_address" >
		</p>
		<p>
			<label for="billing_country">Country *</label>
			<input class="form-control" type="text" name="billing_country" id="billing_country" >
		</p>
		<p>
			<label for="billing_state">State/Province *</label>
			<input class="form-control" type="text" name="billing_state" id="billing_state" >
		</p>
		<p>
			<label for="billing_city">City *</label>
			<input class="form-control" type="text" name="billing_city" id="billing_city" >
		</p>
		<p>
			<label for="postal_code">ZIP/Postal Code *</label>
			<input class="form-control" type="text" name="postal_code" id="postal_code" >
		</p>
		<p>
			<label for="billing_email">Billing Email</label>
			<input class="form-control" type="email" name="billing_email" id="billing_email" value="{{$request->customer_email}}" >
		</p>
		<p>
			<label for="billing_phonenumber">Phone/Cell Number *</label>
			<input class="form-control" type="number" name="billing_phonenumber" id="billing_phonenumber" >
		</p>
		<span id="paypalSpan">
			<h4>
				Pay now with your Debit / Credit card using our Paypal button
			</h4>
		</span>
		<input class="btn btn-primary" type="submit" name="previous" value="Previous" style="width: 100%;" formaction="{{Route('/')}}" />
	</form>
	</div>
	<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
	<script src="https://www.paypalobjects.com/api/checkout.js"></script>
	<script type="text/javascript" src="{{asset('js/numeric-1.2.6.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('js/bezier.js')}}"></script>
	<script type="text/javascript" src="{{asset('js/jquery.signaturepad.js')}}"></script>
	<script type="text/javascript" src="{{asset('js/json2.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('js/bootstrap-notify.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('js/public.js')}}"></script>
	<script type="text/javascript" src="{{asset('js/ycommon.js')}}"></script>
	<script type="text/javascript">
		$body = $("body");
		paypal.Button.render({
		env: 'sandbox', 
		
		style: {
		label: 'pay',
		size:  'responsive',  
		shape: 'rect',    
		color: 'gold'      
		},
		client: { 
		
		sandbox: 'AfKGiyRjyYNrjM7q9GTisPVQzzs6wpXPzT1oseK2fdFzJkGhoRwb-Cv_fy0yORyQ4J0t8TbRIpYsfTXO',
		
		},
		payment: function(data, actions) {
		total_price = $("#sale_amount").val();
		if ($("#billing_firstname").val() == "" || $("#billing_lastname").val() == "" || $("#billing_address").val() == "" || $("#billing-country").val() == "" || $("#billing_state").val() == "" || $("#billing_city").val() == "" || $("#postal_code").val() == "" || $("#billing_email").val() == "" ||  $("#phonenumber").val() == "" ){
		 generateNotification('error','Please fill all the fields to continue');
		 throw 'error';
		}
		
		return actions.payment.create({
		  payment: {
		    transactions: [
		      { 
		        amount: { total: total_price, currency: $("#sale_currency").val() }
		      }
		    ]
		  }
		});
		},
		onAuthorize: function(data, actions) {
		return actions.payment.execute().then(function() {
		  generateNotification('success','Payment Authorized');
		  $body.addClass("loading");
		  var params = {
		    payment_status:'Completed',
		    paymentID: data.paymentID,
		    payerID: data.payerID
		  };
		  
			var dataString = JSON.stringify(data);
		  $('input[name="payment_status"]').val('Completed');
		  $('input[name="payment_id"]').val(data.paymentID);
		  $('input[name="payer_id"]').val(data.payerID);
		  $('input[name="respon_data"]').val(dataString);
		  $('input[name="payment_method"]').val('paypal');
		  $('#regForm').submit();
		  $body.removeClass("loading");
		});
		},
		onCancel: function(data, actions) {
		  var params = {
		    payment_status:'Failed',
		    paymentID: data.paymentID
		  };
		  $('input[name="payment_status"]').val('Failed');
		  $('input[name="payment_id"]').val(data.paymentID);
		  $('input[name="payer_id"]').val('');
		  $('input[name="payment_method"]').val('paypal');
		  $('input[name="respon_data"]').val('');
		   generateNotification('error','Payment has been Cancelled');
		}
		}, '#paypalSpan');
	</script>
</body>
</html>