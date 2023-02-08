<?php

namespace Api\Controller;

use DI\Container;
use Slim\Psr7\Request;
use Slim\Psr7\Response;
use OpenApi\Annotations as OA;
use Api\Repository\CategoriesRepository;
use Laminas\Diactoros\Response\JsonResponse;
use Ramsey\Uuid\Uuid;

/**
 * @OA\Delete(
 *     path="/v1/categories/{category_id}",
 *     description="Delete a category by ID.",
 *     tags={"Categories"},
 *     @OA\Parameter(
 *         description="ID of category to delete",
 *         in="path",
 *         name="category_id",
 *         required=true,
 *         @OA\Schema(
 *             type="string",
 *         )
 *     ),
 *     @OA\Response(
 *         response="200",
 *         description="The message after deleting the category",
 *          @OA\MediaType(
 *           mediaType="application/json",
 *           @OA\Schema(ref="#/components/schemas/DeleteCategoryResponse"),
 *         )
 *     )
 * )
 */



class DeleteCategoriesController
{
    private CategoriesRepository $categoriesRepository;

    public function __construct(Container $container)
    {
        $this->categoriesRepository = $container->get(CategoriesRepository::class);
    }
    public function __invoke(Request $request, Response $response, $args): JsonResponse
    {
        $this->categoriesRepository->deleteCategories(Uuid::fromString($args['category_id']));

        $output = [
            'status' => 'success'
        ];

        return new JsonResponse($output);
    }
}
