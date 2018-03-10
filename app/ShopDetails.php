<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShopDetails extends Model
{
    protected $fillable = [
        'shopId','aboutShop','shippingPolicy','returnPolicy','bannerImage'
        
    ];
}
