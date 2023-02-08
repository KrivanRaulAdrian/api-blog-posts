<?php

namespace Api\Controller;

use DI\Container;
use Slim\Psr7\Request;
use Slim\Psr7\Response;
use Api\Repository\PostsRepository;
use Laminas\Diactoros\Response\JsonResponse;
use Ramsey\Uuid\Uuid;
use OpenApi\Annotations as OA;

/**
 * @OA\Get(
 *     path="/v1/posts/{post_id}",
 *     description="Returns a Post by ID.",
 *     tags={"Posts"},
 *     @OA\Parameter(
 *         description="ID of post to fetch",
 *         in="path",
 *         name="post_id",
 *         required=true,
 *         @OA\Schema(
 *             type="string"
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Post response",
 *         @OA\JsonContent(ref="#/components/schemas/PostResponseResult")
 *     )
 * )
 */
class GetByIdController
{
    private PostsRepository $postsRepository;

    public function __construct(Container $container)
    {
        $this->postsRepository = $container->get(PostsRepository::class);
    }
    public function __invoke(Request $request, Response $response, $args): JsonResponse
    {
        $post = $this->postsRepository->GetById(Uuid::fromString($args['post_id']));
        return new JsonResponse(PostResponse::postResponse($post));
    }
}
