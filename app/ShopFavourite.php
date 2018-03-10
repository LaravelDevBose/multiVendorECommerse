<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShopFavourite extends Model
{
    protected $fillable = [
        'userId','shopId'
    ];
}
