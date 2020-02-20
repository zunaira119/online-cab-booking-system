<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    protected $fillable=[
        'make','model','number','color','no_of_seats','available_seats','reserved_seats'
    ];
    public function route()
    {
        return $this->belongsTo(Route::class);
    }
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
