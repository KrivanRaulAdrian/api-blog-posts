<?php

namespace Api\Controller;

use DI\Container;
use Api\Entity\Posts;
use Ramsey\Uuid\Uuid;
use DateTimeImmutable;
use Slim\Psr7\Request;
use Slim\Psr7\Response;
use Cocur\Slugify\Slugify;
use OpenApi\Annotations as OA;
use Api\Validator\PostValidator;
use Api\Repository\PostsRepository;
use Api\Repository\CategoriesRepository;
use Laminas\Diactoros\Response\JsonResponse;

/**
 * @OA\Post(
 *     security={{"bearerAuth": {}}},
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
 *                  @OA\Property(property="slug", type="string", example="--It will generate automatically by the title--"),
 *                  @OA\Property(property="content", type="string", example="I am the best"),
 *                  @OA\Property(property="thumbnail", type="string", example="Base64 Encoded String"),
 *                  @OA\Property(property="author", type="string", example="Krivan Raul"),
 *                  @OA\Property(property="category_id", type="string", example="[7b2f8bee-cc6d-40f2-92c2-e001f3b08019]"),
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

class CreatePostsCategoriesController
{
    private PostsRepository $postsRepository;
    private CategoriesRepository $categoriesRepository;

    public function __construct(Container $container)
    {
        $this->postsRepository = $container->get(PostsRepository::class);
        $this->categoriesRepository = $container->get(CategoriesRepository::class);
    }
    public function __invoke(Request $request, Response $response, $args): JsonResponse
    {
        $data = json_decode($request->getBody()->getContents(), true);

        $unique = uniqid();

        $b64 = $data['thumbnail'];

        file_put_contents('images/' . $unique . '.jpg', base64_decode($b64));

        $slugify = new Slugify();
        $slug = $slugify->slugify($data['title']);

        PostValidator::validate($data);

        $posts = new Posts(
            Uuid::uuid4(),
            $data['title'],
            $slug,
            $data['content'],
            $_ENV['APP_URL'] . 'images/' . $unique . '.jpg',
            $data['author'],
            new DateTimeImmutable(),
        );

        foreach ($data['category_id'] as $id) {
            $category = $this->categoriesRepository->getByIdString($id);
            $posts->addCategory($category);
        }

        $this->postsRepository->createPosts($posts);

        return new JsonResponse($posts->toArray(), 201);
    }
}
