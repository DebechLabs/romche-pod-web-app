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
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/drivers', function () {
    return Inertia::render('Drivers');
})->middleware(['auth', 'verified'])->name('drivers');

Route::get('/clients', function () {
    return Inertia::render('Clients');
})->middleware(['auth', 'verified'])->name('clients');

Route::get('/jobs', function () {
    return Inertia::render('Jobs');
})->middleware(['auth', 'verified'])->name('jobs');

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