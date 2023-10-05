<?php

namespace ShipSaasLaravelJwks\Entities;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Str;
use RuntimeException;
use Stringable;
use Strobotti\JWK\KeyFactory;

class Key implements Arrayable, Stringable
{
    protected string $key;
    protected KeyConfiguration $options;

    /**
     * Key instance shouldn't be initialized globally
     */
    protected function __construct()
    {
    }

    /**
     * Create the JWKey instance from the raw contents (string)
     *
     * @param string $key
     * @param KeyConfiguration $options
     *
     * @return self
     */
    public static function fromRaw(string $key, KeyConfiguration $options): self
    {
        $keyInstance = new static();
        $keyInstance->key = $key;
        $keyInstance->options = $options;

        return $keyInstance;
    }

    /**
     * Create the JWKey instance from a filePath
     *
     * @param string $filePath
     * @param KeyConfiguration $options
     *
     * @return self
     */
    public static function fromFilePath(string $filePath, KeyConfiguration $options): self
    {
        if (!file_exists($filePath)) {
            throw new RuntimeException("The key from '$filePath' does not exists");
        }

        $keyInstance = new static();
        $keyInstance->key = file_get_contents($filePath);
        $keyInstance->options = $options;

        return $keyInstance;
    }

    public function toJWK()
    {
        return app(KeyFactory::class)
            ->createFromPem($this->key, array_filter([
                'alg' => $this->options->algorithm ?? config('jwks.default_algorithm'),
                'kid' => $this->options->keyId ?? Str::random(12),
                'use' => $this->options->use ?? null,
            ]))->jsonSerialize();
    }

    public function toArray(): array
    {
        return $this->toJWK();
    }

    public function __toString(): string
    {
        return json_encode($this->toJWK());
    }
}
