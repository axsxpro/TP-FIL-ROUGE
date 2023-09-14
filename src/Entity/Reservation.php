<?php

namespace App\Entity;

use App\Repository\ReservationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ReservationRepository::class)]
class Reservation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $DateReservation = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $DateEntree = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $DateSortie = null;

    #[ORM\OneToMany(mappedBy: 'reservation', targetEntity: ReservationChambre::class)]
    private Collection $reservationChambres;

    #[ORM\ManyToOne(inversedBy: 'user')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    public function __construct()
    {
        $this->reservationChambres = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateReservation(): ?\DateTimeInterface
    {
        return $this->DateReservation;
    }

    public function setDateReservation(\DateTimeInterface $DateReservation): static
    {
        $this->DateReservation = $DateReservation;

        return $this;
    }

    public function getDateEntree(): ?\DateTimeInterface
    {
        return $this->DateEntree;
    }

    public function setDateEntree(\DateTimeInterface $DateEntree): static
    {
        $this->DateEntree = $DateEntree;

        return $this;
    }

    public function getDateSortie(): ?\DateTimeInterface
    {
        return $this->DateSortie;
    }

    public function setDateSortie(\DateTimeInterface $DateSortie): static
    {
        $this->DateSortie = $DateSortie;

        return $this;
    }

    /**
     * @return Collection<int, ReservationChambre>
     */
    public function getReservationChambres(): Collection
    {
        return $this->reservationChambres;
    }

    public function addReservationChambre(ReservationChambre $reservationChambre): static
    {
        if (!$this->reservationChambres->contains($reservationChambre)) {
            $this->reservationChambres->add($reservationChambre);
            $reservationChambre->setReservation($this);
        }

        return $this;
    }

    public function removeReservationChambre(ReservationChambre $reservationChambre): static
    {
        if ($this->reservationChambres->removeElement($reservationChambre)) {
            // set the owning side to null (unless already changed)
            if ($reservationChambre->getReservation() === $this) {
                $reservationChambre->setReservation(null);
            }
        }

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
}
