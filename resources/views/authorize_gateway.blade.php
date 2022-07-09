<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
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
	{{-- {{dd($request->customer_email)}} --}}
	<form id="order-place" method="POST" action="{{Route('authorize-gateway')}}" onsubmit="return validation(this)">
		@csrf
		<h1>LINK GENERATOR FOR PAYMENT</h1>
		<input type="hidden" name="payment_gateway" id="payment_method" value="Authorize" />
    	
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
			<input type="number" id="sale_amount" value="{{$request->sale_amount}}" name="sale_amount" readonly>
		</p>
		<p>
			<label for="sale_currency">Amount Currency *</label>
			<input type="text" id="sale_currency" value="{{$request->sale_currency}}" name="sale_currency" readonly>
		</p>
		<h4>
			BILLING DETAILS :
		</h4>
		<p>
			<label for="billing_firstname">First Name *</label>
			<input type="text" class="valid" name="billing_firstname" id="billing_firstname" required>
		</p>
		<p>
			<label for="billing_lastname">Last Name *</label>
			<input type="text" class="valid" name="billing_lastname" id="billing_lastname" required>
		</p>
		<p>
			<label for="billing_address">Address *</label>
			<input type="text" class="valid" name="billing_address" id="billing_address" required>
		</p>
		<p>
			<label for="billing_country">Country *</label>
			<input type="text" class="valid" name="billing_country" id="billing_country" required>
		</p>
		<p>
			<label for="billing_state">State/Province *</label>
			<input type="text" class="valid" name="billing_state" id="billing_state" required>
		</p>
		<p>
			<label for="billing_city">City *</label>
			<input type="text" class="valid" name="billing_city" id="billing_city" required>
		</p>
		<p>
			<label for="postal_code">ZIP/Postal Code *</label>
			<input type="text" class="valid" name="postal_code" id="postal_code" required>
		</p>
		<p>
			<label for="billing_email">Billing Email</label>
			<input type="email" class="valid" name="billing_email" id="billing_email" value="{{$request->customer_email}}" required>
		</p>
		<p>
			<label for="billing_phonenumber">Phone/Cell Number *</label>
			<input type="number" class="valid" name="billing_phonenumber" id="billing_phonenumber" required>
		</p>
		<h4>
			Pay Now
		</h4>
		<p>
			<label for="name_oncard">Name on Card</label>
			<input type="text" name="name_oncard" id="name_oncard" required>
		</p>
		<p>
			<label for="card_number">Card Number</label>
			<input type="number" class="card-number valid" name="card_number" id="card_number" autocomplete="off" required>
		</p>
		<p>
			<label for="cvv">CVV</label>
			<input type="number" name="cvv" id="cvv" class="card-cvc valid" autocomplete="off" required>
		</p>
		<p>
			<label for="expiration_month">Expiration Month</label>
			<select name="expiration_month" id="expiration_month" class="card-expiry-month" >
				<option value="01">January</option>
               	<option value="02">February </option>
               	<option value="03">March</option>
               	<option value="04">April</option>
               	<option value="05">May</option>
               	<option value="06">June</option>
               	<option value="07">July</option>
               	<option value="08">August</option>
               	<option value="09">September</option>
               	<option value="10">October</option>
               	<option value="11">November</option>
               	<option value="12">December</option>
			</select>
		</p>

		<p>
			<label for="expiration_year">Expiration Year</label>
			<select name="expiration_year" id="expiration_year" class="card-expiry-year">
				<option value="2022">2022</option>
	            <option value="2023">2023</option>
	            <option value="2024">2024</option>
	            <option value="2025">2025</option>
	            <option value="2026">2026</option>
	            <option value="2027">2027</option>
	            <option value="2028">2028</option>
	            <option value="2029">2029</option>
	            <option value="2030">2030</option>
	            <option value="2031">2031</option>
			</select>
		</p>
		<input type="submit" name="previous" value="Previous" style="width: 100%;" formaction="{{Route('/')}}" />
        <button type="submit" id="button_formsubmit" style="width:100%;">Submit</button>
	</form>
	<script type="text/javascript">
		function validation(){
			var billing_firstname		= document.getElementById('billing_firstname').value;
			var billing_lastname		= document.getElementById('billing_lastname').value;
			var billing_address			= document.getElementById('billing_address').value;
			var billing_country			= document.getElementById('billing_country').value;
			var billing_state			= document.getElementById('billing_state').value;
			var billing_city			= document.getElementById('billing_city').value;
			var billing_email			= document.getElementById('billing_email').value;
			var billing_phonenumber		= document.getElementById('billing_phonenumber').value;
			var name_oncard				= document.getElementById('name_oncard').value;
			var card_number				= document.getElementById('card_number').value;
			var cvv						= document.getElementById('cvv').value;
			
			if ([billing_firstname, billing_lastname, billing_address, billing_country, billing_state, billing_city, billing_email, billing_phonenumber, name_oncard, card_number, cvv].includes("")) {
				alert('Fields With "*" are Required');
				return false
			}else{
				return true;
			}
		}
	</script>
</body>
</html>