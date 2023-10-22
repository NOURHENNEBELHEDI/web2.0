<?php

namespace App\Entity;

<<<<<<< HEAD
use App\Entity\Book;
use App\Repository\BookRepository;
use App\Form\BookType;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;


=======
use App\Repository\BookRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

>>>>>>> 3b0e16860b787fd0c263df6102f3ddf95c12a14f
#[ORM\Entity(repositoryClass: BookRepository::class)]
class Book
{
    #[ORM\Id]
    #[ORM\Column]
    private ?int $ref = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column]
    private ?bool $published = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $publicationDate = null;

    #[ORM\Column(length: 255)]
    private ?string $category = null;

    #[ORM\ManyToOne(inversedBy: 'books')]
    private ?Author $author = null;

<<<<<<< HEAD
    public function getRef(): ?int
=======
    public function getId(): ?int
>>>>>>> 3b0e16860b787fd0c263df6102f3ddf95c12a14f
    {
        return $this->ref;
    }

<<<<<<< HEAD
    public function setRef(int $ref): void
    {
        $this->ref = $ref;


=======
    public function setRef(string $ref): static
    {
        $this->ref = $ref;

        return $this;
>>>>>>> 3b0e16860b787fd0c263df6102f3ddf95c12a14f
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function isPublished(): ?bool
    {
        return $this->published;
    }

    public function setPublished(bool $published): static
    {
        $this->published = $published;

        return $this;
    }

    public function getPublicationDate(): ?\DateTimeInterface
    {
        return $this->publicationDate;
    }

    public function setPublicationDate(\DateTimeInterface $publicationDate): static
    {
        $this->publicationDate = $publicationDate;

        return $this;
    }

    public function getCategory(): ?string
    {
        return $this->category;
    }

    public function setCategory(string $category): static
    {
        $this->category = $category;

        return $this;
    }

    public function getAuthor(): ?Author
    {
        return $this->author;
    }

    public function setAuthor(?Author $author): static
    {
        $this->author = $author;

        return $this;
    }
}
