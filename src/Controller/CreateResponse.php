<?php

namespace Api\Controller;

use Api\Entity\Posts;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(schema="CreateResponseResult")
 */

class CreateResponse
{
    public function __construct(
        /** @OA\Property(property="id", type="string", example="3315e7c4-cc8c-4d89-b989-c40a05cbde8c"), */
        public readonly string $id,
    ) {
    }
    public static function createPost(Posts $posts): self
    {
        return new CreateResponse(
            $posts->id(),
        );
    }
}
