<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subcriber extends Model
{
    protected $fillable=[
        'subcriber_email','providerId', 'provider'
    ];
}
