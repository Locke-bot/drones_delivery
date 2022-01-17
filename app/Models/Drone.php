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

    public function loaded_weight(){
        // summing up all weights assigned to this drone instance.
        return Medication::where('drones_id', $this->id)->sum('weight');
    }

}
