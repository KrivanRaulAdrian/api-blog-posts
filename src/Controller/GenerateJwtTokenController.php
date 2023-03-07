<?php

namespace Api\Controller;

use DI\Container;
use Firebase\JWT\JWT;
use Slim\Psr7\Request;
use Slim\Psr7\Response;
use Laminas\Diactoros\Response\JsonResponse;

class GenerateJwtTokenController
{
    private string $secret;

    public function __construct(Container $container)
    {
        $this->secret = $container->get('settings')['jwt_secret'];
    }
    public function __invoke(Request $request, Response $response, $args): JsonResponse
    {
        json_decode($request->getBody()->getContents(), true);

        $payload = [
            'sub' => '1234567890',
            'name' => 'Raul Krivan',
            'iat' => 1356999524,
            'nbf' => 1357000000
        ];

        $jwt = JWT::encode($payload, $this->secret);

        return new JsonResponse(['token' => $jwt], 201);
    }
}
