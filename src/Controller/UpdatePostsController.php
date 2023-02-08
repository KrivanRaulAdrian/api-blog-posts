<?php

namespace Api\Controller;

use DI\Container;
use Ramsey\Uuid\Uuid;
use Slim\Psr7\Request;
use Slim\Psr7\Response;
use Api\Repository\PostsRepository;
use Laminas\Diactoros\Response\JsonResponse;

/**
 * @OA\Put(
 *     path="/v1/posts/{post_id}",
 *     description="Update a post by ID.",
 *     tags={"Posts"},
 *     @OA\Parameter(
 *         description="ID of post to update",
 *         in="path",
 *         name="post_id",
 *         required=true,
 *         @OA\Schema(
 *             type="string",
 *         )
 *     ),
 *     @OA\RequestBody(
 *         description="Post to be updated.",
 *         required=true,
 *         @OA\MediaType(
 *              mediaType="application/json",
 *              @OA\Schema(ref="#/components/schemas/UpdateResponseResult")
 *    )
 * ),
 *     @OA\Response(
 *         response="200",
 *         description="The post updated",
 *         @OA\MediaType(
 *           mediaType="application/json",
 *           @OA\Schema(ref="#/components/schemas/UpdateResponseResult"),
 *       )
 *     )
 * )
 */

class UpdatePostsController
{
    private PostsRepository $postsRepository;

    public function __construct(Container $container)
    {
        $this->postsRepository = $container->get(PostsRepository::class);
    }
    public function __invoke(Request $request, Response $response, $args): JsonResponse
    {
        $data = json_decode($request->getBody()->getContents(), true);

        $unique = uniqid();

        $b64 = $data['thumbnail'];
        
        file_put_contents('images/' . $unique . '.jpg', base64_decode($b64));

        $data = [
            'post_id' => Uuid::uuid4(),
            'title' => $data['title'],
            'slug' => $data['slug'],
            'content' => $data['content'],
            'thumbnail' => $_ENV['APP_URL'] . 'images/' . $unique . '.jpg',
            'author' => $data['author'],
            'posted_at' => $data['posted_at']
        ];

        $this->postsRepository->updatePosts(Uuid::fromString($args['post_id']), $data);

        $output = [
            'status' => 'success',
            'data' => [
                'post_id' => $args['post_id']
            ],
        ];

        return new JsonResponse($output);
    }
}
