<?php

namespace App\Entity;

use App\Repository\StageRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=StageRepository::class)
 */
class Stage
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
    private $titre;

    /**
     * @ORM\Column(type="string", length=200)
     */
    private $descMissions;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $emailContact;

    /**
     * @ORM\ManyToOne(targetEntity=Entreprise::class, inversedBy="listeStage")
     * @ORM\JoinColumn(nullable=false)
     */
    private $codeEntreprise;

    /**
     * @ORM\ManyToMany(targetEntity=Formation::class, inversedBy="listeStage")
     */
    private $ormation;

    public function __construct()
    {
        $this->ormation = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getDescMissions(): ?string
    {
        return $this->descMissions;
    }

    public function setDescMissions(string $descMissions): self
    {
        $this->descMissions = $descMissions;

        return $this;
    }

    public function getEmailContact(): ?string
    {
        return $this->emailContact;
    }

    public function setEmailContact(string $emailContact): self
    {
        $this->emailContact = $emailContact;

        return $this;
    }

    public function getCodeEntreprise(): ?Entreprise
    {
        return $this->codeEntreprise;
    }

    public function setCodeEntreprise(?Entreprise $codeEntreprise): self
    {
        $this->codeEntreprise = $codeEntreprise;

        return $this;
    }

    /**
     * @return Collection|Formation[]
     */
    public function getOrmation(): Collection
    {
        return $this->ormation;
    }

    public function addOrmation(Formation $ormation): self
    {
        if (!$this->ormation->contains($ormation)) {
            $this->ormation[] = $ormation;
        }

        return $this;
    }

    public function removeOrmation(Formation $ormation): self
    {
        $this->ormation->removeElement($ormation);

        return $this;
    }
}
