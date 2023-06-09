<?php

namespace App\Entity;

use App\Repository\StatutRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StatutRepository::class)]
class Statut
{

    #[ORM\Column]
    private ?bool $isFavoris = null;

    #[ORM\ManyToOne(inversedBy: 'statuts')]
    #[ORM\JoinColumn(nullable: false)]
    private ?StatutType $statutType = null;

    #[ORM\Id]
    #[ORM\ManyToOne(inversedBy: 'statuts')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    #[ORM\Id]
    #[ORM\ManyToOne(inversedBy: 'statuts')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Anime $anime = null;

    #[ORM\Column]
    private ?int $episodes_vus = null;

    public function isIsFavoris(): ?bool
    {
        return $this->isFavoris;
    }

    public function setIsFavoris(bool $isFavoris): self
    {
        $this->isFavoris = $isFavoris;

        return $this;
    }

    public function getStatutType(): ?StatutType
    {
        return $this->statutType;
    }

    public function setStatutType(?StatutType $statutType): self
    {
        $this->statutType = $statutType;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

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

    public function getEpisodesVus(): ?int
    {
        return $this->episodes_vus;
    }

    public function setEpisodesVus(int $episodes_vus): self
    {
        $this->episodes_vus = $episodes_vus;

        return $this;
    }
}
