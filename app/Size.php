<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    protected $fillable = ['mainCatId','secondCatId','thirdCatId','fourthCatId','sizeTitle', 'details','status', 'sizefieldOne', 'sizefieldTwo'];
}
