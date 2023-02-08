<?php

namespace Api\Repository;

use Api\Entity\Categories;
use PDO;
use Ramsey\Uuid\UuidInterface;

class CategoriesRepositoryFromPdo implements CategoriesRepository
{
    public function __construct(private PDO $pdo)
    {
    }
    public function createCategories(Categories $categories): void
    {
        $stmt = $this->pdo->prepare(<<<SQL
            INSERT INTO categories VALUES (?, ?, ?)
        SQL);

        $stmt->execute([
            $categories->category_id()->toString(),
            $categories->name(),
            $categories->description(),
        ]);
    }
    public function getAllCategories(): array
    {
        $results = $this->pdo->query(<<<SQL
            SELECT * FROM categories
        SQL)->fetchAll();

        $categories = [];
        foreach ($results as $item) {
            $categories[] = Categories::insert($item);
        }
        return $categories;
    }
    public function fetchById(UuidInterface $category_id): Categories
    {
        $stmt = $this->pdo->prepare(<<<SQL
            SELECT *
            FROM categories
            WHERE category_id = ?
        SQL);

        $stmt->execute([$category_id->toString()]);
        $data = $stmt->fetch();
        return Categories::insert($data);
    }
    public function deleteCategories(UuidInterface $category_id): string
    {
        $stmt = $this->pdo->prepare(<<<SQL
            DELETE
            FROM categories
            WHERE category_id = :category_id
        SQL);

        $stmt->bindParam(':category_id', $category_id);
        $stmt->execute();

        return $category_id;
    }
    public function updateCategories(UuidInterface $category_id, array $data): void
    {
        $stmt = $this->pdo->prepare(<<<SQL
            UPDATE categories
            SET name = :name, description = :description
            WHERE category_id = :category_id
        SQL);

        $stmt->bindValue(':category_id', $category_id);
        $stmt->bindValue(':name', $data['name']);
        $stmt->bindValue(':description', $data['description']);

        $stmt->execute();
    }
}
