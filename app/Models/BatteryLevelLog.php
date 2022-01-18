<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BatteryLevelLog extends Model
{
    use HasFactory;
    protected $fillable = [
                'serial_number',
                'state',
                'battery_level',
                'drones_id'
    ];
}
