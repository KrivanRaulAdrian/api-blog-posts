<?php

namespace Api\Controller;

use DI\Container;
use Api\Entity\Posts;
use Ramsey\Uuid\Uuid;
use Slim\Psr7\Request;
use Slim\Psr7\Response;
use OpenApi\Annotations as OA;
use Api\Repository\PostsRepository;
use Laminas\Diactoros\Response\JsonResponse;

/**
 * @OA\Post(
 *     path="/v1/posts/create",
 *     description="Add a new post",
 *     tags={"Posts"},
 *     @OA\RequestBody(
 *         description="Post to be created",
 *         required=true,
 *         @OA\MediaType(
 *              mediaType="application/json",
 *              @OA\Schema(
 *                  @OA\Property(property="title", type="string", example="Best Developer Ever Existed"),
 *                  @OA\Property(property="slug", type="string", example="It is me"),
 *                  @OA\Property(property="content", type="string", example="I am the best"),
 *                  @OA\Property(property="thumbnail", type="string", example="Base64 Encoded String"),
 *                  @OA\Property(property="author", type="string", example="Krivan Raul"),
 *                  @OA\Property(property="posted_at", type="string", example="NOW"),
 *      )
 *    )
 * ),
 * @OA\Response(
 *     response="200",
 *     description="The ID of the post",
 *       @OA\MediaType(
 *           mediaType="application/json",
 *           @OA\Schema(ref="#/components/schemas/CreateResponseResult"),
 *       )
 *     )
 *   )
 * )
 */

class CreatePostsController
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

        $posts = new Posts(
            Uuid::uuid4(),
            $data['title'],
            $data['slug'],
            $data['content'],
            $_ENV['APP_URL'] . 'images/' . $unique . '.jpg',
            $data['author'],
            $data['posted_at'],
        );

        $this->postsRepository->createPosts($posts);

        $output = [
            'status' => 'success',
            'data' => [
                'post_id' => $posts->post_id(),
            ],
        ];

        return new JsonResponse($output, 200);
    }
}
