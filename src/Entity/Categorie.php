<?php

namespace App\Entity;

use App\Repository\CategorieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategorieRepository::class)]
class Categorie
{
    
    #[ORM\Id]
    #[ORM\Column(type: Types::GUID)]
    private string $uuid;

    #[ORM\Column(length: 255)]
    private string $Nom;


    #[ORM\ManyToMany(targetEntity: Photo::class, mappedBy: 'categories')]
    private Collection $photos;

    public function __construct()
    {
        $this->uuid = uniqid();
        $this->photos = new ArrayCollection();
    }

    public function getNom(): string
    {
        return $this->Nom;
    }

    public function setNom(string $Nom): self
    {
        $this->Nom = $Nom;

        return $this;
    }

    public function getUuid(): string
    {
        return $this->uuid;
    }

    /**
     * @return Collection<int, Photo>
     */
    public function getPhotos(): Collection
    {
        return $this->photos;
    }

    public function addPhoto(Photo $photo): self
    {
        if (!$this->photos->contains($photo)) {
            $this->photos->add($photo);
            $photo->addCategory($this);
        }

        return $this;
    }

    public function removePhoto(Photo $photo): self
    {
        if ($this->photos->removeElement($photo)) {
            $photo->removeCategory($this);
        }

        return $this;
    }
}
