<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $table = 'services';

    protected $fillable = [
        'service_date',
        'service_type',
        'service_details',
        'service_duration',
        'service_technician',
        'full_cost',
        'invoice_number',
        'vehicles_id',
    ];

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class, 'vehicles_id');
    }
}
