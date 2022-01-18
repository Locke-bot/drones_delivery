<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Drone;
class DroneController extends Controller
{
    public $model_choices = "Lightweight,Middleweight,Cruiserweight,Heavyweight";
    public $state_choices =  "IDLE,LOADING,DELIVERED,RETURNING";
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //get all drones
        return Drone::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //register a new drone
        $this->validate($request, [
            'weight_limit' => 'integer|max:500',
            'model' => 'in:'.$this->model_choices,
            'state' => 'in:'.$this->state_choices,
            'battery_capacity' => 'integer|between:0,100',
        ]);
        return Drone::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // get just one drone
        return Drone::find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // update a record
        // validating if the weight_limit is under or equal to 500
        $this->validate($request, [
            'weight_limit' => 'integer|max:500',
            'model' => 'in:'.$this->model_choices,
            'state' => 'in:'.$this->state_choices,
            'battery_capacity' => 'integer|between:0,100',
        ]);
        $drone = Drone::find($id);
        $drone -> update($request->all());
        return $request;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // delete a drone record
        Drone::destroy($id);
    }
}
