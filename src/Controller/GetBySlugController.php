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
 *         description="Post response",
 *         @OA\JsonContent(ref="#/components/schemas/PostResponseResult")
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
        $response = [];
        foreach ($posts as $post) {
            $response[] = [
                'post_id' => $post->post_id()->toString(),
                'title' => $post->title(),
                'slug' => $post->slug(),
                'content' => $post->content(),
                'thumbnail' => $post->thumbnail(),
                'author' => $post->author(),
                'posted_at' => $post->posted_at()->format('Y-m-d H:i:s'),
            ];
        }

        return new JsonResponse($response);
    }
}
