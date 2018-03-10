<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class YoutubeVideo extends Model
{
    protected $fillable = [
        'videoTitle', 'ownerId','videoPath','shortNote','status',
    ];
}
