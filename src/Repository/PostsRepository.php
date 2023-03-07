<?php

namespace Api\Repository;

use Api\Entity\Posts;
use Ramsey\Uuid\UuidInterface;

interface PostsRepository
{
    public function createPosts(Posts $post): void;
    public function getAllPosts(): array;
    public function getById(UuidInterface $id): Posts;
    public function deletePosts(UuidInterface $id): string;
    public function updatePosts(UuidInterface $id, array $data): void;
    public function getBySlug($slug): array;
}
