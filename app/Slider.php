<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    protected $fillable = [
        'sliderTitle','shortNote','sliderAlign','image', 'publicationStatus'
    ];
}
