<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    protected $guarded = [];
    public function booking()
    {
        return $this->hasMany(Booking::class);
    }

    public function full_usage()
    {
        return $this->hasMany(FuelUsage::class);
    }

    public function service()
    {
        return $this->hasMany(Service::class);
    }
}
