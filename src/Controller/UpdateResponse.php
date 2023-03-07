<?php

namespace Api\Controller;

use Api\Entity\Posts;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(schema="UpdateResponseResult")
 */

class UpdateResponse
{
    public function __construct(
        /** @OA\Property(property="title", type="string", example="Best Course Example"), */
        public readonly string $title,
        /** @OA\Property(property="slug", type="string", example="Course Example"), */
        public readonly string $slug,
        /** @OA\Property(property="content", type="string", example="A course that helps you create examples"), */
        public readonly string $content,
        /** @OA\Property(property="thumbnail", type="string", example="Base64 Encoded String"), */
        public readonly string $thumbnail,
        /** @OA\Property(property="author", type="string", example="Raul K"), */
        public readonly string $author,
        /** @OA\Property(property="posted_at", type="string", example="2023-02-02 17:07:10") */
        public readonly string $posted_at,
    ) {
    }
    public static function updatePost(Posts $posts): self
    {
        return new UpdateResponse(
            $posts->title(),
            $posts->slug(),
            $posts->content(),
            $posts->thumbnail(),
            $posts->author(),
            $posts->postedAt()->format('Y-m-d H:i:s'),
        );
    }
}
