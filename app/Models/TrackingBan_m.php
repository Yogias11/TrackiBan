<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrackingBan_m extends Model
{
    use HasFactory;

    protected $table = 't_track';

    function kendaraan() {
        return $this->belongsTo(Vehicle_m::class, 'vehicle_id');
    }

    function posisi1() {
        return $this->belongsTo(Vehicle_m::class, 'posisi');
    }

    function ban() {
        return $this->belongsTo(VehicleRoda_m::class, 'roda_id');
    }
}
