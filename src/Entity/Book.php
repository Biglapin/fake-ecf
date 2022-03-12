<?php

namespace App\Entity;

use App\Repository\BookRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Serializer\Annotation\Groups;
use Doctrine\ORM\Mapping as ORM;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\File\File;


#[ORM\Entity(repositoryClass: BookRepository::class)]
#[Vich\Uploadable]
class Book
{
    /**
     * @Groups({"show_books"})
     */
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    /**
     * @Groups({"show_books"})
     */
    #[ORM\Column(type: 'string', length: 255)]
    private $title;


    #[ORM\Column(type: 'string',nullable: true, length: 255)]
    private $images;

    
    #[Vich\UploadableField(mapping: 'books_images' ,fileNameProperty: 'images')]
    private ?File $imageFile = null;


    #[ORM\Column(type: 'date', nullable: true)]
    private $publishing_date;

    #[ORM\Column(type: 'text', nullable: true)]
    private $description;

    /**
     * @Groups({"show_books"})
     */
    #[ORM\Column(type: 'boolean')]
    private $isReserved;

    #[ORM\ManyToOne(targetEntity: Genre::class, inversedBy: 'author')]
    private $genre;

    #[ORM\ManyToOne(targetEntity: Author::class, inversedBy: 'author')]
    private $author;

    public function getId(): ?int
    {
        return $this->id;
    }
    public function __toString(): string
    {
        return $this->title;
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
    
    public function setImageFile(File $image = null)
    {
        $this->imageFile = $image;

        // VERY IMPORTANT:
        // It is required that at least one field changes if you are using Doctrine,
        // otherwise the event listeners won't be called and the file is lost
        if ($image) {
            // if 'updatedAt' is not defined in your entity, use another property
            $this->updatedAt = new \DateTime('now');
        }
    }

    public function getImageFile()
    {
        return $this->imageFile;
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

    public function getIsReserved(): ?bool
    {
        return $this->isReserved;
    }

    public function setIsReserved(bool $isReserved): self
    {
        $this->isReserved = $isReserved;

        return $this;
    }

    public function getGenre(): ?Genre
    {
        return $this->genre;
    }

    public function setGenre(?Genre $genre): self
    {
        $this->genre = $genre;

        return $this;
    }

    public function getAuthor(): ?Author
    {
        return $this->author;
    }

    public function setAuthor(?Author $author): self
    {
        $this->author = $author;

        return $this;
    }

}
