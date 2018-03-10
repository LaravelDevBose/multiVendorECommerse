<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    protected $fillable = ['title', 'details', 'status', 'promotionOne', 'PromotionTwo'];

}
