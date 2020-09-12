<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable=['user_id','vehicle_id','drop_off_point','e_latitude','e_longitude','status'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function vehicles()
    {
        return $this->belongsTo(Vehicle::class);
    }
}
