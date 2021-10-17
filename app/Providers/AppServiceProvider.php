<?php

namespace App\Providers;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\ServiceProvider;
use Inertia\Inertia;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Inertia::share('flash', function(){
            return Session::get("flash");
        });

        Inertia::share('popstate', function() { return false; });
        Inertia::share('fleet_types', function () {
            return [
                ['id' => 'lorry', 'name' => 'Lorry'],
                ['id' => 'car', 'name'  =>  'Car'],
                ['id' => 'pick-up', 'name'  =>  'Pick Up'],
            ];
        });
    }
}
