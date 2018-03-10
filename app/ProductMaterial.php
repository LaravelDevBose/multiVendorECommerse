<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductMaterial extends Model
{
    protected $fillable =['materialName', 'details','materialOne','materialTwo','materialThree'];
}
