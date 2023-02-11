<?php

namespace Api\Repository;

use Api\Entity\PostsCategories;

interface PostsCategoriesRepository
{
    public function createPostsCategories(PostsCategories $postsCategories): void;
    public function getByIdJoin($id_post): array;
}
