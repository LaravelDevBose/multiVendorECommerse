<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductQuentity extends Model
{
    protected $fillable = [
        'productId','sizeId','quantity'
    ];
}
