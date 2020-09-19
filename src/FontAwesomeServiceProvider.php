<?php

namespace Loopy\FontAwesome;

use Illuminate\Support\ServiceProvider;
use Loopy\FontAwesome\Services\FontAwesomeManager;

class FontAwesomeServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__ . '/Views', 'font_awesome');
        $this->publishes([__DIR__ . '/Config/font_awesome.php' => config_path('font_awesome.php')], 'config');
        $this->publishes([__DIR__ . '/Public' => public_path('vendor/loopy/font_awesome')], 'public');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('font_awesome_manager', function () {
            return new FontAwesomeManager;
        });
    }
}
