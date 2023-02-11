<?php

namespace Api\Controller;

use Api\Entity\PostsCategories;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(schema="CreatePostsCategoriesResult")
 */

class CreatePostsCategoryResponse
{
    public function __construct(
        /** @OA\Property(property="status", type="string", example="success"), */
        public readonly string $category_id,
    ) {
    }
    public static function createPostCategories(PostsCategories $postsCategories): self
    {
        return new CreatePostsCategoryResponse(
            $postsCategories->id_post(),
        );
    }
}
