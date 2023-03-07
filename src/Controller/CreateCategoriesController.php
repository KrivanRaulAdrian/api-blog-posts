<?php

namespace Api\Controller;

use DI\Container;
use Ramsey\Uuid\Uuid;
use Slim\Psr7\Request;
use Slim\Psr7\Response;
use Api\Entity\Categories;
use OpenApi\Annotations as OA;
use Api\Repository\CategoriesRepository;
use Api\Validator\CategoryValidator;
use Laminas\Diactoros\Response\JsonResponse;

/**
 * @OA\Post(
 *     path="/v1/categories/create",
 *     description="Add a new category",
 *     tags={"Categories"},
 *     @OA\RequestBody(
 *         description="Category to be created",
 *         required=true,
 *         @OA\MediaType(
 *              mediaType="application/json",
 *              @OA\Schema(
 *                  @OA\Property(property="name", type="string", example="Best Name Ever Existed"),
 *                  @OA\Property(property="description", type="string", example="It is a simple description"),
 *      )
 *    )
 * ),
 * @OA\Response(
 *     response="200",
 *     description="The ID of the category",
 *       @OA\MediaType(
 *           mediaType="application/json",
 *           @OA\Schema(ref="#/components/schemas/CreateCategoryResponse"),
 *       )
 *     )
 *   )
 * )
 */

class CreateCategoriesController
{
    private CategoriesRepository $categoriesRepository;

    public function __construct(Container $container)
    {
        $this->categoriesRepository = $container->get(CategoriesRepository::class);
    }
    public function __invoke(Request $request, Response $response, $args): JsonResponse
    {
        $data = json_decode($request->getBody()->getContents(), true);

        CategoryValidator::validate($data);

        $categories = new Categories(
            Uuid::uuid4(),
            $data['name'],
            $data['description'],
        );

        $this->categoriesRepository->createCategories($categories);

        $output = [
            'status' => 'success',
            'data' => [
                'id' => $categories->id(),
            ],
        ];

        return new JsonResponse($output, 201);
    }
}
