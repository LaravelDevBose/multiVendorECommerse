<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use willvincent\Rateable\Rateable;

class Shop extends Model
{
    use Rateable;

    protected $fillable = [
        'shopName', 'shopTypeId','shopEmail','webAddress', 'shopLogo', 'status'
    ];
}
