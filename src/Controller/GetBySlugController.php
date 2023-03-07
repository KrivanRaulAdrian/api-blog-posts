<?php

namespace Api\Controller;

use DI\Container;
use Laminas\Diactoros\Response\JsonResponse;
use OpenApi\Annotations as OA;
use Api\Repository\PostsRepository;
use Slim\Psr7\Request;
use Slim\Psr7\Response;

/**
 * @OA\Get(
 *     path="/v1/posts/getSlug/{slug}",
 *     description="Returns a post by given slug.",
 *     tags={"Posts"},
 *     @OA\Parameter(
 *         description="Slug of post to fetch",
 *         in="path",
 *         name="slug",
 *         required=true,
 *         @OA\Schema(
 *             type="string"
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Post response"
 *         )
 *     )
 * )
 */

class GetBySlugController
{
    private PostsRepository $postsRepository;

    public function __construct(Container $container)
    {
        $this->postsRepository = $container->get(PostsRepository::class);
    }
    public function __invoke(Request $request, Response $response, $args): JsonResponse
    {
        $posts = $this->postsRepository->getBySlug($args['slug']);

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
