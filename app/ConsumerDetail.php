<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ConsumerDetail extends Model
{
    protected $fillable = [
        'userId','nationalId','houseNo', 'roadNo','village','policeStation',
        'postOffice','zipCode','district','country' 
    ];
}
