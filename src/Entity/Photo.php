<?php

namespace App\Entity;

use App\Repository\PhotoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: PhotoRepository::class)]
class Photo
{

    #[ORM\Id]
    #[ORM\Column(type: Types::GUID)]
    private string $uuid;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message:'le titre de la photo ne peux pas être vide')]
    #[Assert\Length(max:250, maxMessage:'Le titre ne peux pas dépassez {{ limit }} caractères')]
    private string $titre;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message:'la photo est nécéssaire')]
    private string $source;

    #[ORM\Column(length: 255)]
    private string $type;

    #[ORM\ManyToMany(targetEntity: Categorie::class, inversedBy: 'photos')]
    #[ORM\JoinColumn(name:"photo_uuid", referencedColumnName:"uuid", onDelete:"CASCADE")]
    private Collection $categories;

    public function __construct()
    {
        $this->uuid= uniqid();
        $this->categories = new ArrayCollection();
    }

    public function getUuid(): string
    {
        return $this->uuid;
    }

    public function setUuid(string $uuid): self
    {
        $this->uuid = $uuid;

        return $this;
    }

    public function getTitre(): string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getSource(): string
    {
        return $this->source;
    }

    public function setSource(string $source): self
    {
        $this->source = $source;

        return $this;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return Collection<int, Categorie>
     */
    public function getCategories(): Collection
    {
        return $this->categories;
    }

    public function addCategory(Categorie $category): self
    {
        if (!$this->categories->contains($category)) {
            $this->categories->add($category);
        }

        return $this;
    }

    public function removeCategory(Categorie $category): self
    {
        $this->categories->removeElement($category);

        return $this;
    }
}
