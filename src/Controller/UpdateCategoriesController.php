<?php

namespace Api\Controller;

use DI\Container;
use Ramsey\Uuid\Uuid;
use Slim\Psr7\Request;
use Slim\Psr7\Response;
use Api\Repository\CategoriesRepository;
use Laminas\Diactoros\Response\JsonResponse;

/**
 * @OA\Put(
 *     path="/v1/categories/{category_id}",
 *     description="Update a category by ID.",
 *     tags={"Categories"},
 *     @OA\Parameter(
 *         description="ID of category to update",
 *         in="path",
 *         name="category_id",
 *         required=true,
 *         @OA\Schema(
 *             type="string",
 *         )
 *     ),
 *     @OA\RequestBody(
 *         description="Category to be updated.",
 *         required=true,
 *         @OA\MediaType(
 *              mediaType="application/json",
 *              @OA\Schema(ref="#/components/schemas/UpdateCategoryResponse")
 *    )
 * ),
 *     @OA\Response(
 *         response="200",
 *         description="The category updated",
 *         @OA\MediaType(
 *           mediaType="application/json",
 *           @OA\Schema(ref="#/components/schemas/UpdateCategoryResponse"),
 *       )
 *     )
 * )
 */

class UpdateCategoriesController
{
    private CategoriesRepository $categoriesRepository;

    public function __construct(Container $container)
    {
        $this->categoriesRepository = $container->get(CategoriesRepository::class);
    }
    public function __invoke(Request $request, Response $response, $args): JsonResponse
    {
        $data = json_decode($request->getBody()->getContents(), true);

        $data = [
            'category_id' => Uuid::uuid4(),
            'name' => $data['name'],
            'description' => $data['description'],
        ];

        $this->categoriesRepository->updateCategories(Uuid::fromString($args['category_id']), $data);

        $output = [
            'status' => 'success',
            'data' => [
                'category_id' => $args['category_id']
            ],
        ];

        return new JsonResponse($output);
    }
}
