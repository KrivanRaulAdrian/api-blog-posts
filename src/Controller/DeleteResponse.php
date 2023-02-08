<?php

namespace Api\Controller;

use Api\Entity\Posts;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(schema="DeleteResponseResult")
 */

class DeleteResponse
{
    public function __construct(
        /** @OA\Property(property="status", type="string", example="success"), */
        public readonly string $post_id,
    ) {
    }
    public static function deletePost(Posts $posts): array
    {
        $output = [
            'status' => 'success',
        ];

        return $output;
    }
}
