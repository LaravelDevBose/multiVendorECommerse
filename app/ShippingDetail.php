<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShippingDetail extends Model
{
    protected $fillable = [
        'userId','houseNo', 'roadNo','village','policeStation',
        'postOffice','zipCode','district','country'
    ]; 
}
