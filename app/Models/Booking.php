<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $guarded = [];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function approverLevel1()
    {
        return $this->belongsTo(User::class, 'approver_level1_id');
    }

    public function approverLevel2()
    {
        return $this->belongsTo(User::class, 'approver_level2_id');
    }

    public function driver()
    {
        return $this->belongsTo(User::class, 'driver_id');

    }

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class, 'vehicle_id');
    }
}
