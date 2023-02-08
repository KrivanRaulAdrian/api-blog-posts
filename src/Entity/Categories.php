<?php

namespace Api\Entity;

use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

class Categories
{
    public function __construct(
        private UuidInterface $category_id,
        private string $name,
        private string $description,
    ) {
    }
    public static function insert(array $data): self
    {
        return new self(
            Uuid::fromString($data['category_id']),
            $data['name'],
            $data['description'],
        );
    }
    public function category_id(): UuidInterface
    {
        return $this->category_id;
    }
    public function name(): string
    {
        return $this->name;
    }
    public function description(): string
    {
        return $this->description;
    }
}
