<?php

namespace Api\Repository;

use Api\Entity\Posts;
use Ramsey\Uuid\UuidInterface;

interface PostsRepository
{
    public function createPosts(Posts $post): void;
    public function getAllPosts(): array;
    public function getById(UuidInterface $post_id): Posts;
    public function deletePosts(UuidInterface $post_id): string;
    public function updatePosts(UuidInterface $post_id, array $data): void;
}
