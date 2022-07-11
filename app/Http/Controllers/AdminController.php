<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\Customer;
use App\Models\StripePayment;

class AdminController extends Controller
{
    function __construct(){
        $this->middleware('AdminMiddleware');
    }

    function dashboard(){

        $customer = Customer::all();
        $payment = Payment::all();
        $stripe = StripePayment::all();
       
        return view('dashboard',compact('customer', 'payment', 'stripe'));
    }
}
