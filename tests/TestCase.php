<?php

namespace ShipSaasLaravelJwks\Tests;

use Illuminate\Foundation\Testing\WithFaker;
use Orchestra\Testbench\TestCase as BaseTestCase;
use ShipSaasLaravelJwks\ShipSaasLaravelJwksServiceProvider;

abstract class TestCase extends BaseTestCase
{
    use WithFaker;

    protected function setUp(): void
    {
        parent::setUp();
    }

    protected function getPackageProviders($app): array
    {
        return [
            ShipSaasLaravelJwksServiceProvider::class,
        ];
    }
}
