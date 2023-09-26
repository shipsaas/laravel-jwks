<?php

use Illuminate\Support\Facades\Route;
use ShipSaasLaravelJwks\Routes\JwksController;

if (config('jwks.use_default_jwks_route')) {
    Route::get('auth/jwks', [JwksController::class, 'index']);
}
