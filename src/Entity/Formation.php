<?php

namespace App\Entity;

use App\Repository\FormationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FormationRepository::class)
 */
class Formation
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
    private $nomLong;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $nomCourt;

    /**
     * @ORM\ManyToMany(targetEntity=Stage::class, mappedBy="ormation")
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

    public function getNomLong(): ?string
    {
        return $this->nomLong;
    }

    public function setNomLong(string $nomLong): self
    {
        $this->nomLong = $nomLong;

        return $this;
    }

    public function getNomCourt(): ?string
    {
        return $this->nomCourt;
    }

    public function setNomCourt(string $nomCourt): self
    {
        $this->nomCourt = $nomCourt;

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
            $listeStage->addOrmation($this);
        }

        return $this;
    }

    public function removeListeStage(Stage $listeStage): self
    {
        if ($this->listeStage->removeElement($listeStage)) {
            $listeStage->removeOrmation($this);
        }

        return $this;
    }
}
