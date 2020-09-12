<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserBookingHistory extends Model
{
    protected $fillable=['user_id','vehicle_id','drop_off_point','e_latitude','e_longitude','status'];
}
