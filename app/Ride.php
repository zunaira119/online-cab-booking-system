<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ride extends Model
{
    protected $fillable=[
        'ending_point','e_latitude','e_longitude','vehicle_id','starting_point'
    ];
    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }
}
