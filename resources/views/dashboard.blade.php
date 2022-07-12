<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <title>Document</title>
    <style>
        .btn > a{
			color: white;
		}
    </style>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h1>Dashboard Customer</h1>
                <div width="100%">
                    <button class="btn btn-primary " style="float:right"><a href="{{route('logout')}}">Logout</a> </button>
                </div>
                <button class="btn btn-primary" id="cus_btn">Show Customer</button>
                <button class="btn btn-primary" id="pay_btn">Show Paypal Payment</button>
                <button class="btn btn-primary" id="str_btn">Show Stripe & Authorize Payment</button>
                <div id="customer">
                    <h2>Customer</h2>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Email</th>
                                <th>Billing Email</th>
                                <th>Billing Phone Number</th>
                                <th>Billing Address</th>
                                <th>Billing City</th>
                                <th>Billing State</th>
                                <th>Billing Country</th>
                                <th>Postal Code</th>
                                <th>Sales Email</th>
                                <th>Created At</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($customer as $val)
                            <tr>
                                <td>{{ $val->id }}</td>
                                <td>{{ $val->billing_firstname }}</td>
                                <td>{{ $val->billing_lastname }}</td>
                                <td>{{ $val->customer_email }}</td>
                                <td>{{ $val->billing_email }}</td>
                                <td>{{ $val->billing_phonenumber }}</td>
                                <td>{{ $val->billing_address }}</td>
                                <td>{{ $val->billing_city }}</td>
                                <td>{{ $val->billing_state }}</td>
                                <td>{{ $val->billing_country }}</td>
                                <td>{{ $val->postal_code }}</td>
                                <td>{{ $val->sales_email }}</td>
                                <td>{{ $val->created_at }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div id="paypal">
                    <h2>Paypal Payment</h2>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Payment ID</th>
                                <th>Payer ID</th>
                                <th>Payment Status</th>
                                <th>Description</th>
                                <th>Payment Gateway</th>
                                <th>Sale Amount</th>
                                <th>Sale Currency</th>
                                <th>Customer Full Name</th>
                                <th>Customer Email</th>
                                <th>Created At</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($payment as $val)
                            <tr>
                                <th>{{ $val->id }}</th>
                                <td>{{ $val->payment_id }}</td>
                                <td>{{ $val->payer_id }}</td>
                                <td>{{ $val->payment_status }}</td>
                                <td>{{ $val->sescription }}</td>
                                <td>{{ $val->payment_gateway }}</td>
                                <td>{{ $val->sale_amount }}</td>
                                <td>{{ $val->sale_currency }}</td>
                                @foreach($customer as $cus)
                                    @if($val->customer_id == $cus->id)
                                    <td>{{ $cus->billing_firstname }} {{ $cus->billing_lastname }} </td>
                                    <td>{{ $cus->customer_email }}</td>
                                    @endif
                                @endforeach    
                                <td>{{ $val->created_at }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                <div id="stripe">
                    <h2>Stripe & Authorize Payment</h2>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Payment Gateway</th>
                                <th>Stripe Token</th>
                                <th>Description</th>
                                <th>Sale Amount</th>
                                <th>Sale Currency</th>
                                <th>Card Name</th>
                                <th>Card Number</th>
                                <th>Expiration Month</th>
                                <th>Expiration Year</th>
                                <th>Customer Full Name</th>
                                <th>Customer Email</th>
                                <th>Created At</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($stripe as $val)
                            <tr>
                                <th>{{ $val->id }}</th>
                                <td>{{ $val->payment_gateway }}</td>
                                <td>{{ $val->stripeToken }}</td>
                                <td>{{ $val->description }}</td>
                                <td>{{ $val->sale_amount }}</td>
                                <td>{{ $val->sale_currency }}</td>
                                <td>{{ $val->name_oncard }}</td>
                                <td>{{ $val->card_number }}</td>
                                <td>{{ $val->cvv }}</td>
                                <td>{{ $val->expiration_month }}</td>
                                <td>{{ $val->expiration_year }}</td>
                                @foreach($customer as $cus)
                                    @if($val->customer_id == $cus->id)
                                    <td>{{ $cus->billing_firstname }} {{ $cus->billing_lastname }} </td>
                                    <td>{{ $cus->customer_email }}</td>
                                    @endif
                                @endforeach    
                                <td>{{ $val->created_at }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<script>
    // $("#customer").hide();
    $("#stripe").hide();
    $("#paypal").hide();
    $("#cus_btn").click(function(){
        $("#customer").show();
        $("#stripe").hide();
        $("#paypal").hide();
    });
    $("#pay_btn").click(function(){
        $("#stripe").show();
        $("#customer").hide();
        $("#paypal").hide();
    });
    $("#str_btn").click(function(){
        $("#paypal").show();
        $("#customer").hide();
        $("#stripe").hide();
    });
</script>
</html>
