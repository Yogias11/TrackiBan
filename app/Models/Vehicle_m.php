<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle_m extends Model
{
    use HasFactory;

    protected $table = 'm_vehicle';

    function jenis() {
        return $this->belongsTo(VehicleCategory_m::class);
    }

    function ban() {
        return $this->morphMany(VehicleRoda_m::class, 'vehicle_id');
    }
}
