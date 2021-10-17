<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class DriversController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response|\Inertia\Response
     */
    public function index()
    {
        return Inertia::render('Drivers')->with('drivers', Driver::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response|\Inertia\Response
     */
    public function create()
    {
        return Inertia::render("Drivers/AddDriver");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'last_name' =>  'required',
            'other_names' =>  'required',
            'phone_number' =>  'required',
            'kra_pin' =>  'required',
            'date_of_birth' =>  'required',
        ]);

        $driver = new Driver();

        $driver->last_name = $request->input('last_name');
        $driver->other_names = $request->input('other_names');
        $driver->email_address = $request->input('email_address');
        $driver->phone_number = $request->input('phone_number');
        $driver->date_of_birth = $request->input('date_of_birth');
        $driver->license_no = $request->input('license_no');
        $driver->kra_pin = $request->input('kra_pin');

        $driver->save();

        return Redirect::route('drivers.index')->with("flash", [
            "type"  =>  "success",
            "message"   =>  "Successfully added driver to database"
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
     * @return \Illuminate\Http\Response|\Inertia\Response
     */
    public function edit($id)
    {
        return Inertia::render("Drivers/EditDriver")->with("driver", Driver::findOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'last_name' =>  'required',
            'other_names' =>  'required',
            'phone_number' =>  'required',
            'kra_pin' =>  'required',
            'date_of_birth' =>  'required',
        ]);

        $driver =Driver::findOrFail($id);

        $driver->last_name = $request->input('last_name');
        $driver->other_names = $request->input('other_names');
        $driver->email_address = $request->input('email_address');
        $driver->phone_number = $request->input('phone_number');
        $driver->date_of_birth = $request->input('date_of_birth');
        $driver->license_no = $request->input('license_no');
        $driver->kra_pin = $request->input('kra_pin');

        $driver->save();

        return Redirect::back()->with("flash", [
            "type"  =>  "success",
            "message"   =>  "Successfully updated driver details"
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $driver = Driver::findOrFail($id);

        $driver->delete();

        return Redirect::route("drivers.index")->with("flash", [
            "type"      =>  "success",
            "message"   =>  "Successfully deleted client"
        ]);
    }
}
