<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */

    public function register()
    {
        $this->app->bind('role', function ($app) {
            return new \App\Models\Role; // Remplacez par votre modèle Role
        });
    }
    
    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }



}
