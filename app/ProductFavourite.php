<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductFavourite extends Model 
{
    protected $fillable = [
        'userId','productId'
    ];

}
