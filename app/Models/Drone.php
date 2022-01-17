<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Drone extends Model
{
    use HasFactory;
    protected $fillable = [
        'serial_number',
        'model',
        'weight_limit',
        'battery_capacity',
        'state'
    ];
}
