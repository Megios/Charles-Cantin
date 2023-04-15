<?php

namespace App\Entity;

use App\Repository\ContactRepository;
use DateTimeImmutable;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ContactRepository::class)]
class Contact
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private int $id;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message:'Votre nom doit être renseigné')]
    private string $name;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message:'Votre prénom doit être renseigné')]
    private string $firstname;

    #[ORM\Column(length: 255)]
    #[Assert\Email(message:'Pas le bon format')]
    private string $email;

    #[ORM\Column(type: Types::TEXT)]
    #[Assert\NotBlank(message:'Le message de contact ne peut être vide')]
    private string $message;

    #[ORM\Column]
    private bool $isRead;

    #[ORM\Column]
    private ?\DateTimeImmutable $sendAt ;

    public function __construct()
    {
        $this->sendAt= new DateTimeImmutable();
        $this->isRead= false;

    }
    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getFirstname(): string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    public function setMessage(string $message): self
    {
        $this->message = $message;

        return $this;
    }

    public function isIsRead(): bool
    {
        return $this->isRead;
    }

    public function setIsRead(bool $isRead): self
    {
        $this->isRead = $isRead;

        return $this;
    }

    public function getSendAt(): ?\DateTimeImmutable
    {
    return $this->sendAt;
    }
    public function afficheSendAt(): ?string
    {

    return date_format($this->sendAt,'d/m/Y: g:i::s');
    }
}
