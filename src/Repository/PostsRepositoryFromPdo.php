<?php

namespace Api\Repository;

use PDO;
use Api\Entity\Posts;
use Ramsey\Uuid\UuidInterface;

class PostsRepositoryFromPdo implements PostsRepository
{
    public function __construct(private PDO $pdo)
    {
    }

    public function createPosts(Posts $post): void
    {
        $stmt = $this->pdo->prepare(<<<SQL
            INSERT INTO posts VALUES (?, ?, ?, ?, ?, ?, ?)
        SQL);

        $stmt->execute([
            $post->post_id()->toString(),
            $post->title(),
            $post->slug(),
            $post->content(),
            $post->thumbnail(),
            $post->author(),
            $post->posted_at()->format('Y-m-d H:i:s'),
        ]);
    }
    public function getAllPosts(): array
    {
        $result = $this->pdo->query(<<<SQL
            SELECT * FROM posts
        SQL)->fetchAll();

        $posts = [];
        foreach ($result as $postData) {
            $posts[] = Posts::populate($postData);
        }
        return $posts;
    }
    public function getById(UuidInterface $post_id): Posts
    {
        $stmt = $this->pdo->prepare(<<<SQL
            SELECT * 
            FROM posts
            WHERE post_id = ?
        SQL);

        $stmt->execute([$post_id->toString()]);
        $data = $stmt->fetch();
        return Posts::populate($data);
    }
    public function deletePosts(UuidInterface $post_id): string
    {
        $stmt = $this->pdo->prepare(<<<SQL
            DELETE 
            FROM posts
            WHERE post_id = :post_id
        SQL);

        $stmt->bindParam(':post_id', $post_id);
        $stmt->execute();

        return $post_id;
    }
    public function updatePosts(UuidInterface $post_id, array $data): void
    {
        $stmt = $this->pdo->prepare(<<<SQL
            UPDATE posts
            SET title = :title, slug = :slug, content = :content, thumbnail = :thumbnail, author = :author, posted_at = :posted_at
            WHERE post_id = :post_id
        SQL);

        $stmt->bindValue(':post_id', $post_id);
        $stmt->bindValue(':title', $data['title']);
        $stmt->bindValue(':slug', $data['slug']);
        $stmt->bindValue(':content', $data['content']);
        $stmt->bindValue(':thumbnail', $data['thumbnail']);
        $stmt->bindValue(':author', $data['author']);
        $stmt->bindValue(':posted_at', $data['posted_at']);

        $stmt->execute();
    }
    public function getBySlug($slug): array
    {
        $stmt = $this->pdo->prepare(<<<SQL
            SELECT * 
            FROM posts
            WHERE slug = ?
        SQL);

        $stmt->execute([$slug]);
        $data = [];
        foreach ($stmt as $item) {
            $data[] = Posts::populate($item);
        }
        return $data;
    }
}
