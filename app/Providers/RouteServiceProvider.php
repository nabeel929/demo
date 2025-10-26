<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->routes(function () {
            // API ROUTES LOAD KARO
            Route::middleware('api')
                 ->prefix('api')
                 ->group(base_path('routes/api.php'));

            // WEB ROUTES
            Route::middleware('web')
                 ->group(base_path('routes/web.php'));
        });
    }
}