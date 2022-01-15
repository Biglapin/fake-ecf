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
    private $adventure;

    #[ORM\Column(type: 'string', length: 255)]
    private $fantasy;

    #[ORM\Column(type: 'string', length: 255)]
    private $horror;

    #[ORM\Column(type: 'string', length: 255)]
    private $romance;

    #[ORM\Column(type: 'string', length: 255)]
    private $thriller;

    #[ORM\Column(type: 'string', length: 255)]
    private $comedy;

    #[ORM\Column(type: 'string', length: 255)]
    private $other;

    #[ORM\ManyToMany(targetEntity: Book::class, mappedBy: 'genre')]
    private $books;

    public function __construct()
    {
        $this->books = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAdventure(): ?string
    {
        return $this->adventure;
    }

    public function setAdventure(string $adventure): self
    {
        $this->adventure = $adventure;

        return $this;
    }

    public function getFantasy(): ?string
    {
        return $this->fantasy;
    }

    public function setFantasy(string $fantasy): self
    {
        $this->fantasy = $fantasy;

        return $this;
    }

    public function getHorror(): ?string
    {
        return $this->horror;
    }

    public function setHorror(string $horror): self
    {
        $this->horror = $horror;

        return $this;
    }

    public function getRomance(): ?string
    {
        return $this->romance;
    }

    public function setRomance(string $romance): self
    {
        $this->romance = $romance;

        return $this;
    }

    public function getThriller(): ?string
    {
        return $this->thriller;
    }

    public function setThriller(string $thriller): self
    {
        $this->thriller = $thriller;

        return $this;
    }

    public function getComedy(): ?string
    {
        return $this->comedy;
    }

    public function setComedy(string $comedy): self
    {
        $this->comedy = $comedy;

        return $this;
    }

    public function getOther(): ?string
    {
        return $this->other;
    }

    public function setOther(string $other): self
    {
        $this->other = $other;

        return $this;
    }

    /**
     * @return Collection|Book[]
     */
    public function getBooks(): Collection
    {
        return $this->books;
    }

    public function addBook(Book $book): self
    {
        if (!$this->books->contains($book)) {
            $this->books[] = $book;
            $book->addGenre($this);
        }

        return $this;
    }

    public function removeBook(Book $book): self
    {
        if ($this->books->removeElement($book)) {
            $book->removeGenre($this);
        }

        return $this;
    }
}
