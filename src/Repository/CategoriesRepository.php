<?php

namespace Api\Repository;

use Api\Entity\Categories;
use Ramsey\Uuid\UuidInterface;

interface CategoriesRepository
{
    public function createCategories(Categories $categories): void;
    public function getAllCategories(): array;
    public function fetchById(UuidInterface $category_id): Categories;
    public function deleteCategories(UuidInterface $category_id): string;
    public function updateCategories(UuidInterface $category_id, array $data): void;
}
