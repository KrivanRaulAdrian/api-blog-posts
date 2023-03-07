<?php

namespace Api\Repository;

use Api\Entity\Categories;
use Ramsey\Uuid\UuidInterface;

interface CategoriesRepository
{
    public function createCategories(Categories $categories): void;
    public function getAllCategories(): array;
    public function fetchById(UuidInterface $id): Categories;
    public function deleteCategories(UuidInterface $id): string;
    public function updateCategories(UuidInterface $id, array $data): void;
    public function getByIdString($id): Categories;
}
