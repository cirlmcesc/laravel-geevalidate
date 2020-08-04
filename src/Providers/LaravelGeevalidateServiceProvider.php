<?php

namespace Cirlmcesc\LaravelGeevalidate\Providers;

use Illuminate\Support\ServiceProvider;
use Cirlmcesc\LaravelGeevalidate\Geesdk\GeetestLib;

class LaravelGeevalidateServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var boolean
     */
    protected $defer = false;

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
        $this->mergeConfigFrom(self::CONFIG_PATH, 'geevalidate');

        $this->app->singleton(GeetestLib::class,
            function () {
                return new GeetestLib(config('geevalidate.id'), config('geevalidate.key'));
            });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->commands([\Cirlmcesc\LaravelGeevalidate\Commands\InstallCommand::class]);
        }

        $this->publishes([self::CONFIG_PATH => config_path("geevalidate.php")], "geevalidate-config");

        $this->loadRoutesFrom(self::ROUTE_PATH);
    }
}
