<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductReviewsComment extends Model
{
    protected $fillable = [
        'userId','productId', 'uploderId','UploderType', 'comment'
    ];
}
