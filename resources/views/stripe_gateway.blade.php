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
	<form role="form" class="require-validation" action="{{Route('stripe-gateway')}}" method="POST" data-stripe-publishable-key="pk_test_51LJg8yEQArJ4EtpN0SNTyLKoQi0gpW6MsCsI4aURdkkXssj2griH1rShwTJ0caH4w9ZXLZlmez29lNzmWlNNMgb200H1cwWUYc" id="payment-form" data-cc-on-file="false">
		@csrf
		<h1  class="panel-title">LINK GENERATOR FOR PAYMENT</h1>
		<input type="hidden" name="payment_gateway" id="payment_method" value="Stripe" />
    	
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
			<input class="form-control" type="text" name="billing_firstname" id="billing_firstname" required>
		</p>
		<p>
			<label for="billing_lastname">Last Name *</label>
			<input class="form-control" type="text" name="billing_lastname" id="billing_lastname" required>
		</p>
		<p>
			<label for="billing_address">Address *</label>
			<input class="form-control" type="text" name="billing_address" id="billing_address" required>
		</p>
		<p>
			<label for="billing_country">Country *</label>
			<input class="form-control" type="text" name="billing_country" id="billing_country" required>
		</p>
		<p>
			<label for="billing_state">State/Province *</label>
			<input class="form-control" type="text" name="billing_state" id="billing_state" required>
		</p>
		<p>
			<label for="billing_city">City *</label>
			<input class="form-control" type="text" name="billing_city" id="billing_city" required>
		</p>
		<p>
			<label for="postal_code">ZIP/Postal Code *</label>
			<input class="form-control" type="text" name="postal_code" id="postal_code" required>
		</p>
		<p>
			<label for="billing_email">Billing Email</label>
			<input class="form-control" type="email" name="billing_email" id="billing_email" value="{{$request->customer_email}}" required>
		</p>
		<p>
			<label for="billing_phonenumber">Phone/Cell Number *</label>
			<input class="form-control" type="number" name="billing_phonenumber" id="billing_phonenumber" required>
		</p>
		<h4>
			Pay Now
		</h4>
		<p>
			<label for="name_oncard">Name on Card</label>
			<input class="form-control" type="text" name="name_oncard" id="name_oncard" required>
		</p>
		<p>
			<label for="card_number">Card Number</label>
			<input class="form-control card-number" type="number" name="card_number" id="card_number" autocomplete="off" required>
		</p>
		<p>
			<label for="cvv">CVV</label>
			<input class="card-cvc form-control" type="number" name="cvv" id="cvv" autocomplete="off" required>
		</p>
		<p>
			<label for="expiration_month">Expiration Month</label>
			<select name="expiration_month" id="expiration_month" class="card-expiry-month form-select" >
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
			<select name="expiration_year" id="expiration_year" class="card-expiry-year form-select">
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
		<input class="btn btn-primary" type="submit" name="previous" value="Previous" style="width: 100%;" formaction="{{Route('/')}}" />
		<br>
		<button class="btn btn-primary" type="button" id="order_formsubmit" style="width:100%;">Submit</button>
        <button type="submit" id="button_formsubmit" style="display:none;width:100%;">Submit</button>
	</form>
	</div>
	<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
	<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
	<script type="text/javascript" src="{{asset('js/numeric-1.2.6.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('js/bezier.js')}}"></script>
	<script type="text/javascript" src="{{asset('js/jquery.signaturepad.js')}}"></script>
	<script type="text/javascript" src="{{asset('js/json2.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('js/bootstrap-notify.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('js/public.js')}}"></script>
	<script type="text/javascript" src="{{asset('js/ycommon.js')}}"></script>
	<script type="text/javascript">
	    $(function() {
	        var $form = $(".require-validation");
	        $('form.require-validation').bind('submit', function(e) {
	            var $form         = $(".require-validation"),
	            inputSelector = [
	                            'input[type=email]',
	                            'input[type=password]',
	                            'input[type=text]', 
	                            'textarea'].join(', '),
	            $inputs       = $form.find('.required').find(inputSelector),
	            $errorMessage = $form.find('div.error'),
	            valid         = true;
	            $errorMessage.addClass('hide');
	     
	            $('.has-error').removeClass('has-error');
	            $inputs.each(function(i, el) {
	                var $input = $(el);
	                if ($input.val() === '') {
	                    $input.parent().addClass('has-error');
	                    $errorMessage.removeClass('hide');
	                    e.preventDefault();
	                }
	            });
	      
	            if (!$form.data('cc-on-file')) {
	                e.preventDefault();
	                Stripe.setPublishableKey($form.data('stripe-publishable-key'));
	                Stripe.createToken({
	                    number: $('.card-number').val(),
	                    cvc: $('.card-cvc').val(),
	                    exp_month: $('.card-expiry-month').val(),
	                    exp_year: $('.card-expiry-year').val()
	                }, stripeResponseHandler);
	            }
	        });
	      
	        function stripeResponseHandler(status, response) {
	            if (response.error) {
	                $('.error')
	                    .removeClass('hide')
	                    .find('.alert')
	                    .text(response.error.message);
	                    $body.removeClass("loading");
	                    generateNotification(0,response.error.message);
	                    return false;
	            } else {
	                // token contains id, last4, and card type
	                var token = response['id'];
	                // insert the token into the form so it gets submitted to the server
	                $form.find('input[type=text]').empty();
	                $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
	                $form.get(0).submit();
	            }
	        }
	      
	    });
	</script>
	<script>
	   $body = $("body");
	    $body.removeClass("loading");
	    $("#order_formsubmit").click(function(e){
	        var countt = 0;
	            
	        $(".valid").each(function() {
	            var element = $(this);
	            if (element.val() == "") {
	                countt = 1;
	            }
	        });
	            
	        var fields = $('input.required');
	        for(var i=0;i<fields.length;i++){
	            if($(fields[i]).val() != ''){
	                //whatever
	            }else{
	                e.preventDefault();
	            }
	        }

	        if(countt == 0){
	            $body.addClass("loading");
	        }else{
	            $body.removeClass("loading");
	        }
	        console.log(countt)
	      
	      $("#button_formsubmit").click();
	    });
	</script>
</body>
</html>