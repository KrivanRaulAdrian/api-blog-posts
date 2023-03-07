<?php

namespace Api\Controller;

use Api\Entity\Categories;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(schema="CreateCategoryResponse")
 */

class CreateCategoryResponse
{
    public function __construct(
        /** @OA\Property(property="id", type="string", example="3315e7c4-cc8c-4d89-b989-c40a05cbde8c"), */
        public readonly string $id,
    ) {
    }
    public static function createPost(Categories $categories): self
    {
        return new CreateCategoryResponse(
            $categories->id(),
        );
    }
}
