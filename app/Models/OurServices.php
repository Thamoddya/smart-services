<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OurServices extends Model
{
    use HasFactory;

    protected $table = 'our_services';

    protected $fillable = [
        'service_centers_id',
        'service_name',
    ];
}
