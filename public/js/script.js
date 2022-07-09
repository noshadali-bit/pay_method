		/*var cdn = document.createElement('script');
		cdn.setAttribute('src','https://www.paypal.com/sdk/js?client-id=Afg7zK5Xz35iFs2fpU1yVwZPe59-drLsi556dKRAd1cUtOllbu7xn6w8OZulcwCCZx7Q7s_iaGhzoSDA&currency=EUR&locale=en_US');
		document.head.appendChild(cdn);*/
 		var currentTab = 0; // Current tab is set to be the first tab (0)
 		showTab(currentTab); // Display the current tab
 		function showTab(n) {

 		  // This function will display the specified tab of the form ...
 		  var x = document.getElementsByClassName("tab");
 		  x[n].style.display = "block";
 		  // ... and fix the Previous/Next buttons:
 		  if (n == 0) {
 		    document.getElementById("prevBtn").style.display = "none";
 		  } else {
 		    document.getElementById("prevBtn").style.display = "inline";
 		  }

 		  if (n == (x.length - 1)) {
 		    document.getElementById("nextBtn").innerHTML = "Submit";
 		  } else {
 		    document.getElementById("nextBtn").innerHTML = "Next";
 		  }
 		  // ... and run a function that displays the correct step indicator:
 		  fixStepIndicator(n)
 		}

 		function nextPrev(n) {
 		  // This function will figure out which tab to display
 		  // window.scrollTo(0, 0);
 		  var x = document.getElementsByClassName("tab");
 		  // Exit the function if any field in the current tab is invalid:
	 		if (n == 1) {
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


	 		  	var billing_firstname	= document.getElementById('billing_firstname').value;
	 		  	var billing_lastname	= document.getElementById('billing_lastname').value;
	 		  	var billing_address		= document.getElementById('billing_address').value;
	 		  	var billing_country		= document.getElementById('billing_country').value;
	 		  	var billing_state		= document.getElementById('billing_state').value;
	 		  	var billing_city		= document.getElementById('billing_city').value;
	 		  	var postal_code			= document.getElementById('postal_code').value;
	 		  	var billing_email		= document.getElementById('billing_email').value;
	 		  	var billing_phonenumber	= document.getElementById('billing_phonenumber').value;

	 			if ([sale_amount, description, sales_email, customer_email].includes("") || (!paypal && !stripeCheck && !authorize && !authorize3)) {
	 				alert('Fields With "*" are Required');
	 				return false;
	 			}
	 		  	
	 		  	window.scrollTo(0, 0);

	 		  	document.getElementById('sale_amount2').value = sale_amount;
	 		  	document.getElementById('sale_currency2').value = sale_currency+'-'+sale_amount;
	 		  	document.getElementById('billing_email').value = customer_email;
	 		  	if(stripeCheck){
	 		  		document.getElementById('stripeSpan').style.display = 'block';
	 		  		document.getElementById("nextBtn").style.display = 'none';
	 		  		document.getElementById("stripeBtn").style.display = 'block';
	 		  	}else if(paypal){
	 		  		document.getElementById('paypalSpan').style.display = 'block';
	 		  		paypal_sdk.Buttons({style: { 
	 		  			label : 'pay',
	 		  		}}).render("#paypalSpan");
	 		  		document.getElementById("nextBtn").style.display = 'none';
	 		  	}else if(authorize){
	 		  		document.getElementById('authorizeSpan').style.display = 'block';

	 		  	}
	 		}
 		  // Hide the current tab:
 		  x[currentTab].style.display = "none";
 		  // Increase or decrease the current tab by 1:
 		  currentTab = currentTab + n;
 		  // if you have reached the end of the form... :
 		  if (currentTab >= x.length) {
 		    //...the form gets submitted:
 		    // document.getElementById("nextBtn").setAttribute('type','submit');
 		    document.getElementById("regForm").submit();
 		    return false;
 		  }
 		  // Otherwise, display the correct tab:
 		  showTab(currentTab);
 		}

 		function stripePay(){
 			var stripe = Stripe('pk_test_51LCp45IJM8g1wMASTKaKUtJLCkRpkJy9LjBX7ccDRjdacXCiTZY2zM12HUrht6tHr5udUEVioqtNUmGFgpEb0jL700G2N2usB6');
 		  		stripe.redirectToCheckout({
 		  			lineItems: [
 		  				{
 		  					price: 'price_1LD5KVIJM8g1wMASCW4PRiNr',
 		  					quantity: 1,
 		  				},
 		  			],
 		  			mode: 'subscription',
 		  			successUrl: 'https://www.google.com/',
 		  			cancelUrl: 'https://www.twitter.com/',
 		  		}).then(function(result){
 		  			alert(result);
 		  		})
 		}

 		function fixStepIndicator(n) {
 		  // This function removes the "active" class of all steps...
 		  var i, x = document.getElementsByClassName("step");
 		  for (i = 0; i < x.length; i++) {
 		    x[i].className = x[i].className.replace(" active", "");
 		  }
 		  //... and adds the "active" class to the current step:
 		  x[n].className += " active";
 		}