<?php

namespace App\Base\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $app = $this->app;
        $app->group(['namespace' => 'App\Http\Controllers'], function ($app) {
            $app->get('/', function () use ($app) {
                return $app->version();
            });
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
