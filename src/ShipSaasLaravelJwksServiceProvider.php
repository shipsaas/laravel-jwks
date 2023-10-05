<?php

namespace ShipSaasLaravelJwks;

use Illuminate\Foundation\Console\AboutCommand;
use Illuminate\Support\ServiceProvider;
use Strobotti\JWK\KeyConverter;
use Strobotti\JWK\KeyFactory;

class ShipSaasLaravelJwksServiceProvider extends ServiceProvider
{
    const VERSION = 'v1.0.0';

    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            AboutCommand::add(
                'ShipSaaS: Laravel JSON Web Key Sets',
                fn () => ['Version' => static::VERSION]
            );
        }

        $this->mergeConfigFrom(
            __DIR__ . '/Configs/jwks.php',
            'jwks'
        );

        $this->publishes([
            __DIR__ . '/Configs/jwks.php' => config_path('jwks.php'),
        ], 'laravel-jwks');

        $this->loadRoutesFrom(__DIR__ . '/Routes/jwks_routes.php');
    }

    public function register(): void
    {
        $this->app->singleton(KeyFactory::class);
        $this->app->singleton(KeyConverter::class);
    }
}
