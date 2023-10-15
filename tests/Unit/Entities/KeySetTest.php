<?php

namespace ShipSaasLaravelJwks\Tests\Unit\Entities;

use ShipSaasLaravelJwks\Entities\Key;
use ShipSaasLaravelJwks\Entities\KeyConfiguration;
use ShipSaasLaravelJwks\Entities\KeySet;
use ShipSaasLaravelJwks\Tests\TestCase;

class KeySetTest extends TestCase
{
    public function testKetSetCanAddAndParseToArray()
    {
        $keyset = new KeySet();

        $keyContent = file_get_contents(__DIR__ . '/../../__fixtures__/public-key.pub');
        $key = Key::fromRaw($keyContent, new KeyConfiguration());

        $keyset->add($key);

        $array = $keyset->toArray();

        $this->assertNotEmpty($array);

        $this->assertSame($array[0]['alg'], 'RS256');
        $this->assertSame($array[0]['kty'], 'RSA');
    }

    public function testKetSetCanAddAndParseToString()
    {
        $keyset = new KeySet();

        $keyContent = file_get_contents(__DIR__ . '/../../__fixtures__/public-key.pub');
        $key = Key::fromRaw($keyContent, new KeyConfiguration());

        $keyset->add($key);

        $string = $keyset->__toString();

        $this->assertNotEmpty($string);

        $this->assertStringContainsString('RS256', $string);
        $this->assertStringContainsString('RSA', $string);
    }
}
