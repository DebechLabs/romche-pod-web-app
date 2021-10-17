<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('home');

Route::get('/dashboard', function () {
//    \Illuminate\Support\Facades\Session::flash("message", "We are in the dashboard");
    return Inertia::render('Dashboard')->with("message", "We are in the dashboard");
})->middleware(['auth', 'verified'])->name('dashboard');

Route::resource('drivers', "App\Http\Controllers\DriversController")->middleware(['auth', 'verified']);

Route::group(["prefix"  =>  "clients", "middleware" => ['auth', 'verified']], function (){
    Route::get('/', "App\Http\Controllers\ClientsController@index")->name('clients');
    Route::post('/', "App\Http\Controllers\ClientsController@store")->name('clients.store');
    Route::get('/add', "App\Http\Controllers\ClientsController@create")->name('clients.add');
    Route::get("/{id}/edit", "App\Http\Controllers\ClientsController@edit")->name('clients.edit');
    Route::post("/{id}", [\App\Http\Controllers\ClientsController::class, "update"])->name("clients.update");
    Route::delete("/{id}", [\App\Http\Controllers\ClientsController::class, "destroy"])->name("clients.destroy");
});

Route::resource("jobs", \App\Http\Controllers\ClientJobsController::class)->middleware(['auth', 'verified']);
Route::resource("fleet", \App\Http\Controllers\FleetController::class)->middleware(['auth', 'verified']);

Route::get('/invoicing', function () {
    return Inertia::render('Invoicing');
})->middleware(['auth', 'verified'])->name('invoicing');

Route::get('/reports', function () {
    return Inertia::render('Reports');
})->middleware(['auth', 'verified'])->name('reports');

Route::get('/users', function () {
    return Inertia::render('Users');
})->middleware(['auth', 'verified'])->name('users');

require __DIR__.'/auth.php';
