<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrackingHis_m extends Model
{
    use HasFactory;

    protected $table = 't_track_his';

    function kendaraan() {
        return $this->belongsTo(Vehicle_m::class, 'vehicle_id');
    }

    function ban() {
        return $this->belongsTo(VehicleRoda_m::class, 'roda_id');
    }
}
