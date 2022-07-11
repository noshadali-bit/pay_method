<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h1>Stripe Payment</h1>
                <table>
                    <tr>
                        <th></th>
                    </tr>
                </table>
                <h1>Paypal Payment</h1>
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Payment ID</th>
                            <th>Payer ID</th>
                            <th>Payment Status</th>
                            <th>Description</th>
                            <th>payment_gateway</th>
                            <th>sale_amount</th>
                            <th>sale_currency</th>
                            <th>customer_id</th>
                            <th>created_at</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $val)
                        <tr>
                            <th>{{ $val->id }}</th>
                            <td>{{ $val->payment_id }}</td>
                            <td>{{ $val->payer_id }}</td>
                            <td>{{ $val->payment_status }}</td>
                            <td>{{ $val->sescription }}</td>
                            <td>{{ $val->payment_gateway }}</td>
                            <td>{{ $val->sale_amount }}</td>
                            <td>{{ $val->sale_currency }}</td>
                            <td>{{ $val->customer_id }}</td>
                            <td>{{ $val->created_at }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>