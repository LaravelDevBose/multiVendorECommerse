<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentDetail extends Model
{
    protected $fillable = [
        'userId','paymentType','cardName','cardNumber','cardHolderName', 'exptDate'
    ]; 
}
