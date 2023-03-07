<?php

namespace App\Entity;

use App\Repository\StatutRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StatutRepository::class)]
class Statut
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?bool $favoris = null;


    #[ORM\OneToMany(mappedBy: 'statut', targetEntity: Anime::class)]
    private Collection $idAnime;

    #[ORM\ManyToOne(inversedBy: 'statuts')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    #[ORM\ManyToOne(inversedBy: 'statuts')]
    #[ORM\JoinColumn(nullable: false)]
    private ?StatutType $statut_type = null;

    #[ORM\ManyToOne(inversedBy: 'statuts')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Anime $anime = null;

    public function __construct()
    {
        $this->idAnime = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function isFavoris(): ?bool
    {
        return $this->favoris;
    }

    public function setFavoris(bool $favoris): self
    {
        $this->favoris = $favoris;

        return $this;
    }

    /**
     * @return Collection<int, Anime>
     */
    public function getIdAnime(): Collection
    {
        return $this->idAnime;
    }

    /**
     * @return Collection<int, StatutType>
     */

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getStatutType(): ?StatutType
    {
        return $this->statut_type;
    }

    public function setStatutType(?StatutType $statut_type): self
    {
        $this->statut_type = $statut_type;

        return $this;
    }

    public function getAnime(): ?Anime
    {
        return $this->anime;
    }

    public function setAnime(?Anime $anime): self
    {
        $this->anime = $anime;

        return $this;
    }
}
