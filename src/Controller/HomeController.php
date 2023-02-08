<?php

namespace Api\Controller;

use Slim\Psr7\Request;
use Slim\Psr7\Response;
use Laminas\Diactoros\Response\JsonResponse;

class HomeController
{
    public function __invoke(Request $request, Response $response, $args): JsonResponse
    {
        $data = ['app' => 'api-project', 'version' => '1.0'];
        return new JsonResponse($data);
    }
}
