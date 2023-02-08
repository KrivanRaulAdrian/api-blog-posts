<?php

namespace Api\Controller;

use DI\Container;
use Slim\Psr7\Request;
use Slim\Psr7\Response;
use OpenApi\Annotations as OA;
use Api\Repository\PostsRepository;
use Laminas\Diactoros\Response\JsonResponse;
use Ramsey\Uuid\Uuid;

/**
 * @OA\Delete(
 *     path="/v1/posts/{post_id}",
 *     description="Delete a post by ID.",
 *     tags={"Posts"},
 *     @OA\Parameter(
 *         description="ID of post to delete",
 *         in="path",
 *         name="post_id",
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
        $this->postsRepository->deletePosts(Uuid::fromString($args['post_id']));

        $output = [
            'status' => 'success'
        ];

        return new JsonResponse($output);
    }
}
