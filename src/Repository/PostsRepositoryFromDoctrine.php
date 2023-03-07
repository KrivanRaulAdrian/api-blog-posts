<?php

namespace Api\Repository;

use Api\Entity\Posts;
use Doctrine\ORM\EntityManager;
use InvalidArgumentException;
use Ramsey\Uuid\UuidInterface;

class PostsRepositoryFromDoctrine implements PostsRepository
{
    public function __construct(private EntityManager $entityManager)
    {
    }

    public function createPosts(Posts $post): void
    {
        $this->entityManager->persist($post);
        $this->entityManager->flush();
    }
    public function getAllPosts(): array
    {
        return $this
            ->entityManager
            ->getRepository(Posts::class)
            ->findAll();
    }
    public function getById(UuidInterface $id): Posts
    {
        $resultId =  $this
            ->entityManager
            ->getRepository(Posts::class)
            ->findOneBy(['id' => $id]);
        if ($resultId === null) {
            throw new InvalidArgumentException('post ID not found');
        } else {
            return $resultId;
        }
    }
    public function deletePosts(UuidInterface $id): string
    {
        $post = $this->entityManager->getReference('Api\Entity\Posts', $id);
        $this->entityManager->remove($post);
        $this->entityManager->flush();
        return $id;
    }
    public function updatePosts(UuidInterface $id, array $data): void
    {
        $post = $this->entityManager->createQueryBuilder();
        $query = $post->update('Api\Entity\Posts', 'p')
            ->set('p.title', ':title')
            ->set('p.slug', ':slug')
            ->set('p.content', ':content')
            ->set('p.thumbnail', ':thumbnail')
            ->set('p.author', ':author')
            ->set('p.posted_at', ':posted_at')
            ->where('p.id = :id')
            ->setParameter('title', $data['title'])
            ->setParameter('slug', $data['slug'])
            ->setParameter('content', $data['content'])
            ->setParameter('thumbnail', $data['thumbnail'])
            ->setParameter('author', $data['author'])
            ->setParameter('posted_at', $data['posted_at'])
            ->setParameter('id', $id)
            ->getQuery();
        $query->execute();
    }
    public function getBySlug($slug): array
    {
        return $this
            ->entityManager
            ->getRepository(Posts::class)
            ->findBy(['slug' => $slug]);
    }
}
