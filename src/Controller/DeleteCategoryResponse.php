<?php

namespace Api\Controller;

use Api\Entity\Categories;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(schema="DeleteCategoryResponse")
 */

class DeleteCategoryResponse
{
    public function __construct(
        /** @OA\Property(property="status", type="string", example="success"), */
        public readonly string $id,
    ) {
    }
    public static function deleteCategory(Categories $categories): array
    {
        $output = [
            'status' => 'success',
        ];

        return $output;
    }
}
