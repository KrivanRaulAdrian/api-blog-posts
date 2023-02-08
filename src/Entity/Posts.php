<?php

namespace Api\Entity;

use DateTimeImmutable;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

class Posts
{
    public function __construct(
        private UuidInterface $post_id,
        private string $title,
        private string $slug,
        private string $content,
        private string $thumbnail,
        private string $author,
        private string $posted_at,
    ) {
    }
    public static function populate(array $data): self
    {
        return new self(
            Uuid::fromString($data['post_id']),
            $data['title'],
            $data['slug'],
            $data['content'],
            $data['thumbnail'],
            $data['author'],
            $data['posted_at'],
        );
    }
    public function post_id(): UuidInterface
    {
        return $this->post_id;
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
}
