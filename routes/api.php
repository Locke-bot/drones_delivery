<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Drone;
use App\Models\Medication;
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

// Route::get('/posty', function(){
//     $posty = Drone::create([
//         'serial_number'=>"007",
//         'weight_limit'=>10,
//         'battery_capacity'=>50,
//         'state'=>"IDLE",
//     ]);
//     return $posty;
// });
// Route::resource('medication', "");
// public function update(Request $request, $id)
//     {
//         // update a record
//         $med = Medication::find($id);
//         $med -> update($request->all());
//         return $med;
//     }

// Route::get('/medic', function(){
//     // $medic_getty = Medication::create([
//     //     'name'=>'balm drop',
//     //     'weight'=>10,
//     //     'code'=>'health_related',
//     //     'drones_id'=>1,
//     // ]);
//     // $medic_getty = Medication::where('drones_id', 1)::where('serial_number', '007')->get();
//     $medic_getty = Medication::where('drones_id', 1)->first()->drone()->get();
//     return $medic_getty;
// });

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

Route::resource('drone', "App\Http\Controllers\DroneController");
Route::resource('medication', "App\Http\Controllers\MedicationController");


// Route::get('/tach', function(){
//     return ["hello" => "Welcome Moses"];
// });

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
