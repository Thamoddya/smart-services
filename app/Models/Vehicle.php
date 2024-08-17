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
        'last_service_km',
        'total_servies_count',
        'next_service_date',
        'vehicle_photo',
        'vehicle_video',
        'service_center_id',
        'customer_id',
        'vehicle_id',
        'chassis_number',
        'next_service_km',
        'model_name',
    ];

    public function type()
    {
        return $this->belongsTo(VehicleType::class, 'type_id');
    }
    // Accessor to get the total vehicle count
    public function getTotalVehicleCountAttribute()
    {
        return $this->vehicles()->count();
    }

    public function serviceCenter()
    {
        return $this->belongsTo(ServiceCenter::class, 'service_center_id');
    }
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }
    public function services()
    {
        return $this->hasMany(Service::class, 'vehicles_id');
    }
}
