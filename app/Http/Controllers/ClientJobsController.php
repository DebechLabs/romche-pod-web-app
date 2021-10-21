<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\ClientJob;
use App\Models\Driver;
use App\Models\Fleet;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class ClientJobsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response|\Inertia\Response
     */
    public function index()
    {
//        dd(ClientJob::with("client", "driver")->get());
        return Inertia::render("Jobs")
            ->with("jobs", ClientJob::with("client", "driver")->get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response|\Inertia\Response
     */
    public function create()
    {
        return Inertia::render("Jobs/AddJob")
            ->with([
                "clients"   =>  Client::all(),
                "drivers"   =>  Driver::all(),
                "fleet"     =>  Fleet::all()
            ]);
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
            'driver_id'             =>  'required',
            'client_id'             =>  'required',
            'goods_description'     =>  'required',
            'pickup'                =>  'required',
            'destination'           =>  'required',
            'vehicle'               =>  'required'
        ]);

        $job = new ClientJob();

        $job->driver_id = $request->driver_id;
        $job->client_id = $request->client_id;
        $job->goods_description = $request->goods_description;
        $job->pickup = $request->pickup;
        $job->destination = $request->destination;
        $job->tracking_number = \str_random(10);
        $job->fleet_id = $request->fleet_id;

        $job->save();

        $job->tracking_number = "R" . str_pad($job->id, 8, '0', STR_PAD_LEFT);

        $job->save();

        return Redirect::route("jobs.index")
                ->with("flash", [
                    'type'      =>  'success',
                    'message'   =>  "Successfully added job"
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
        return Inertia::render("Jobs/EditJob")
            ->with([
                "clients"   =>  Client::all(),
                "drivers"   =>  Driver::all(),
                "fleet"     =>  Fleet::all(),
                "job"       =>  ClientJob::find($id)
            ]);
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
            'driver_id'             =>  'required',
            'client_id'             =>  'required',
            'goods_description'     =>  'required',
            'pickup'                =>  'required',
            'destination'           =>  'required',
            'fleet_id'              =>  'required'
        ]);

        $job = ClientJob::findOrFail($id);

        $job->driver_id = $request->driver_id;
        $job->client_id = $request->client_id;
        $job->goods_description = $request->goods_description;
        $job->pickup = $request->pickup;
        $job->destination = $request->destination;
        $job->status = $request->status;
        $job->fleet_id = $request->fleet_id;

        $job->save();

        return Redirect::back()
            ->with("flash", [
                'type'      =>  'success',
                'message'   =>  "Successfully updated job"
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
        $job = ClientJob::findOrFail($id);
        $job->delete();

        return Redirect::back()->with("flash", [
            "type"      =>  "success",
            "message"   =>  "Successfully deleted job"
        ]);
    }
}
