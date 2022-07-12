<?php

namespace App\Http\Controllers;
use net\authorize\api\contract\v1 as AnetAPI;
use net\authorize\api\controller as AnetController;

use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\StripePayment;
use App\Models\Customer;

class LinkGeneratorController extends Controller
{
    function index(Request $request) {
        if (isset($request->previous)) {
            return view('link_generator_form-1', compact('request'));
        }else{
            return view('link_generator_form-1');
        }
    }

    public function formSubmit_1(Request $request){
        if (isset($request->next)) {
            
            if($request->filled('payment_gateway') && $request->payment_gateway == 'paypal'){
                return view('paypal_gateway',compact('request'));
            }
            if($request->filled('payment_gateway') && $request->payment_gateway == 'stripe'){
                return view('stripe_gateway',compact('request'));
            }
            if($request->filled('payment_gateway') && $request->payment_gateway == 'authorize'){
                return view('authorize_gateway',compact('request'));
            }

        }

    }
    function paypalGateway(Request $request){
        $customer = Customer::where('customer_email', $request->customer_email)->first();
        if ($customer) {
            
            $customer->billing_firstname        = $request->billing_firstname;
            $customer->billing_lastname         = $request->billing_lastname;
            $customer->billing_address          = $request->billing_address;
            $customer->billing_city             = $request->billing_city;
            $customer->billing_state            = $request->billing_state;
            $customer->postal_code              = $request->postal_code;
            $customer->billing_country          = $request->billing_country;
            $customer->billing_email            = $request->billing_email;
            $customer->billing_phonenumber      = $request->billing_phonenumber;
            $customer->sales_email              = $request->sales_email;
            if($customer->save()){
                $payment = new Payment();

                $payment->payment_id            = $request->payment_id;
                $payment->payer_id              = $request->payer_id;
                $payment->payment_status        = $request->payment_status;
                $payment->description           = $request->description;
                $payment->payment_gateway       = $request->payment_gateway;
                $payment->sale_amount           = $request->sale_amount;
                $payment->sale_currency         = $request->sale_currency;
                $payment->customer_id           = $customer->id;
                if ($payment->save()) {
                    return redirect(Route('/'))->with('msg','Payment Successfull');
                }else{
                    return redirect(Route('/'))->with('msg','Something Went Wrong');
                }
            }else{
                return redirect(Route('/'))->with('msg','Something Went Wrong');
            }

        }else{
            /*
                Insert new Customer
            */

            $customer = new Customer();

            $customer->billing_firstname            = $request->billing_firstname;
            $customer->billing_lastname             = $request->billing_lastname;
            $customer->billing_address              = $request->billing_address;
            $customer->billing_city                 = $request->billing_city;
            $customer->billing_state                = $request->billing_state;
            $customer->postal_code                  = $request->postal_code;
            $customer->billing_country              = $request->billing_country;
            $customer->billing_email                = $request->billing_email;
            $customer->billing_phonenumber          = $request->billing_phonenumber;
            $customer->sales_email                  = $request->sales_email;
            $customer->customer_email               = $request->customer_email;

            if ($customer->save()) {
                $payment = new Payment();

                $payment->payment_id                = $request->payment_id;
                $payment->payer_id                  = $request->payer_id;
                $payment->payment_status            = $request->payment_status;
                $payment->description               = $request->description;
                $payment->payment_gateway           = $request->payment_gateway;
                $payment->sale_amount               = $request->sale_amount;
                $payment->sale_currency             = $request->sale_currency;
                $payment->customer_id               = $customer->id;
                if ($payment->save()) {
                    // $details = $payment;
                   
                    // \Mail::to($request->billing_email)->send(new \App\Mail\sendMail($details));
                   
                    dd("Email is Sent.");
                    return redirect(Route('/'))->with('msg','Payment Successfull');
                }else{
                    return redirect(Route('/'))->with('msg','Something Went Wrong');
                }
            }else{
                return redirect(Route('/'))->with('msg','Something Went Wrong');
            }

        }
    }

    function stripeGateway(Request $request){
        $customer = Customer::where('customer_email', $request->customer_email)->first();
        if ($customer) {
            
            $customer->billing_firstname        = $request->billing_firstname;
            $customer->billing_lastname         = $request->billing_lastname;
            $customer->billing_address          = $request->billing_address;
            $customer->billing_city             = $request->billing_city;
            $customer->billing_state            = $request->billing_state;
            $customer->postal_code              = $request->postal_code;
            $customer->billing_country          = $request->billing_country;
            $customer->billing_email            = $request->billing_email;
            $customer->billing_phonenumber      = $request->billing_phonenumber;
            $customer->sales_email              = $request->sales_email;
            
            if($customer->save()){
                $stripe_payment = new StripePayment();
                $stripe_payment->payment_gateway = $request->payment_gateway;
                $stripe_payment->stripeToken = $request->stripeToken;
                $stripe_payment->description = $request->description;
                $stripe_payment->sale_amount = $request->sale_amount;
                $stripe_payment->sale_currency = $request->sale_currency;
                $stripe_payment->name_oncard = $request->name_oncard;
                $stripe_payment->card_number = $request->card_number;
                $stripe_payment->cvv = $request->cvv;
                $stripe_payment->expiration_month = $request->expiration_month;
                $stripe_payment->expiration_year = $request->expiration_year;
                $stripe_payment->customer_id = $customer->id;
                if ($stripe_payment->save()) {
                    // $details = $stripe_payment;
                   
                    // \Mail::to($request->billing_email)->send(new \App\Mail\sendMail($details));

                    return redirect(Route('/'))->with('msg','Payment Successfull');
                }else{
                    return redirect(Route('/'))->with('msg','Something Went Wrong');
                }
            }else{
                return redirect(Route('/'))->with('msg','Something Went Wrong');
            }

        }else{

            $customer = new Customer();

            $customer->billing_firstname = $request->billing_firstname;
            $customer->billing_lastname = $request->billing_lastname;
            $customer->billing_address = $request->billing_address;
            $customer->billing_city = $request->billing_city;
            $customer->billing_state = $request->billing_state;
            $customer->postal_code = $request->postal_code;
            $customer->billing_country = $request->billing_country;
            $customer->billing_email = $request->billing_email;
            $customer->billing_phonenumber = $request->billing_phonenumber;
            $customer->sales_email = $request->sales_email;
            $customer->customer_email = $request->customer_email;

            if ($customer->save()) {
                $stripe_payment = new StripePayment();

                $stripe_payment->payment_gateway = $request->payment_gateway;
                $stripe_payment->stripeToken = $request->stripeToken;
                $stripe_payment->description = $request->description;
                $stripe_payment->sale_amount = $request->sale_amount;
                $stripe_payment->sale_currency = $request->sale_currency;
                $stripe_payment->name_oncard = $request->name_oncard;
                $stripe_payment->card_number = $request->card_number;
                $stripe_payment->cvv = $request->cvv;
                $stripe_payment->expiration_month = $request->expiration_month;
                $stripe_payment->expiration_year = $request->expiration_year;
                $stripe_payment->customer_id = $customer->id;
                if ($stripe_payment->save()) {
                    
                    // $details = $stripe_payment;
                    // \Mail::to($request->billing_email)->send(new \App\Mail\sendMail($details));
                    
                    return redirect(Route('/'))->with('msg','Payment Successfull');
                }else{
                    return redirect(Route('/'))->with('msg','Something Went Wrong');
                }
            }else{
                return redirect(Route('/'))->with('msg','Something Went Wrong');
            }

        }
    }

    function authorizeGateway(Request $request){

        $merchantAuthentication = new AnetAPI\MerchantAuthenticationType();
        $merchantAuthentication->setName(env('MERCHANT_LOGIN_ID'));
        $merchantAuthentication->setTransactionKey(env('MERCHANT_TRANSACTION_KEY'));

        $refId = 'ref' . time();
        $cardNumber = preg_replace('/\s+/', '', $request->card_number);

        $creditCard = new AnetAPI\CreditCardType();
        $creditCard->setCardNumber($cardNumber);
        $creditCard->setExpirationDate($request->expiration_year . "-" .$request->expiration_month);
        $creditCard->setCardCode($request->cvv);

        $paymentOne = new AnetAPI\PaymentType();
        $paymentOne->setCreditCard($creditCard);

        $transactionRequestType = new AnetAPI\TransactionRequestType();
        $transactionRequestType->setTransactionType("authCaptureTransaction");
        $transactionRequestType->setAmount($request->sale_amount);
        $transactionRequestType->setPayment($paymentOne);

        $requests = new AnetAPI\CreateTransactionRequest();
        $requests->setMerchantAuthentication($merchantAuthentication);
        $requests->setRefId($refId);
        $requests->setTransactionRequest($transactionRequestType);

        $controller = new AnetController\CreateTransactionController($requests);
        $response = $controller->executeWithApiResponse(\net\authorize\api\constants\ANetEnvironment::SANDBOX);
        if($response){

            $customer = Customer::where('customer_email', $request->customer_email)->first();
            if ($customer) {
                /*
                    if customer Exists, Update!
                */
                $customer->billing_firstname        = $request->billing_firstname;
                $customer->billing_lastname         = $request->billing_lastname;
                $customer->billing_address          = $request->billing_address;
                $customer->billing_city             = $request->billing_city;
                $customer->billing_state            = $request->billing_state;
                $customer->postal_code              = $request->postal_code;
                $customer->billing_country          = $request->billing_country;
                $customer->billing_email            = $request->billing_email;
                $customer->billing_phonenumber      = $request->billing_phonenumber;
                $customer->sales_email              = $request->sales_email;
                if($customer->save()){
                    $stripe_payment = new StripePayment();

                    $stripe_payment->payment_gateway            = $request->payment_gateway;
                    // $stripe_payment->stripeToken                = $request->stripeToken;
                    $stripe_payment->description                = $request->description;
                    $stripe_payment->sale_amount                = $request->sale_amount;
                    $stripe_payment->sale_currency              = $request->sale_currency;
                    $stripe_payment->name_oncard                = $request->name_oncard;
                    $stripe_payment->card_number                = $request->card_number;
                    $stripe_payment->cvv                        = $request->cvv;
                    $stripe_payment->expiration_month           = $request->expiration_month;
                    $stripe_payment->expiration_year            = $request->expiration_year;
                    $stripe_payment->customer_id                = $customer->id;
                    if ($stripe_payment->save()) {
                        return redirect(Route('/'))->with('msg','Payment Successfull');
                    }else{
                        return redirect(Route('/'))->with('msg','Something Went Wrong');
                    }
                }else{
                    return redirect(Route('/'))->with('msg','Something Went Wrong');
                }

            }else{
                /*
                    Insert new Customer
                */

                $customer = new Customer();

                $customer->billing_firstname            = $request->billing_firstname;
                $customer->billing_lastname             = $request->billing_lastname;
                $customer->billing_address              = $request->billing_address;
                $customer->billing_city                 = $request->billing_city;
                $customer->billing_state                = $request->billing_state;
                $customer->postal_code                  = $request->postal_code;
                $customer->billing_country              = $request->billing_country;
                $customer->billing_email                = $request->billing_email;
                $customer->billing_phonenumber          = $request->billing_phonenumber;
                $customer->sales_email                  = $request->sales_email;
                $customer->customer_email               = $request->customer_email;

                if ($customer->save()) {
                    $stripe_payment = new StripePayment();

                    $stripe_payment->payment_gateway            = $request->payment_gateway;
                    // $stripe_payment->stripeToken                = $request->stripeToken;
                    $stripe_payment->description                = $request->description;
                    $stripe_payment->sale_amount                = $request->sale_amount;
                    $stripe_payment->sale_currency              = $request->sale_currency;
                    $stripe_payment->name_oncard                = $request->name_oncard;
                    $stripe_payment->card_number                = $request->card_number;
                    $stripe_payment->cvv                        = $request->cvv;
                    $stripe_payment->expiration_month           = $request->expiration_month;
                    $stripe_payment->expiration_year            = $request->expiration_year;
                    $stripe_payment->customer_id                = $customer->id;
                    if ($stripe_payment->save()) {
                        return redirect(Route('/'))->with('msg','Payment Successfull');
                    }else{
                        return redirect(Route('/'))->with('msg','Something Went Wrong');
                    }
                }else{
                    return redirect(Route('/'))->with('msg','Something Went Wrong');
                }

            }            
        }
    }

}
