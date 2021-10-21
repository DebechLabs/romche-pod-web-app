<?php

namespace App\Http\Controllers;

use App\Models\Fleet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class FleetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response|\Inertia\Response
     */
    public function index()
    {
        return Inertia::render("Fleet")
            ->with("fleet", Fleet::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response|\Inertia\Response
     */
    public function create()
    {
        return Inertia::render("Fleet/AddFleet");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'vehicle_type'      =>  "required",
            "registration_no"   =>  "required",
            "color"             =>  "required",
            "chassis_no"        =>  "required",
            "engine_no"         =>  "required",
            "logbook_no"        =>  "required"
        ]);

        $fleet = new Fleet();

        $fleet->registration_no = $request->registration_no;
        $fleet->vehicle_type = $request->vehicle_type;
        $fleet->color = $request->color;
        $fleet->chassis_no = $request->chassis_no;
        $fleet->engine_no = $request->engine_no;
        $fleet->logbook_no = $request->logbook_no;

        $fleet->save();

        return Redirect::route("fleet.index")
            ->with("flash", [
                'type'      =>  'success',
                'message'   =>  "Successfully added vehicle"
            ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
