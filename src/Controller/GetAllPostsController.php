<?php

namespace Api\Controller;

use DI\Container;
use PHPUnit\Util\Json;
use Slim\Psr7\Request;
use Slim\Psr7\Response;
use Api\Entity\Categories;
use OpenApi\Annotations as OA;
use Api\Repository\PostsRepository;
use Laminas\Diactoros\Response\JsonResponse;

/**
 * @OA\Get(
 *     path="/v1/posts/all",
 *     description="Returns all posts.",
 *     tags={"Posts"},
 *     @OA\Response(
 *         response=200,
 *         description="Post response",
 *     )
 * )
 */

class GetAllPostsController
{
    private PostsRepository $postsRepository;

    public function __construct(Container $container)
    {
        $this->postsRepository = $container->get(PostsRepository::class);
    }
    public function __invoke(Request $request, Response $response, $args): JsonResponse
    {
        $posts = $this->postsRepository->getAllPosts();

        return $this->toJson($posts);
    }
    private function toJson(array $posts): JsonResponse
    {
        $postsCategories = [];
        foreach ($posts as $post) {
            $postsCategories[] = $post->toArray();
        }
        return new JsonResponse($postsCategories);
    }
}
