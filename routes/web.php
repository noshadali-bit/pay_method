<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LinkGeneratorController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::match( ['GET', 'POST'], '/', [LinkGeneratorController::class, 'index'])->name('/');
Route::post('/formSubmit_1', [LinkGeneratorController::class, 'formSubmit_1'])->name('formSubmit_1');

Route::post('/paypal-gateway', [LinkGeneratorController::class, 'paypalGateway'])->name('paypal-gateway');
Route::post('/stripe-gateway', [LinkGeneratorController::class, 'stripeGateway'])->name('stripe-gateway');
Route::post('/authorize-gateway', [LinkGeneratorController::class, 'authorizeGateway'])->name('authorize-gateway');

Route::get('/login', function(){
    return view('auth.login');
})->name('login');

Route::get('/signup', function(){
    return view('auth.signup');
})->name('signup');

Route::post('/login-process', [LoginController::class, 'login'])->name('login-process');
Route::post('/signup-process', [LoginController::class, 'signup'])->name('signup-process');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
Route::get('/payments', [AdminController::class, 'payments'])->name('payments');
Route::get('/customers', [AdminController::class, 'customers'])->name('customers');

// Route::get('send-mail', function () {
   
//     $details = [
//         'title' => 'Mail from ItSolutionStuff.com',
//         'body' => 'This is for testing email using smtp'
//     ];
   
//     \Mail::to('your_receiver_email@gmail.com')->send(new \App\Mail\sendMail($details));
   
//     dd("Email is Sent.");
// });