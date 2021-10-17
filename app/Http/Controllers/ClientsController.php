<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class ClientsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response|\Inertia\Response
     */
    public function index()
    {
        return Inertia::render('Clients')->with('clients', Client::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response|\Inertia\Response
     */
    public function create()
    {
        return Inertia::render('Clients/AddClient');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $path = null;
        if($request->hasFile('logo')){
            $path = $request->logo->store("clients/logos", "public");
        }

        $client = new Client();

        $client->client_name = $request->client_name;
        $client->address = $request->address;
        $client->short_name = $request->short_name;
        $client->kra_pin = $request->kra_pin;
        $client->goods_description = $request->goods_description;
        $client->contact_person = ($request->contact_persons) ?  json_encode($request->contact_persons) : json_encode([]);
        $client->logo = $path;

        $client->save();

        return Redirect::route('clients')->with('flash', [
            'type'     =>   'success',
            'message'  =>   'Client added to database'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response|\Inertia\Response
     */
    public function show($id)
    {
        return Inertia::render('Clients/EditClient')->with([
            'client'  =>  Client::find($id)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response|\Inertia\Response
     */
    public function edit($id)
    {
        return Inertia::render('Clients/EditClient')->with([
            'client'  =>  Client::find($id)
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
        $request->validate([
            "client_name"   =>  "required",
            "address"       =>  "required"
        ]);
        $client = Client::find($id);
        $path = $client->logo;

        if($request->hasFile('logo')){
            $path = $request->logo->store("clients/logos", "public");
        }

        $client->client_name = $request->input('client_name');
        $client->address = $request->address;
        $client->short_name = $request->short_name;
        $client->kra_pin = $request->kra_pin;
        $client->goods_description = $request->goods_description;
        $client->contact_person = ($request->contact_persons) ?  json_encode($request->contact_persons) : json_encode([]);
        $client->logo = $path;

        $client->save();

        return Redirect::route('clients.edit', $id)->with("flash", [
            'type'      =>  'success',
            'message'   =>  "Successfully updated client details"
        ])->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $client = Client::findOrFail($id);
        $client->delete();

        return Redirect::route("clients")->with("flash", [
            "type"      =>  "success",
            "message"   =>  "Successfully deleted client"
        ]);

    }
}
