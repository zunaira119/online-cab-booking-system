<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class Driver extends Model
{
    use Notifiable,HasApiTokens;
    use Authenticatable;
    protected $fillable=[ 'name', 'email', 'password','phone','address','image','type','front_photo','back_photo'];

    public function vehicle()
    {
        return $this->hasOne(Vehicle::class);
    }
    public function rides()
    {
        return $this->hasMany(Ride::class);
    }

}
