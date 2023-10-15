<?php

namespace ShipSaasLaravelJwks\Entities;

class KeyConfiguration
{
    public function __construct(
        public ?string $keyId = null,
        public ?string $algorithm = null,
        public ?string $use = null
    ) {
    }
}
