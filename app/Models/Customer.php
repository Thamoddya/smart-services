<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $table = 'customers';

    protected $fillable = [
        'service_center_id',
        'name',
        'email',
        'phone',
        'address',
        'nic'
    ];

    public function serviceCenter()
    {
        return $this->belongsTo(ServiceCenter::class, 'service_center_id');
    }
}
