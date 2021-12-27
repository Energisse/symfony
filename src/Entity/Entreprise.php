<?php

namespace App\Entity;

use App\Repository\EntrepriseRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EntrepriseRepository::class)
 */
class Entreprise
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $activite;

    /**
     * @ORM\Column(type="string", length=150)
     */
    private $adresse;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=150)
     */
    private $URLsite;

    /**
     * @ORM\OneToMany(targetEntity=Stage::class, mappedBy="codeEntreprise")
     */
    private $listeStage;

    public function __construct()
    {
        $this->listeStage = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getActivite(): ?string
    {
        return $this->activite;
    }

    public function setActivite(string $activite): self
    {
        $this->activite = $activite;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getURLsite(): ?string
    {
        return $this->URLsite;
    }

    public function setURLsite(string $URLsite): self
    {
        $this->URLsite = $URLsite;

        return $this;
    }

    /**
     * @return Collection|Stage[]
     */
    public function getListeStage(): Collection
    {
        return $this->listeStage;
    }

    public function addListeStage(Stage $listeStage): self
    {
        if (!$this->listeStage->contains($listeStage)) {
            $this->listeStage[] = $listeStage;
            $listeStage->setCodeEntreprise($this);
        }

        return $this;
    }

    public function removeListeStage(Stage $listeStage): self
    {
        if ($this->listeStage->removeElement($listeStage)) {
            // set the owning side to null (unless already changed)
            if ($listeStage->getCodeEntreprise() === $this) {
                $listeStage->setCodeEntreprise(null);
            }
        }

        return $this;
    }
}
