<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'consumerId','shippingId','paymentId','totalProduct','totalAmmount', 'status'
    ];
}
