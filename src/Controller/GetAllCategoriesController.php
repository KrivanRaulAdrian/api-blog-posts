<?php

namespace Api\Controller;

use Api\Repository\CategoriesRepository;
use DI\Container;
use Slim\Psr7\Request;
use Slim\Psr7\Response;
use OpenApi\Annotations as OA;
use Laminas\Diactoros\Response\JsonResponse;

/**
 * @OA\Get(
 *     path="/v1/categories/all",
 *     description="Returns all categories.",
 *     tags={"Categories"},
 *     @OA\Response(
 *         response=200,
 *         description="Category response",
 *     )
 * )
 */


class GetAllCategoriesController
{
    private CategoriesRepository $categoriesRepository;

    public function __construct(Container $container)
    {
        $this->categoriesRepository = $container->get(CategoriesRepository::class);
    }
    public function __invoke(Request $request, Response $response, $args): JsonResponse
    {
        $categories = $this->categoriesRepository->getAllCategories();
        return $this->toJson($categories);
    }
    private function toJson(array $categories): JsonResponse
    {
        $categoryResponse = [];
        foreach ($categories as $category) {
            $categoryResponse[] = [
                'category_id' => $category->category_id()->toString(),
                'name' => $category->name(),
                'description' => $category->description(),
            ];
        }
        return new JsonResponse($categoryResponse);
    }
}
