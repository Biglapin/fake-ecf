<?php

namespace App\Entity;

use App\Repository\BookRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BookRepository::class)]
class Book
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'integer')]
    private $id_book;

    #[ORM\Column(type: 'string', length: 255)]
    private $title;

    #[ORM\Column(type: 'string', length: 255)]
    private $images;

    #[ORM\Column(type: 'date', nullable: true)]
    private $publishing_date;

    #[ORM\Column(type: 'text', nullable: true)]
    private $description;

    #[ORM\ManyToOne(targetEntity: Author::class, inversedBy: 'books')]
    #[ORM\JoinColumn(nullable: false)]
    private $id_author;

    #[ORM\ManyToOne(targetEntity: Genre::class, inversedBy: 'books')]
    private $genre;

    #[ORM\OneToOne(mappedBy: 'id_book', targetEntity: Borrowing::class, cascade: ['persist', 'remove'])]
    private $borrowing;

    #[ORM\Column(type: 'boolean')]
    private $isReserved;

    public function __construct()
    {
        $this->genre = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdBook(): ?int
    {
        return $this->id_book;
    }

    public function setIdBook(int $id_book): self
    {
        $this->id_book = $id_book;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getImages(): ?string
    {
        return $this->images;
    }

    public function setImages(string $images): self
    {
        $this->images = $images;

        return $this;
    }

    public function getPublishingDate(): ?\DateTimeInterface
    {
        return $this->publishing_date;
    }

    public function setPublishingDate(?\DateTimeInterface $publishing_date): self
    {
        $this->publishing_date = $publishing_date;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getIdAuthor(): ?Author
    {
        return $this->id_author;
    }

    public function setIdAuthor(?Author $id_author): self
    {
        $this->id_author = $id_author;

        return $this;
    }

    /**
     * @return Collection|Genre[]
     */
    public function getGenre(): Collection
    {
        return $this->genre;
    }

    public function addGenre(Genre $genre): self
    {
        if (!$this->genre->contains($genre)) {
            $this->genre[] = $genre;
        }

        return $this;
    }

    public function removeGenre(Genre $genre): self
    {
        $this->genre->removeElement($genre);

        return $this;
    }

    public function getBorrowing(): ?Borrowing
    {
        return $this->borrowing;
    }

    public function setBorrowing(Borrowing $borrowing): self
    {
        // set the owning side of the relation if necessary
        if ($borrowing->getIdBook() !== $this) {
            $borrowing->setIdBook($this);
        }

        $this->borrowing = $borrowing;

        return $this;
    }

    public function getIsReserved(): ?bool
    {
        return $this->isReserved;
    }

    public function setIsReserved(bool $isReserved): self
    {
        $this->isReserved = $isReserved;

        return $this;
    }
    public function __toString()
    {
        return $this->name;
    }
}
