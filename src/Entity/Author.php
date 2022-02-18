<?php

namespace App\Entity;

use App\Repository\AuthorRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AuthorRepository::class)]
class Author
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $firstname;

    #[ORM\Column(type: 'string', length: 255)]
    private $lastname;

    #[ORM\OneToMany(mappedBy: 'author', targetEntity: Book::class)]
    private $FullName;

    #[ORM\OneToMany(mappedBy: 'author', targetEntity: Book::class)]
    private $author;

    public function __construct()
    {
        $this->FullName = new ArrayCollection();
        $this->author = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }
    public function __toString(): string
    {
        return $this->firstname;
    }
    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getFullName(): ?string
    {
        return $this->firstname + " " + $this->lastname;
    }

    public function addFullName(Book $fullName): self
    {
        if (!$this->FullName->contains($fullName)) {
            $this->FullName[] = $fullName;
            $fullName->setAuthor($this);
        }

        return $this;
    }

    public function removeFullName(Book $fullName): self
    {
        if ($this->FullName->removeElement($fullName)) {
            // set the owning side to null (unless already changed)
            if ($fullName->getAuthor() === $this) {
                $fullName->setAuthor(null);
            }
        }

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
            $author->setAuthor($this);
        }

        return $this;
    }

    public function removeAuthor(Book $author): self
    {
        if ($this->author->removeElement($author)) {
            // set the owning side to null (unless already changed)
            if ($author->getAuthor() === $this) {
                $author->setAuthor(null);
            }
        }

        return $this;
    }
}
