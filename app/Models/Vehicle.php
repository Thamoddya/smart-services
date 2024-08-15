<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;

    protected $table = 'vehicles';

    protected $fillable = [
        'type_id',
        'vehicle_number',
        'last_service_date',
        'total_servies_count',
        'next_service_date',
        'vehicle_photo',
        'vehicle_video',
        'service_center_id',
        'customer_id'
    ];

    public function type()
    {
        return $this->belongsTo(VehicleType::class, 'type_id');
    }
    public function vehicles()
    {
        return $this->hasMany(Vehicle::class, 'service_center_id');
    }

    // Accessor to get the total vehicle count
    public function getTotalVehicleCountAttribute()
    {
        return $this->vehicles()->count();
    }
}
