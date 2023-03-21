<?php

namespace App\Entity;

use App\Repository\ProduitRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProduitRepository::class)]
class Produit
{
    
    #[ORM\Id]
    #[ORM\Column(type: Types::GUID)]
    private string $uuid;
    
    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $Description = null;

    public function __construct()
    {
        $this->uuid = uniqid();
    }

    public function getUuid(): string
    {
        return $this->uuid;
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

    public function getDescription(): ?string
    {
        return $this->Description;
    }

    public function setDescription(?string $Description): self
    {
        $this->Description = $Description;

        return $this;
    }
}
