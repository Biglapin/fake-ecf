<?php

namespace App\Entity;

use App\Repository\GenreRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GenreRepository::class)]
class Genre
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\OneToMany(mappedBy: 'genre', targetEntity: Book::class)]
    private $author;

    public function __construct()
    {
        $this->author = new ArrayCollection();
    }
    public function __toString(): string
    {
        return $this->name;
    }
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection|Book[]
     */
    public function getAuthor(): Collection
    {
        return $this->author;
    }

    public function addAuthor(Book $author): self
    {
        if (!$this->author->contains($author)) {
            $this->author[] = $author;
            $author->setGenre($this);
        }

        return $this;
    }

    public function removeAuthor(Book $author): self
    {
        if ($this->author->removeElement($author)) {
            // set the owning side to null (unless already changed)
            if ($author->getGenre() === $this) {
                $author->setGenre(null);
            }
        }

        return $this;
    }
}
