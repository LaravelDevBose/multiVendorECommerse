<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PrimaryColor extends Model
{
    protected $fillable = [
        'colorName','colorCode',
    ];
}
