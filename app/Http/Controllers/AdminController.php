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

    function adminDashboard(){
        $total_payments = Payment::all()->count() + StripePayment::all()->count();
        $total_customers = Customer::all()->count();
        // $total_customers = ;
        // dd($total_customers);
        return view('admin.dashboard',compact('total_payments', 'total_customers'));
    }

    function payments(){
        $payments = Payment::get()->concat(StripePayment::get());
        dd($payments);
    }

    function customers(){
        $customers = Customer::all();
        return view('admin.customers', compact('customers'));
    }
}
