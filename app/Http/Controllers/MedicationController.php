<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Medication;
use App\Models\Drone;
use Illuminate\Validation\ValidationException;

class MedicationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //get all medications
        return Medication::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //register a new medication
        $med_weight = $request->all()["weight"];
        $drone = Drone::find($request->all()["drones_id"]);
        $weight_limit = $drone->weight_limit;
        $loaded_weight = $drone->loaded_weight();
        if (($loaded_weight+$med_weight) > $weight_limit){
            throw ValidationException::withMessages(['Loading Error' => 'Weight limit exceeded']);
        }
        return medication::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // get just one medication
        return Medication::find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    // public function check_weight($request,

    public function update(Request $request, $id)
    {
        // update a record
        $med = Medication::find($id);
        
        $prev_drone = $med->drones_id;
        $prev_weight = $med->weight;

        $updated_array = array_merge($med->toArray(), $request->all());
        $drone = Drone::find($updated_array["drones_id"]);
        $weight_limit = $drone->weight_limit;
        $loaded_weight = $drone->loaded_weight();

        if (($prev_drone != $drone->id) && (($loaded_weight+$updated_array["weight"]) > $weight_limit)){
            // the medication is to be assigned to another drone.
            //raise an Error
            throw ValidationException::withMessages(['Loading Error' => 'Weight limit exceeded']);
        }

        elseif (($prev_drone == $drone->id) && (($updated_array["weight"]-$prev_weight+$loaded_weight) > $weight_limit)){
            // check the difference between the weights before and after update (will be zero if weight wasn't changed)
            // if the difference is positive, it must be less than nthe drone's weight limit.
            throw ValidationException::withMessages(['Loading Error' => 'Weight limit exceeded']);
        }

        $med -> update($request->all());
        // return $updated_array;
        // return ["r"=>var_dump($med)];
        return $med;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // delete a medication record
        medication::destroy($id);
    }
}
