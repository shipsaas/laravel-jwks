<?php

namespace ShipSaasLaravelJwks\Entities;

use Illuminate\Contracts\Support\Arrayable;
use Stringable;

class KeySet implements Arrayable, Stringable
{
    /**
     * @var array<Key> $keys
     */
    protected array $keys = [];

    public function add(Key $key): self
    {
        $this->keys[] = $key;

        return $this;
    }

    public function toArray(): array
    {
        return array_map(fn (Key $key) => $key->toJWK(), $this->keys);
    }

    public function __toString(): string
    {
        return json_encode($this->toArray());
    }
}
