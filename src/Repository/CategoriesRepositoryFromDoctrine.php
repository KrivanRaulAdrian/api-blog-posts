<?php

namespace Api\Repository;

use Api\Entity\Categories;
use InvalidArgumentException;
use Ramsey\Uuid\UuidInterface;
use Doctrine\ORM\EntityManager;

class CategoriesRepositoryFromDoctrine implements CategoriesRepository
{
    public function __construct(private EntityManager $entityManager)
    {
    }
    public function createCategories(Categories $categories): void
    {
        $this->entityManager->persist($categories);
        $this->entityManager->flush();
    }
    public function getAllCategories(): array
    {
        return $this
            ->entityManager
            ->getRepository(Categories::class)
            ->findAll();
    }
    public function fetchById(UuidInterface $id): Categories
    {
        $resultId = $this
            ->entityManager
            ->getRepository(Categories::class)
            ->findOneBy(['id' => $id]);
        if ($resultId === null) {
            throw new InvalidArgumentException('category ID not found');
        } else {
            return $resultId;
        }
    }
    public function deleteCategories(UuidInterface $id): string
    {
        $category = $this->entityManager->getReference('Api\Entity\Categories', $id);
        $this->entityManager->remove($category);
        $this->entityManager->flush();
        return $id;
    }
    public function updateCategories(UuidInterface $id, array $data): void
    {
        $category = $this->entityManager->createQueryBuilder();
        $query = $category->update('Api\Entity\Categories', 'c')
            ->set('c.name', ':name')
            ->set('c.description', ':description')
            ->where('c.id = :id')
            ->setParameter('name', $data['name'])
            ->setParameter('description', $data['description'])
            ->setParameter('id', $id)
            ->getQuery();
        $query->execute();
    }
    public function getByIdString($id): Categories
    {
        return $this
            ->entityManager
            ->getRepository(Categories::class)
            ->findOneBy(['id' => $id]);
    }
}
