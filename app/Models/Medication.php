<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use App\Models;

class Medication extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'weight',
        'code',
        'drones_id',
    ];

    public function drone(){
        // return $this->belongsTo(BatteryLevelLog::class);
        return $this->belongsTo(Drone::class, 'id');
    }
}