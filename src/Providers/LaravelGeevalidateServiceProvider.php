<?php

namespace Cirlmcesc\LaravelGeevalidate\Providers;

use Illuminate\Support\ServiceProvider;
use Cirlmcesc\LaravelGeevalidate\Geesdk\GeetestLib;

class LaravelGeevalidateServiceProvider extends ServiceProvider
{
    /**
     * config file path
     */
    const CONFIG_PATH = __DIR__."/../../config/geevalidate.php";

    /**
     * route file path
     */
    const ROUTE_PATH = __DIR__."/../../routes/geevalidate.php";

    /**
     * Register services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->singleton(GeetestLib::class,
            function () {
                return new GeetestLib(config('geevalidate.id'), config('geevalidate.key'));
            });

        $this->mergeConfigFrom(self::CONFIG_PATH, "geevalidate");
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(): void
    {
        $this->publishes([self::CONFIG_PATH => config_path("geevalidate.php")], "geevalidate-config");

        $this->loadRoutesFrom(self::ROUTE_PATH);
    }
}
