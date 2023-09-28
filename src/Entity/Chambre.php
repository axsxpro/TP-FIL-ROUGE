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
    private ?int $chaine_à_LaCarte = null;

    #[ORM\Column]
    private ?int $climatisation = null;

    #[ORM\Column]
    private ?int $television_à_EcranPlat = null;

    #[ORM\Column]
    private ?int $telephone = null;

    #[ORM\Column]
    private ?int $chainesSatellite = null;

    #[ORM\Column]
    private ?int $chainesDuCable = null;

    #[ORM\Column]
    private ?int $coffreFort = null;

    #[ORM\Column]
    private ?int $materielDeRepassage = null;

    #[ORM\Column]
    private ?int $WifiGratuit = null;

    #[ORM\ManyToOne(inversedBy: 'categorie')]
    private ?Categorie $categorie = null;

    #[ORM\OneToMany(mappedBy: 'chambre', targetEntity: Reservation::class)]
    private Collection $chambre;

    public function __construct()
    {
        $this->chambre = new ArrayCollection();
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

    public function getChaineàLaCarte(): ?int
    {
        return $this->chaine_à_LaCarte;
    }

    public function setChaineàLaCarte(int $chaine_à_LaCarte): static
    {
        $this->chaine_à_LaCarte = $chaine_à_LaCarte;

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
        return $this->television_à_EcranPlat;
    }

    public function setTelevisionàEcranPlat(int $television_à_EcranPlat): static
    {
        $this->television_à_EcranPlat = $television_à_EcranPlat;

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
        return $this->chainesDuCable;
    }

    public function setChainesDuCable(int $chainesDuCable): static
    {
        $this->chainesDuCable = $chainesDuCable;

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
        return $this->WifiGratuit;
    }

    public function setWifiGratuit(int $WifiGratuit): static
    {
        $this->WifiGratuit = $WifiGratuit;

        return $this;
    }

   
    public function getCategorie(): ?Categorie
    {
        return $this->categorie;
    }

    /**
     * @return Collection<int, Reservation>
     */
    public function getChambre(): Collection
    {
        return $this->chambre;
    }

    public function addChambre(Reservation $chambre): static
    {
        if (!$this->chambre->contains($chambre)) {
            $this->chambre->add($chambre);
            $chambre->setChambre($this);
        }

        return $this;
    }

    public function removeChambre(Reservation $chambre): static
    {
        if ($this->chambre->removeElement($chambre)) {
            // set the owning side to null (unless already changed)
            if ($chambre->getChambre() === $this) {
                $chambre->setChambre(null);
            }
        }

        return $this;
    }

    
}
