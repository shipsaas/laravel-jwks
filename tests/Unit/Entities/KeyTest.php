<?php

namespace ShipSaasLaravelJwks\Tests\Unit\Entities;

use RuntimeException;
use ShipSaasLaravelJwks\Entities\Key;
use ShipSaasLaravelJwks\Entities\KeyConfiguration;
use ShipSaasLaravelJwks\Tests\TestCase;

class KeyTest extends TestCase
{
    public function testMakeNewInstanceFromRaw()
    {
        $keyContent = file_get_contents(__DIR__ . '/../../__fixtures__/public-key.pub');
        $key = Key::fromRaw($keyContent, new KeyConfiguration());

        $this->assertInstanceOf(Key::class, $key);
    }

    public function testMakeNewInstanceFromFilePath()
    {
        $key = Key::fromFilePath(__DIR__ . '/../../__fixtures__/public-key.pub', new KeyConfiguration());

        $this->assertInstanceOf(Key::class, $key);
    }

    public function testMakeNewInstanceFromFilePathThrowsExceptionDueToFileNotFound()
    {
        $this->expectException(RuntimeException::class);
        $key = Key::fromFilePath('public-key.pub', new KeyConfiguration());
    }

    public function testParsesToArrayAndString()
    {
        $key = Key::fromFilePath(__DIR__ . '/../../__fixtures__/public-key.pub', new KeyConfiguration());

        $array = $key->toArray();
        $json = (string) $key;

        $this->assertNotEmpty($array);
        $this->assertNotEmpty($json);

        $this->assertSame($array['alg'], 'RS256');
        $this->assertSame($array['kty'], 'RSA');
    }
}
