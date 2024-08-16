<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceCenter extends Model
{
    use HasFactory;

    protected $table = 'service_center';

    protected $fillable = [
        'name',
        'address',
        'mobile',
        'email',
        'total_access_vehicles',
        'users_id',
        'logo_path'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }

    public function vehicles()
    {
        return $this->hasMany(Vehicle::class, 'service_center_id');
    }

    public function customers()
    {
        return $this->hasMany(Customer::class, 'service_center_id');
    }
}
