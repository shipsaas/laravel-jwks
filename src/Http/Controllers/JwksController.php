<?php

namespace ShipSaasLaravelJwks\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use ShipSaasLaravelJwks\Entities\Key;
use ShipSaasLaravelJwks\Entities\KeyConfiguration;
use ShipSaasLaravelJwks\Entities\KeySet;

class JwksController extends Controller
{
    public function index(): JsonResponse
    {
        $keySet = new KeySet();
        collect(config('jwks.default_keys_path'))
            ->each(function (string $filePath) use ($keySet) {
                $key = Key::fromFilePath($filePath, new KeyConfiguration());

                $keySet->add($key);
            });

        return new JsonResponse($keySet->toArray());
    }
}
