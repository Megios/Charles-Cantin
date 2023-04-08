<?php

namespace App\Entity;

use App\Repository\OffreRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: OffreRepository::class)]
class Offre
{

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: 'Le nom du produits ne peux pas être vide')]
    private string $Name;

    #[ORM\Column(type: Types::TEXT)]
    private string $Description;

    #[ORM\Column]
    #[Assert\Positive(message:'Le prix doit être positif')]
    private float $Prix;

    #[ORM\Column(type: Types::SMALLINT)]
    private int $Ordre;

    #[ORM\Id]
    #[ORM\Column(type: Types::GUID)]
    private string $uuid ;

    public function __construct()
    {
        $this->uuid=uniqid();
    }

    public function getName(): string
    {
        return $this->Name;
    }

    public function setName(string $name): self
    {
        $this->Name = $name;

        return $this;
    }

    public function getDescription(): string
    {
        return $this->Description;
    }

    public function setDescription(string $Description): self
    {
        $this->Description = $Description;

        return $this;
    }

    public function getPrix(): float
    {
        return $this->Prix;
    }
    public function affichePrix():String
    {
        return substr($this->Prix,0,-2) . ',' . substr($this->Prix,-2) . ' euros';
    }

    public function setPrix(float $Prix): self
    {
        $this->Prix = $Prix;

        return $this;
    }

    public function getOrdre(): int
    {
        return $this->Ordre;
    }

    public function setOrdre(int $Ordre): self
    {
        $this->Ordre = $Ordre;

        return $this;
    }

    public function getUuid(): string
    {
        return $this->uuid;
    }
}
