<?php

namespace App\Entity;

use App\Repository\CategorieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategorieRepository::class)]
class Categorie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $chambre_double_superieure = null;

    #[ORM\Column(length: 255)]
    private ?string $chambre_double_deluxe = null;

    #[ORM\Column(length: 255)]
    private ?string $suite_junior = null;

    #[ORM\OneToMany(mappedBy: 'categorie', targetEntity: Chambre::class)]
    private Collection $categorie;

    public function __construct()
    {
        $this->categorie = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getChambreDoubleSuperieure(): ?string
    {
        return $this->chambre_double_superieure;
    }

    public function setChambreDoubleSuperieure(string $chambre_double_superieure): static
    {
        $this->chambre_double_superieure = $chambre_double_superieure;

        return $this;
    }

    public function getChambreDoubleDeluxe(): ?string
    {
        return $this->chambre_double_deluxe;
    }

    public function setChambreDoubleDeluxe(string $chambre_double_deluxe): static
    {
        $this->chambre_double_deluxe = $chambre_double_deluxe;

        return $this;
    }

    public function getSuiteJunior(): ?string
    {
        return $this->suite_junior;
    }

    public function setSuiteJunior(string $suite_junior): static
    {
        $this->suite_junior = $suite_junior;

        return $this;
    }

    /**
     * @return Collection<int, Chambre>
     */
    public function getCategorie(): Collection
    {
        return $this->categorie;
    }

    public function addCategorie(Chambre $categorie): static
    {
        if (!$this->categorie->contains($categorie)) {
            $this->categorie->add($categorie);
            $categorie->setCategorie($this);
        }

        return $this;
    }

    public function removeCategorie(Chambre $categorie): static
    {
        if ($this->categorie->removeElement($categorie)) {
            // set the owning side to null (unless already changed)
            if ($categorie->getCategorie() === $this) {
                $categorie->setCategorie(null);
            }
        }

        return $this;
    }
}
