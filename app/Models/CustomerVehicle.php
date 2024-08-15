<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerVehicle extends Model
{
    use HasFactory;

    protected $table = 'customers_has_vehicles';

    public $timestamps = false;

    protected $fillable = [
        'customers_id',
        'vehicles_id',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customers_id');
    }

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class, 'vehicles_id');
    }
}
