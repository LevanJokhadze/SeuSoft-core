<?php

namespace App\Providers;

use App\Services\AdminServices;
use App\Services\UpdateContactServices;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(AdminServices::class, function ($app) {
            return new AdminServices();
        });
        $this->app->singleton(UpdateContactServices::class, function ($app) {
            return new UpdateContactServices();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
