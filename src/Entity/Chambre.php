<?php

namespace App\Entity;

use App\Repository\ChambreRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ChambreRepository::class)]
class Chambre
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $tarif = null;

    #[ORM\Column(length: 255)]
    private ?string $superficie = null;

    #[ORM\Column]
    private ?int $vueSurMer = null;

    #[ORM\Column]
    private ?int $chaines_à_la_carte = null;

    #[ORM\Column]
    private ?int $climatisation = null;

    #[ORM\Column]
    private ?int $television_à_ecran_plat = null;

    #[ORM\Column]
    private ?int $telephone = null;

    #[ORM\Column]
    private ?int $chainesSatellite = null;

    #[ORM\Column]
    private ?int $chaines_duCable = null;

    #[ORM\Column]
    private ?int $coffreFort = null;

    #[ORM\Column]
    private ?int $materielDeRepassage = null;

    #[ORM\Column]
    private ?int $wifiGratuit = null;

    #[ORM\OneToMany(mappedBy: 'chambre', targetEntity: ReservationChambre::class)]
    private Collection $reservationChambres;

    #[ORM\ManyToOne(inversedBy: 'categorie')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Categorie $categorie = null;

    #[ORM\Column]
    private ?bool $etat = null;

  

    public function __construct()
    {
        $this->reservationChambres = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTarif(): ?int
    {
        return $this->tarif;
    }

    public function setTarif(int $tarif): static
    {
        $this->tarif = $tarif;

        return $this;
    }

    public function getSuperficie(): ?string
    {
        return $this->superficie;
    }

    public function setSuperficie(string $superficie): static
    {
        $this->superficie = $superficie;

        return $this;
    }

    public function getVueSurMer(): ?int
    {
        return $this->vueSurMer;
    }

    public function setVueSurMer(int $vueSurMer): static
    {
        $this->vueSurMer = $vueSurMer;

        return $this;
    }

    public function getChainesàLaCarte(): ?int
    {
        return $this->chaines_à_la_carte;
    }

    public function setChainesàLaCarte(int $chaines_à_la_carte): static
    {
        $this->chaines_à_la_carte = $chaines_à_la_carte;

        return $this;
    }

    public function getClimatisation(): ?int
    {
        return $this->climatisation;
    }

    public function setClimatisation(int $climatisation): static
    {
        $this->climatisation = $climatisation;

        return $this;
    }

    public function getTelevisionàEcranPlat(): ?int
    {
        return $this->television_à_ecran_plat;
    }

    public function setTelevisionàEcranPlat(int $television_à_ecran_plat): static
    {
        $this->television_à_ecran_plat = $television_à_ecran_plat;

        return $this;
    }

    public function getTelephone(): ?int
    {
        return $this->telephone;
    }

    public function setTelephone(int $telephone): static
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getChainesSatellite(): ?int
    {
        return $this->chainesSatellite;
    }

    public function setChainesSatellite(int $chainesSatellite): static
    {
        $this->chainesSatellite = $chainesSatellite;

        return $this;
    }

    public function getChainesDuCable(): ?int
    {
        return $this->chaines_duCable;
    }

    public function setChainesDuCable(int $chaines_duCable): static
    {
        $this->chaines_duCable = $chaines_duCable;

        return $this;
    }

    public function getCoffreFort(): ?int
    {
        return $this->coffreFort;
    }

    public function setCoffreFort(int $coffreFort): static
    {
        $this->coffreFort = $coffreFort;

        return $this;
    }

    public function getMaterielDeRepassage(): ?int
    {
        return $this->materielDeRepassage;
    }

    public function setMaterielDeRepassage(int $materielDeRepassage): static
    {
        $this->materielDeRepassage = $materielDeRepassage;

        return $this;
    }

    public function getWifiGratuit(): ?int
    {
        return $this->wifiGratuit;
    }

    public function setWifiGratuit(int $wifiGratuit): static
    {
        $this->wifiGratuit = $wifiGratuit;

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
            $reservationChambre->setChambre($this);
        }

        return $this;
    }

    public function removeReservationChambre(ReservationChambre $reservationChambre): static
    {
        if ($this->reservationChambres->removeElement($reservationChambre)) {
            // set the owning side to null (unless already changed)
            if ($reservationChambre->getChambre() === $this) {
                $reservationChambre->setChambre(null);
            }
        }

        return $this;
    }

    public function getCategorie(): ?Categorie
    {
        return $this->categorie;
    }

    public function setCategorie(?Categorie $categorie): static
    {
        $this->categorie = $categorie;

        return $this;
    }

    public function isEtat(): ?bool
    {
        return $this->etat;
    }

    public function setEtat(bool $etat): static
    {
        $this->etat = $etat;

        return $this;
    }

   
    

    }
