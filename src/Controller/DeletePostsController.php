<?php

namespace Api\Controller;

use DI\Container;
use Ramsey\Uuid\Uuid;
use Slim\Psr7\Request;
use Slim\Psr7\Response;
use OpenApi\Annotations as OA;
use Api\Repository\PostsRepository;
use Laminas\Diactoros\Response\JsonResponse;

/**
 * @OA\Delete(
 *     security={{"bearerAuth": {}}},
 *     path="/v1/posts/{id}",
 *     description="Delete a post by ID.",
 *     tags={"Posts"},
 *     @OA\Parameter(
 *         description="ID of post to delete",
 *         in="path",
 *         name="id",
 *         required=true,
 *         @OA\Schema(
 *             type="string",
 *         )
 *     ),
 *     @OA\Response(
 *         response="200",
 *         description="The message after deleting the post",
 *          @OA\MediaType(
 *           mediaType="application/json",
 *           @OA\Schema(ref="#/components/schemas/DeleteResponseResult"),
 *         )
 *     )
 * )
 */

class DeletePostsController
{
    private PostsRepository $postsRepository;

    public function __construct(Container $container)
    {
        $this->postsRepository = $container->get(PostsRepository::class);
    }
    public function __invoke(Request $request, Response $response, $args): JsonResponse
    {
        $this->postsRepository->deletePosts(Uuid::fromString($args['id']));

        $output = [
            'status' => 'success'
        ];

        return new JsonResponse($output);
    }
}
