<?php

namespace App\Entity;

use App\Repository\AnnancesRepository;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

#[ORM\Entity(repositoryClass: AnnancesRepository::class)]
class Annances
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $title;

    #[Gedmo\Slug(fields:['title'])]
    #[ORM\Column(type: 'string', length: 255)]
    private $slug;


    #[ORM\Column(type: 'text')]
    private $content;

    #[Gedmo\Timestampable(on:"create")]
    #[ORM\Column(type: 'datetime_immutable')]
    private $created_at;

//    #[ORM\Column(type: 'boolean')]
//    private $active;

    #[ORM\ManyToOne(targetEntity: Users::class, inversedBy: 'annances')]
    #[ORM\JoinColumn(nullable: true)]
    private $users;

    #[ORM\ManyToOne(targetEntity: Categories::class, inversedBy: 'annances')]
    #[ORM\JoinColumn(nullable: true)]
    private $categories;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getSlug(): ?string
    {
        return $this->slug;
    }

//    public function setSlug(string $slug): self
//    {
//        $this->slug = $slug;
//
//        return $this;
//    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->created_at;
    }

//    public function setCreatedAt(\DateTimeImmutable $created_at): self
//    {
//        $this->created_at = $created_at;
//
//        return $this;
//    }

    public function getActive(): ?bool
    {
        return $this->active;
    }

    public function setActive(bool $active): self
    {
        $this->active = $active;

        return $this;
    }

    public function getUsers(): ?Users
    {
        return $this->users;
    }

    public function setUsers(?Users $users): self
    {
        $this->users = $users;

        return $this;
    }

    public function getCategories(): ?Categories
    {
        return $this->categories;
    }

    public function setCategories(?Categories $categories): self
    {
        $this->categories = $categories;

        return $this;
    }
}
