<?php

namespace App\Entity;

use App\Repository\AnimeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AnimeRepository::class)]
class Anime
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $image = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $synopsis = null;

    #[ORM\Column(nullable: true)]
    private ?float $note = null;

    #[ORM\Column]
    private ?int $nombreEpisodes = null;

    #[ORM\ManyToOne(inversedBy: 'animes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Genre $genre = null;

    #[ORM\ManyToOne(inversedBy: 'animes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Type $type = null;

    #[ORM\ManyToOne(inversedBy: 'animes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Mangaka $mangaka = null;

    #[ORM\OneToMany(mappedBy: 'anime', targetEntity: Statut::class, orphanRemoval: true)]
    private Collection $statuts;

    #[ORM\OneToMany(mappedBy: 'anime', targetEntity: Avis::class, orphanRemoval: true)]
    private Collection $avis;

    #[ORM\Column(length: 255)]
    private ?string $imageDetails = null;

    public function __construct()
    {
        $this->statuts = new ArrayCollection();
        $this->avis = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getSynopsis(): ?string
    {
        return $this->synopsis;
    }

    public function setSynopsis(string $synopsis): self
    {
        $this->synopsis = $synopsis;

        return $this;
    }

    public function getNote(): ?float
    {
        return $this->note;
    }

    public function setNote(?float $note): self
    {
        $this->note = $note;

        return $this;
    }

    public function getNombreEpisodes(): ?int
    {
        return $this->nombreEpisodes;
    }

    public function setNombreEpisodes(int $nombreEpisodes): self
    {
        $this->nombreEpisodes = $nombreEpisodes;

        return $this;
    }

    public function getGenre(): ?Genre
    {
        return $this->genre;
    }

    public function setGenre(?Genre $genre): self
    {
        $this->genre = $genre;

        return $this;
    }

    public function getType(): ?Type
    {
        return $this->type;
    }

    public function setType(?Type $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getMangaka(): ?Mangaka
    {
        return $this->mangaka;
    }

    public function setMangaka(?Mangaka $mangaka): self
    {
        $this->mangaka = $mangaka;

        return $this;
    }

    /**
     * @return Collection<int, Statut>
     */
    public function getStatuts(): Collection
    {
        return $this->statuts;
    }

    public function addStatut(Statut $statut): self
    {
        if (!$this->statuts->contains($statut)) {
            $this->statuts->add($statut);
            $statut->setAnime($this);
        }

        return $this;
    }

    public function removeStatut(Statut $statut): self
    {
        if ($this->statuts->removeElement($statut)) {
            // set the owning side to null (unless already changed)
            if ($statut->getAnime() === $this) {
                $statut->setAnime(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Avis>
     */
    public function getAvis(): Collection
    {
        return $this->avis;
    }

    public function addAvi(Avis $avi): self
    {
        if (!$this->avis->contains($avi)) {
            $this->avis->add($avi);
            $avi->setAnime($this);
        }

        return $this;
    }

    public function removeAvi(Avis $avi): self
    {
        if ($this->avis->removeElement($avi)) {
            // set the owning side to null (unless already changed)
            if ($avi->getAnime() === $this) {
                $avi->setAnime(null);
            }
        }

        return $this;
    }

    public function getImageDetails(): ?string
    {
        return $this->imageDetails;
    }

    public function setImageDetails(string $imageDetails): self
    {
        $this->imageDetails = $imageDetails;

        return $this;
    }
}
