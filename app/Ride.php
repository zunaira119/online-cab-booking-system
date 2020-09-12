<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ride extends Model
{
    protected $fillable=[
        'ending_point','e_latitude','e_longitude','vehicle_id','starting_point','s_latitude','s_longitude','status'
    ];
    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }
    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }
}
