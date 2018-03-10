<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GiftType extends Model
{
    protected $fillable=[

    'giftTitle','position','image', 'publicationStatus'
    ];
}
