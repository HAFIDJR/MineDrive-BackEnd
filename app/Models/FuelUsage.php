<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FuelUsage extends Model
{
    protected $guarded = [];
    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class, 'vehicle_id');
    }
}
