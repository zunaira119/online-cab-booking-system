<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Route extends Model
{
    protected $fillable=[
        'ending_point','s_latitude','s_longitude','e_latitude','e_longitude'
    ];
    public function vehicles()
    {
        return $this->hasMany(Vehicle::class);
    }


}
