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
    private ?string $chambreDoubleSuperieure = null;

    #[ORM\Column(length: 255)]
    private ?string $chambreDoubleDeluxe = null;

    #[ORM\Column(length: 255)]
    private ?string $suiteJunior = null;

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
        return $this->chambreDoubleSuperieure;
    }

    public function setChambreDoubleSuperieure(string $chambreDoubleSuperieure): static
    {
        $this->chambreDoubleSuperieure = $chambreDoubleSuperieure;

        return $this;
    }

    public function getChambreDoubleDeluxe(): ?string
    {
        return $this->chambreDoubleDeluxe;
    }

    public function setChambreDoubleDeluxe(string $chambreDoubleDeluxe): static
    {
        $this->chambreDoubleDeluxe = $chambreDoubleDeluxe;

        return $this;
    }

    public function getSuiteJunior(): ?string
    {
        return $this->suiteJunior;
    }

    public function setSuiteJunior(string $suiteJunior): static
    {
        $this->suiteJunior = $suiteJunior;

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
