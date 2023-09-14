<?php

namespace App\Entity;

use App\Repository\ReservationChambreRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ReservationChambreRepository::class)]
class ReservationChambre
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $DateDeReservation = null;

    #[ORM\ManyToOne(inversedBy: 'reservationChambres')]
    private ?Chambre $chambre = null;

    #[ORM\ManyToOne(inversedBy: 'reservationChambres')]
    private ?Reservation $reservation = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateDeReservation(): ?\DateTimeInterface
    {
        return $this->DateDeReservation;
    }

    public function setDateDeReservation(\DateTimeInterface $DateDeReservation): static
    {
        $this->DateDeReservation = $DateDeReservation;

        return $this;
    }

    public function getChambre(): ?Chambre
    {
        return $this->chambre;
    }

    public function setChambre(?Chambre $chambre): static
    {
        $this->chambre = $chambre;

        return $this;
    }

    public function getReservation(): ?Reservation
    {
        return $this->reservation;
    }

    public function setReservation(?Reservation $reservation): static
    {
        $this->reservation = $reservation;

        return $this;
    }
}
