<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Service\CarService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(CarService::class, function ($app) {
            return new CarService($app->make('App\Models\Cars'));
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
