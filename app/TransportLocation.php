<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransportLocation extends Model
{
    protected $fillable = [
        'divisionId','districtId','otherAreaId','areaName', 'locationOne', 'locationTwo'
    ];
}
