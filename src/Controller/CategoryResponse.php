<?php

namespace Api\Controller;

use Api\Entity\Categories;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(schema="CategoryResponseResult")
 */

class CategoryResponse
{
    public function __construct(
        /** @OA\Property(property="name", type="string", example="Best Developer Ever Existed"), */
        public readonly string $name,
        /** @OA\Property(property="description", type="string", example="It is me"), */
        public readonly string $description,
    ) {
    }
    public static function categoryResponse(Categories $categories): self
    {
        return new CategoryResponse(
            $categories->name(),
            $categories->description(),
        );
    }
}
