<?php

namespace App\Entity;

use App\Repository\CategoriesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

#[ORM\Entity(repositoryClass: CategoriesRepository::class)]
class Categories
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 100)]
    private $name;

//    #[Gedmo\Slug(fields: ('name'))]
//    #[ORM\Column(type: 'string', length: 255)]
//    private $slug;

    #[ORM\ManyToOne(targetEntity: self::class, inversedBy: 'categories')]
    private $parent;

    #[ORM\OneToMany(mappedBy: 'parent', targetEntity: self::class)]
    private $categories;

    #[ORM\OneToMany(mappedBy: 'categories', targetEntity: Annances::class)]
    private $annances;

    public function __construct()
    {
        $this->categories = new ArrayCollection();
        $this->annances = new ArrayCollection();
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

    public function getSlug(): ?string
    {
        return $this->slug;
    }



    public function getParent(): ?self
    {
        return $this->parent;
    }

    public function setParent(?self $parent): self
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * @return Collection|self[]
     */
    public function getCategories(): Collection
    {
        return $this->categories;
    }

    public function addCategory(self $category): self
    {
        if (!$this->categories->contains($category)) {
            $this->categories[] = $category;
            $category->setParent($this);
        }

        return $this;
    }

    public function removeCategory(self $category): self
    {
        if ($this->categories->removeElement($category)) {
            // set the owning side to null (unless already changed)
            if ($category->getParent() === $this) {
                $category->setParent(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Annances[]
     */
    public function getAnnances(): Collection
    {
        return $this->annances;
    }

    public function addAnnance(Annances $annance): self
    {
        if (!$this->annances->contains($annance)) {
            $this->annances[] = $annance;
            $annance->setCategories($this);
        }

        return $this;
    }

    public function removeAnnance(Annances $annance): self
    {
        if ($this->annances->removeElement($annance)) {
            // set the owning side to null (unless already changed)
            if ($annance->getCategories() === $this) {
                $annance->setCategories(null);
            }
        }

        return $this;
    }
}
