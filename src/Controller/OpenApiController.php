<?php

namespace Api\Controller;

use OpenApi\Generator;
use Slim\Psr7\Request;
use Slim\Psr7\Response;
use Laminas\Diactoros\Response\JsonResponse;
use OpenApi\Annotations as OA;

/**
 * @OA\Info(title="API Project", version="1.0")
 */

class OpenApiController
{
    public function __invoke(Request $request, Response $response, $args): JsonResponse
    {
        $openapi = Generator::scan([__DIR__ . '/../../src']);

        return new JsonResponse(json_decode($openapi->toJson()));
    }
}
