<?php

namespace Api\Controller;

use Api\Entity\PostsCategories;
use Api\Repository\PostsCategoriesRepository;
use DI\Container;
use Slim\Psr7\Request;
use Slim\Psr7\Response;
use Api\Repository\PostsRepository;
use Laminas\Diactoros\Response\JsonResponse;
use Ramsey\Uuid\Uuid;
use OpenApi\Annotations as OA;

/**
 * @OA\Get(
 *     path="/v1/posts_categories/{id_post}",
 *     description="Returns a Category by the ID of Post.",
 *     tags={"Posts Categories"},
 *     @OA\Parameter(
 *         description="ID of post to fetch",
 *         in="path",
 *         name="id_post",
 *         required=true,
 *         @OA\Schema(
 *             type="string"
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Post response",
 *         @OA\JsonContent(ref="#/components/schemas/PostsCategoriesResponseResult")
 *     )
 * )
 */
class GetByIdJoinController
{
    private PostsCategoriesRepository $postsCategoriesRepository;

    public function __construct(Container $container)
    {
        $this->postsCategoriesRepository = $container->get(PostsCategoriesRepository::class);
    }
    public function __invoke(Request $request, Response $response, $args): JsonResponse
    {
        $postsCategories = $this->postsCategoriesRepository->getByIdJoin(Uuid::fromString($args['id_post']));
        return new JsonResponse($postsCategories);
    }
}
