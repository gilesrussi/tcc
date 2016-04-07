<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Auth;
use Symfony\Component\Debug\Exception\FatalErrorException;

class NavBarServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('layouts/topbar', function($view) {
            $view->with('friendRequests', Auth::user()->friends()->wherePivot('accepted', 0));

        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
