<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable=[

    'mainCatId','secondCatId','thirdCatId','categoryName', 'position','promotionCode','image','publicationStatus','catFOne', 'catFTwo', 'catFthree', 'catFfour', 'catFfive'
    ];
}
