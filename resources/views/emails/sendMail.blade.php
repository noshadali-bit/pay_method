<!DOCTYPE html>
<html>
<head>
    <title>Payment Gateway</title>
</head>
<body>
    <h1>{{ $details['payment_gateway'] }}</h1>
    <p>Payment Gateway : <b>{{ $details['payment_gateway'] }}</b></p>
    <p>Description : <b>{{ $details['description'] }}</b></p>
    <p>Sale Amount : <b>{{ $details['sale_amount'] }}</b></p>
    <p>Sale Currency : <b>{{ $details['sale_currency'] }}</b></p>
    @isset($details['payer_id'])
    <p>Payer ID : <b>{{ $details['payer_id'] }}</b></p>
    @endisset
    @isset($details['name_oncard'])
    <p>Card Name : <b>{{ $details['name_oncard'] }}</b></p>
    <p>Card Number : <b>{{ $details['card_number'] }}</b></p>
    <p>CSV : <b>{{ $details['cvv'] }}</b></p>
    @endisset
    <p>Thank you</p>
</body>
</html>