<?php

namespace App\Entity;

use App\Repository\OffreRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OffreRepository::class)]
class Offre
{

    #[ORM\Column(length: 255)]
    private string $Titre;

    #[ORM\Column(type: Types::TEXT)]
    private string $Description;

    #[ORM\Column]
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

    public function getTitre(): string
    {
        return $this->Titre;
    }

    public function setTitre(string $Titre): self
    {
        $this->Titre = $Titre;

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
