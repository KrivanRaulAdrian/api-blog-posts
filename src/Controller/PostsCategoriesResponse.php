<?php

namespace Api\Controller;

use Api\Entity\PostsCategories;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(schema="PostsCategoriesResponseResult")
 */

class PostsCategoriesResponse
{
    public function __construct(
        /** @OA\Property(property="id_post", type="string", example="855a0350-96e7-4fef-8dc2-44b530209a72"), */
        public readonly string $id_post,
        /** @OA\Property(property="title", type="string", example="All the Easter Eggs in PHP"), */
        public readonly string $title,
        /** @OA\Property(property="slug", type="string", example="--It will generate automatically by the title--"), */
        public readonly string $slug,
        /** @OA\Property(property="content", type="string", example="PHP used to pack quite a few Easter Eggs back in the day. Until PHP 5.5, calling a URL with a special string returned various bits of PHP information and images such as the PHP logo, credits, Zend Engine logo, and a quirky PHP Easter Egg logo."), */
        public readonly string $content,
        /** @OA\Property(property="thumbnail", type="string", example="http://localhost:8889/thumbnails/855a0350.jpg"), */
        public readonly string $thumbnail,
        /** @OA\Property(property="author", type="string", example="A PHP Developer"), */
        public readonly string $author,
        /** @OA\Property(property="posted_at", type="string", example="2023-02-01 17:30:01"), */
        public readonly string $posted_at,
        /** @OA\Property(property="id_category", type="string", example="77df24a1-c06b-4987-857d-a29e0d445fbf"), */
        public readonly string $id_category,
        /** @OA\Property(property="name", type="string", example="php") */
        public readonly string $name,
    ) {
    }
    public static function postCategoriesResponse(PostsCategories $postsCategories): self
    {
        return new PostsCategoriesResponse(
            $postsCategories->id_post(),
            $postsCategories->title(),
            $postsCategories->slug(),
            $postsCategories->content(),
            $postsCategories->thumbnail(),
            $postsCategories->author(),
            $postsCategories->posted_at()->format('Y-m-d H:i:s'),
            $postsCategories->id_category(),
            $postsCategories->name(),
        );
    }
}
