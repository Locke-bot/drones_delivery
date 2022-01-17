<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Drone;
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

Route::resource('posty', "App\Http\Controllers\DroneController");

Route::get('/tach', function(){
    return ["hello" => "Welcome Moses"];
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
