 <!DOCTYPE html>
 <html>
 <head>
 	<meta charset="utf-8">
 	<meta name="viewport" content="width=device-width, initial-scale=1">
	 <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
 	<title>Link Generator</title>
 	<style type="text/css">
 		 /* Style the form */
 		#regForm {
 		  background-color: #ffffff;
 		  margin: 100px auto;
 		  padding: 40px;
 		  width: 70%;
 		  min-width: 300px;
 		}

 		input.invalid {
 		  background-color: #ffdddd;
 		}

 		.tab {
 		  display: none;
 		}

 		.step {
 		  height: 15px;
 		  width: 15px;
 		  margin: 0 2px;
 		  background-color: #bbbbbb;
 		  border: none;
 		  border-radius: 50%;
 		  display: inline-block;
 		  opacity: 0.5;
 		}

 		.step.active {
 		  opacity: 1;
 		}

 		.step.finish {
 		  background-color: #04AA6D;
 		} 
 	</style>
 	<script src="https://js.stripe.com/v3/"></script>
 </head>
 <body>
 	<div>
 		 <form method="POST" action="{{Route('formSubmit')}}" id="regForm">
 		 	@csrf
		<div class="row tab" >
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
					<textarea  class="form-control" name="description" id="description" rows="3" cols="120" >{{$request->description??''}}</textarea>
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
				<input type="checkbox" id="pack0" name="package[]" value="Logo Design" >
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
	</div>

	<div class="row tab">
		<div class="col-md-12">
			<div class="form-group">
 				<label for="sale_amount2">Amount *</label>
 				<input class="form-control" type="number" id="sale_amount2" disabled>
			</div>
		</div>
		<div class="col-md-12">
			<div class="form-group">
	 			<label for="sale_currency2">Amount Currency *</label>
				<input class="form-control" type="text" id="sale_currency2" disabled>
			</div>
		</div>
		<div class="col-md-12">
			<div class="panel-heading">
				<h4 class="panel-title">BILLING DETAILS :</h4>
			</div>
		</div>
	 				
		<div class="form-group">
			<div class="col-md-12">
				<label for="billing_firstname">First Name *</label>
 				<input class="form-control" type="text" name="billing_firstname" id="billing_firstname" >
			</div>
		</div>
	 	<div class="col-md-12">
		 <div class="form-group">
			<label for="billing_lastname">Last Name *</label>
	 		<input class="form-control" type="text" name="billing_lastname" id="billing_lastname" >
			</div>
		</div>
		<div class="col-md-12">
			<div class="form-group">
				<label for="billing_address">Address *</label>
	 			<input class="form-control" type="text" name="billing_address" id="billing_address" >
			</div>
		</div>
	 	<div class="col-md-12">
		 	<div class="form-group">
	 			<label for="billing_country">Country *</label>
				<input class="form-control" type="text" name="billing_country" id="billing_country" >
			</div>
		</div>
		<div class="col-md-12">
			<div class="form-group">
				<label for="billing_state">State/Province *</label>
				<input class="form-control" type="text" name="billing_state" id="billing_state" >
			</div>
		</div>
		<div class="col-md-12">
			<div class="form-group">
				<label for="billing_city">City *</label>
				<input class="form-control" type="text" name="billing_city" id="billing_city" >
			</div>
		</div>
		<div class="col-md-12">
			<div class="form-group">
	 			<label for="postal_code">ZIP/Postal Code *</label>
				<input class="form-control" type="text" name="postal_code" id="postal_code" >
			</div>
		</div>
		<div class="col-md-12">
			<div class="form-group">
 				<label for="billing_email">Billing Email</label>
 				<input class="form-control" type="email" name="billing_email" id="billing_email" >
			</div>
		</div>
		<div class="col-md-12">
			<div class="form-group">
				<label for="billing_phonenumber">Phone/Cell Number *</label>
				<input class="form-control" type="number" name="billing_phonenumber" id="billing_phonenumber" >
			</div>
		</div>
	<div class="col-md-12">
	 	<span id="paypalSpan" style="display:none;">
		 	<div class="panel-heading">
				<h4 class="panel-title">
				Pay now with your Debit / Credit card using our Paypal button
	 			</h4>
			</div>
		</span>
	</div>
	<span id="stripeSpan" style="display:none;">
		<div class="row">
			<div class="col-md-12">
				<div class="panel-heading">
					<h4 class="panel-title">
		 				Pay Now
		 			</h4>
		 		</div>
		 	</div>
			<div class="col-md-12" >
				<div class="form-group">
		 			<label for="name_oncard">Name on Card</label>
		 			<input class="form-control" type="text" name="name_oncard" id="name_oncard" >
				</div>
		 	</div>
			<div class="col-md-12" >
				<div class="form-group">
	 				<label for="card_number">Card Number</label>
	 				<input class="form-control" type="number" name="card_number" id="card_number" autocomplete="off" >
				</div>
		 	</div>
			<div class="col-md-12" >
				<div class="form-group">
					<label for="cvv">CVV</label>
		 			<input class="form-control" type="number" name="cvv" id="cvv"  autocomplete="off" >
				</div>
		 	</div>
			<div class="col-md-12" >
				<div class="form-group">
					<label for="expiration_month">Expiration Month</label>
		 			<select class="form-select" name="expiration_month" id="expiration_month" >
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
				</div>
		 	</div>
			<div class="col-md-12" >
				<div class="form-group">
					<label for="expiration_year">Expiration Year</label>
		 			<select class="form-select" name="expiration_year" id="expiration_year" >
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
		 		</div>
			</div>
		</span>
	</div>
	<div class="row" >
		<span id="authorizeSpan" style="display:none;">
			<div class="col-md-12" >
				<div class="form-group">
					<label for="name_oncard">Name On Card</label>
					<input class="form-control" type="text" id="name_oncard" name="name_oncard" >
				</div>
			</div>
	 		<div class="col-md-12" >
				<div class="form-group">
					<label for="cvv">CVV</label>
					<input class="form-control" type="number" id="cvv" name="cvv" autocomplete="off" >
				</div>
			</div>
	 		<div class="col-md-12" >
				<div class="form-group">
	            	<label for="card_number">Card Number</label>
                	<input class="form-control" type="text" id="card_number" name="card_number">
				</div>
			</div>
	 		<div class="col-md-12" >
				<div class="form-group">
		 			<label for="expiration_month">Expiration Month</label>
					<select class="form-control" name="expiration_month" id="expiration_month" >
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
				</div>
			</div>
	 		<div class="col-md-12" >
				<div class="form-group">
		 			<label for="expiration_year">Expiration Year</label>
					<select class="form-control" name="expiration_year" id="expiration_year" >
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
				</div>
			</div>
	 	</span>
	</div>

	<div style="overflow:auto;">
	 	<div style="float:right;">
	 		<button type="button" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
	 		<button type="button" onclick="stripePay(this)" style="display:none;" id="stripeBtn">Pay With Stripe</button>
	 		<button type="button" id="nextBtn" onclick="nextPrev(1)">Next</button>
	 	</div>
	</div>

	<div style="text-align:center;margin-top:40px;">
	 	<span class="step"></span>
	 	<span class="step"></span>
	</div>

</form> 
</div>
 	<script type="text/javascript" src="{{asset('js/script.js')}}"></script>
 	<script src="https://www.paypal.com/sdk/js?client-id=Afg7zK5Xz35iFs2fpU1yVwZPe59-drLsi556dKRAd1cUtOllbu7xn6w8OZulcwCCZx7Q7s_iaGhzoSDA&currency=EUR&locale=en_US" data-namespace="paypal_sdk"></script>
 	{{-- <script src="https://js.stripe.com/v3/" data-namespace="stripe_sdk"></script> --}}
 </body>
 </html>