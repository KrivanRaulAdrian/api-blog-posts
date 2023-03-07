<?php

namespace ApiTest\Entity;

use Api\Entity\Categories;
use Ramsey\Uuid\Uuid;
use PHPUnit\Framework\TestCase;

class CreateCategoriesTest extends TestCase
{
    public function testCreateCategoriestShouldWork(): void
    {
        $id = Uuid::uuid4();
        $name = 'Category name';
        $description = 'Category description';

        $categories = new Categories(
            $id,
            $name,
            $description,
        );

        self::assertEquals($id, $categories->id());
        self::assertEquals($name, $categories->name());
        self::assertEquals($description, $categories->description());
    }
}
