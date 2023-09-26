<?php

/**
 * ShipSaaS - Laravel JWKS
 *
 * This configuration allows you to configure the default exposed route
 *
 * whether you need to use it or not, or which would be the default key(s) that you
 * wanted to expose for your (micro)services.
 */

return [
    /**
     * Mark this to false if you don't want use
     * our exposed JWKS endpoint /auth/jwks
     */
    'use_default_jwks_route' => true,

    /**
     * The JWT Algorithm of your current application
     *
     * Note: we only support RSA for now
     */
    'algorithm' => env('JWT_ALGORITHM', 'RS256'),

    /**
     * The paths of public keys used to generate & sign the JWT token
     *
     * Note: use the real file path, e.g.: /home/server/api/key.pub
     */
    'default_keys_path' => [
        // storage_path('oauth_token.pub'),
        // /home/server/keys/oauth_token.pub,
    ],
];
