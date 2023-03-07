<?php

namespace Api\Entity;

use Ramsey\Uuid\Uuid;
use DateTimeImmutable;
use Ramsey\Uuid\UuidInterface;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Doctrine\UuidGenerator;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

#[
    ORM\Entity,
    ORM\Table(name: 'posts')
]

class Posts
{
    #[ORM\ManyToMany(targetEntity: Categories::class, inversedBy: 'posts')]
    private Collection $categories;

    public function __construct(
        #[
            ORM\Id,
            ORM\Column(type: 'uuid', unique: true),
            ORM\GeneratedValue(strategy: "CUSTOM"),
            ORM\CustomIdGenerator(class: UuidGenerator::class)
        ]
        private UuidInterface $id,
        #[ORM\Column(type: 'string', nullable: false)]
        private string $title,
        #[ORM\Column(type: 'string', nullable: false)]
        private string $slug,
        #[ORM\Column(type: 'string', nullable: false)]
        private string $content,
        #[ORM\Column(type: 'string', nullable: false)]
        private string $thumbnail,
        #[ORM\Column(type: 'string', nullable: false)]
        private string $author,
        #[ORM\Column(type: 'datetime_immutable', nullable: false)]
        private DateTimeImmutable $posted_at,
    ) {
        $this->categories = new ArrayCollection();
    }
    public static function populate(array $data): self
    {
        return new self(
            Uuid::fromString($data['id']),
            $data['title'],
            $data['slug'],
            $data['content'],
            $data['thumbnail'],
            $data['author'],
            $data['posted_at'],
        );
    }
    public function id(): UuidInterface
    {
        return $this->id;
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
        return $this->posted_at;
    }
    public function getCategories(): Collection
    {
        return $this->categories;
    }
    public function addCategory(Categories $category): self
    {
        if (!$this->categories->contains($category)) {
            $this->categories->add($category);
        }
        return $this;
    }
    public function removeCategory(Categories $category): self
    {
        $this->categories->removeElement($category);

        return $this;
    }
    public function toArray(): array
    {
        $categories = [];
        foreach ($this->getCategories() as $category) {
            $categories[] = $category->toArray();
        }

        return [
            'id' => $this->id(),
            'title' => $this->title(),
            'slug' => $this->slug(),
            'content' => $this->content(),
            'thumbnail' => $this->thumbnail(),
            'author' => $this->author(),
            'categories' => $categories
        ];
    }
}
