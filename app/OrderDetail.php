<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    protected $fillable = [
        'consumerId','orderId','ownerId','productId','productName','productPrice','productQuantity','sizes', 'priColors','secColors','subTotal','status'
    ];
}
