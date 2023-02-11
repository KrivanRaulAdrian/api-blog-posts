<?php

namespace Api\Controller;

use DI\Container;
use Ramsey\Uuid\Uuid;
use Slim\Psr7\Request;
use Slim\Psr7\Response;
use Api\Entity\PostsCategories;
use Laminas\Diactoros\Response\JsonResponse;
use Api\Repository\PostsCategoriesRepository;

/**
 * @OA\Post(
 *     path="/v1/posts_categories/create",
 *     description="Add a new post category",
 *     tags={"Posts Categories"},
 *     @OA\RequestBody(
 *         description="Post category to be created",
 *         required=true,
 *         @OA\MediaType(
 *              mediaType="application/json",
 *              @OA\Schema(
 *                  @OA\Property(property="id_post", type="string", example="f708710b-76ef-42c8-ae91-90c65d126ff1"),
 *                  @OA\Property(property="id_category", type="string", example="de801042-d8aa-41a8-84cd-86400b7506a4"),
 *                  
 *      )
 *    )
 * ),
 * @OA\Response(
 *     response="200",
 *     description="The ID of the post category",
 *       @OA\MediaType(
 *           mediaType="application/json",
 *           @OA\Schema(ref="#/components/schemas/CreatePostsCategoriesResult"),
 *       )
 *     )
 *   )
 * )
 */

class CreatePostsCategoriesController
{
    private PostsCategoriesRepository $postsCategoriesRepository;

    public function __construct(Container $container)
    {
        $this->postsCategoriesRepository = $container->get(PostsCategoriesRepository::class);
    }
    public function __invoke(Request $request, Response $response, $args): JsonResponse
    {
        $data = json_decode($request->getBody()->getContents(), true);

        $postsCategories = new PostsCategories(
            Uuid::fromString($data['id_post']),
            Uuid::fromString($data['id_category']),
        );

        $this->postsCategoriesRepository->createPostsCategories($postsCategories);

        $output = [
            'status' => 'success',
        ];

        return new JsonResponse($output, 200);
    }
}
