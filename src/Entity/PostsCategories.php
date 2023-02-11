<?php

namespace Api\Entity;

use Ramsey\Uuid\Uuid;
use DateTimeImmutable;
use Ramsey\Uuid\UuidInterface;

class PostsCategories
{
    private string $title;
    private string $slug;
    private string $content;
    private string $thumbnail;
    private string $author;
    private  $posted_at;
    private string $name;

    public function __construct(
        private UuidInterface $id_post,
        private UuidInterface $id_category,
        string $title = '',
        string $slug = '',
        string $content = '',
        string $thumbnail = '',
        string $author = '',
        string $posted_at = '',
        string $name = '',
    ) {
        $this->title = $title;
        $this->slug = $slug;
        $this->content = $content;
        $this->thumbnail = $thumbnail;
        $this->author = $author;
        $this->posted_at = $posted_at;
        $this->name = $name;
    }
    public static function add(array $data): self
    {
        return new self(
            Uuid::fromString($data['id_post']),
            Uuid::fromString($data['id_category']),
            $data['title'],
            $data['slug'],
            $data['content'],
            $data['thumbnail'],
            $data['author'],
            $data['posted_at'],
            $data['name'],
        );
    }
    public function id_post(): UuidInterface
    {
        return $this->id_post;
    }
    public function id_category(): UuidInterface
    {
        return $this->id_category;
    }
    public function title(): string
    {
        return $this->title;
    }
    public function slug(): string
    {
        return $this->slug;
    }
    public function content(): string
    {
        return $this->content;
    }
    public function thumbnail(): string
    {
        return $this->thumbnail;
    }
    public function author(): string
    {
        return $this->author;
    }
    public function posted_at(): DateTimeImmutable
    {
        return new DateTimeImmutable($this->posted_at);
    }
    public function name(): string
    {
        return $this->name;
    }
}
