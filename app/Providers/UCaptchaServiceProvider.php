<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use GuzzleHttp\Client;

class UCaptchaServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind('ucaptcha', function ($app) {
            return new Client([
                'base_uri' => 'https://ucaptcha.com/api/v1/',
                'timeout'  => 2.0,
            ]);
        });
    }

    public function boot()
    {
        //
    }
}