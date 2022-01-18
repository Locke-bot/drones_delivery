<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Drone;
use App\Models\Medication;
use App\Models\BatteryLevelLog;
use App\Http\Controllers\DroneController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/drone_details/{id}', function($id){  // take care of the expected error
    return ["drone" => Drone::find($id),
            "medication-items" => Medication::where('drones_id', $id)->get()
        ];
});

Route::get('/drone_battery/{id}', function($id){
    return ["battery_level" => Drone::find($id)->battery_capacity];
});

Route::get('/get_available_drones', function(){ 
    // available drones must be have at least 25% of battery capacity *and* the state must be LOADING.
    return Drone::where("state", "LOADING")
                  ->where("battery_capacity", ">=", 25)
                  ->count();
});

Route::get('/check_drones_battery', function(){
    $drones = Drone::get();
    foreach ($drones as $drone){
        $arg = ["drones_id"=>$drone->id,
                "serial_number"=>$drone->serial_number,
                "battery_level"=>$drone->battery_capacity,
                "state"=>$drone->state
        ];
        $log = BatteryLevelLog::create($arg);
    };
    return ["success"=>"battery levels recorded."];
});

Route::resource('drone', "App\Http\Controllers\DroneController");
Route::resource('medication', "App\Http\Controllers\MedicationController");


// Route::get('/tach', function(){
//     return ["hello" => "Welcome Moses"];
// });

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
