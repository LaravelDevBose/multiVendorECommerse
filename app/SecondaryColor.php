<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SecondaryColor extends Model
{
    protected $fillable = [
        'colorName','colorCode',
    ];
}
