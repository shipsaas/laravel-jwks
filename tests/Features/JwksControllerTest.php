<?php

namespace ShipSaasLaravelJwks\Tests\Features;

use ShipSaasLaravelJwks\Tests\TestCase;

class JwksControllerTest extends TestCase
{
    public function testIndexReturnsTheDefaultJwks()
    {
        config([
            'jwks.default_keys_path' => [
                __DIR__ . '/../__fixtures__/public-key.pub'
            ],
        ]);

        $this->json('GET', '/auth/jwks')
            ->assertOk()
            ->assertJsonIsArray()
            ->assertJsonFragment([
                'kty' => 'RSA',
                'alg' => 'RS256',
            ]);
    }

    public function testIndexReturnsEmptyOnNoKey()
    {
        config([
            'jwks.default_keys_path' => [],
        ]);

        $this->json('GET', '/auth/jwks')
            ->assertOk()
            ->assertJsonIsArray()
            ->assertJsonCount(0);
    }
}
