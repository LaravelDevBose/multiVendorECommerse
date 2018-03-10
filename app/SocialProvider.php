<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SocialProvider extends Model
{
    //

    protected $fillable=[
        'providerId', 'provider'
    ];

    function user(){
        return $this->belongsTo(User::Class);
    }
}
