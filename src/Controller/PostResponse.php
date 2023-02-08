<?php

namespace Api\Controller;

use Api\Entity\Posts;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(schema="PostResponseResult")
 */

class PostResponse
{
    public function __construct(
        /** @OA\Property(property="title", type="string", example="Best Developer Ever Existed"), */
        public readonly string $title,
        /** @OA\Property(property="slug", type="string", example="It is me"), */
        public readonly string $slug,
        /** @OA\Property(property="content", type="string", example="I am the best"), */
        public readonly string $content,
        /** @OA\Property(property="thumbnail", type="string", example="Base64 Encoded String"), */
        public readonly string $thumbnail,
        /** @OA\Property(property="author", type="string", example="Krivan Raul"), */
        public readonly string $author,
        /** @OA\Property(property="posted_at", type="string", example="2023-01-25"), */
        public readonly string $posted_at,
    ) {
    }
    public static function postResponse(Posts $posts): self
    {
        return new PostResponse(
            $posts->title(),
            $posts->slug(),
            $posts->content(),
            $posts->thumbnail(),
            $posts->author(),
            $posts->posted_at()->format('Y-m-d H:i:s'),
        );
    }
}
