<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StripePayment extends Model
{
    use HasFactory;
    protected $table = 'stripe_payments';
    protected $fillable = [
        'payment_gateway',
        'stripeToken',
        'description',
        'sale_amount',
        'sale_currency',
        'name_oncard',
        'card_number',
        'cvv',
        'expiration_month',
        'expiration_year',
        'customer_id',
    ];
}
