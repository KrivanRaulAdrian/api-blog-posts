<?php

namespace Api\Controller;

use Api\Entity\Categories;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(schema="UpdateCategoryResponse")
 */

class UpdateCategoryResponse
{
    public function __construct(
        /** @OA\Property(property="name", type="string", example="Best Course Example"), */
        public readonly string $name,
        /** @OA\Property(property="description", type="string", example="Course Example"), */
        public readonly string $description,
    ) {
    }
    public static function updateCategories(Categories $categories): self
    {
        return new UpdateCategoryResponse(
            $categories->name(),
            $categories->description(),
        );
    }
}
