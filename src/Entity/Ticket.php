<?php

namespace App\Entity;

use App\Repository\TicketRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity(repositoryClass: TicketRepository::class)]
class Ticket
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $price = null;

    #[ORM\Column(type: 'string', name: 'ticket_key', nullable: true)] 
    private ?string $ticket_key = null;    

    #[ORM\Column]
    private ?int $quantity = null;

    #[ORM\Column]
    private ?string $plan = null;

    #[ORM\Column(type: 'string', nullable: true)]
    private ?string $QRcode = null;
    
    #[ORM\Column(type: 'datetime_immutable')]
    private \DateTimeImmutable $createdAt;

    #[ORM\Column(type: 'datetime_immutable')]
    private \DateTimeImmutable $updatedAt;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'tickets')]
    private ?User $user = null;

    #[ORM\ManyToOne(targetEntity: Offer::class, inversedBy: 'tickets')]
    private ?Offer $offer;

    public function __construct()
    {
        $this->updatedAt = new \DateTimeImmutable();
        $this->createdAt = new \DateTimeImmutable();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): static
    {
        $this->price = $price;

        return $this;
    }

    public function getTicketKey(): ?string
    {
        return $this->ticket_key;
    }

    public function setTicketKey(string $ticket_key): static
    {
         $this->ticket_key = $ticket_key;

        return $this;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setquantity(int $quantity): static
    {
        $this->quantity = $quantity;

        return $this;
    }


    public function getPlan(): ?string
    {
        return  $this->plan;
    }

    public function setPlan(string $plan)
    {
        $this->plan = $plan;

        return $this;
    }

    public function getQrcode(): ?string
    {
        return  $this->QRcode;
    }

    public function setQrcode(string $QRcode)
    {
        $this->QRcode = $QRcode;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }

    public function getCreatedAt(): \DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): \DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeImmutable $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

  
    public function getOffer(): ?Offer
    {
        return $this->offer;
    }

    public function setOffer(?Offer $offer): static
    {
        $this->offer = $offer;

        return $this;
    }
}
