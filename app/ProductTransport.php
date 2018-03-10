<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductTransport extends Model
{
    protected $fillable = [
        'transportType','transportTitle', 'details','transportTime','timePeriod', 'cartWeight','areaIds','price','status','zoneType',
        'transportOne','transportTwo','transportThree'
    ];
}
