<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ConsumerQuestion extends Model
{
    protected $fillable = [
        'ownerId','productId','qusenId','name','email', 'message', 'status',
    ];
}
