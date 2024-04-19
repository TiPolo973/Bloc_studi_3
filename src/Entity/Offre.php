<?php

namespace App\Entity;

use App\Repository\OffreRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OffreRepository::class)]
class Offre
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $lieu = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $heure_and_date = null;

    #[ORM\Column]
    private ?int $forfait = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLieu(): ?string
    {
        return $this->lieu;
    }

    public function setLieu(string $lieu): static
    {
        $this->lieu = $lieu;

        return $this;
    }

    public function getHeureAndDate(): ?\DateTimeInterface
    {
        return $this->heure_and_date;
    }

    public function setHeureAndDate(\DateTimeInterface $heure_and_date): static
    {
        $this->heure_and_date = $heure_and_date;

        return $this;
    }

    public function getForfait(): ?int
    {
        return $this->forfait;
    }

    public function setForfait(int $forfait): static
    {
        $this->forfait = $forfait;

        return $this;
    }
}
