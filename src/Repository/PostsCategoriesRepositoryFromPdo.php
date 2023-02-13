<?php

namespace Api\Repository;

use PDO;
use Api\Entity\PostsCategories;

class PostsCategoriesRepositoryFromPdo implements PostsCategoriesRepository
{
    public function __construct(private PDO $pdo)
    {
    }
    public function createPostsCategories(PostsCategories $postsCategories): void
    {
        $stmt = $this->pdo->prepare(<<<SQL
            INSERT INTO posts_categories(id_post, id_category) 
            VALUES(:id_post, :id_category)
        SQL);

        $id_post = $postsCategories->id_post();
        $id_category = $postsCategories->id_category();

        $params = [
            ':id_post' => $id_post,
            ':id_category' => $id_category,
        ];

        $stmt->execute($params);
    }
    public function getByIdJoin($id_post): array
    {
        $stmt = $this->pdo->prepare(<<<SQL
            SELECT  pc.id_post AS id_post, pc.id_category AS id_category, p.title AS title, p.slug AS slug,
                p.content AS content, p.thumbnail AS thumbnail, p.author AS author, p.posted_at AS posted_at, c.name AS name
            FROM categories c
            JOIN posts_categories pc ON pc.id_category=c.category_id
            JOIN posts p ON pc.id_post=p.post_id
            WHERE id_post = :id_post
    SQL);

        $stmt->bindParam(':id_post', $id_post);
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $categories = [];
        foreach ($data as $post) {
            $categories = [
                'id_post' => $post['id_post'],
                'title' => $post['title'],
                'slug' => $post['slug'],
                'content' => $post['content'],
                'thumbnail' => $post['thumbnail'],
                'author' => $post['author'],
                'posted_at' => $post['posted_at']
            ];
        }
        $postsCategories = [];
        foreach ($data as $row) {
            $postsCategories['categories'][] = [
                'id_category' => $row['id_category'],
                'name' => $row['name'],
            ];
        }
        $array = array_merge($categories, $postsCategories);


        return array_unique($array, SORT_REGULAR);
    }
}
