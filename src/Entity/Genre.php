<?php

namespace App\Entity;

use App\Repository\GenreRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GenreRepository::class)]
class Genre
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $label = null;

    #[ORM\OneToMany(mappedBy: 'genre_id', targetEntity: Anime::class)]
    private Collection $animes;

    public function __construct()
    {
        $this->animes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(string $label): self
    {
        $this->label = $label;

        return $this;
    }

    /**
     * @return Collection<int, Anime>
     */
    public function getAnimes(): Collection
    {
        return $this->animes;
    }

    public function addAnime(Anime $anime): self
    {
        if (!$this->animes->contains($anime)) {
            $this->animes->add($anime);
            $anime->setGenre($this);
        }

        return $this;
    }

    public function removeAnime(Anime $anime): self
    {
        if ($this->animes->removeElement($anime)) {
            // set the owning side to null (unless already changed)
            if ($anime->getGenre() === $this) {
                $anime->setGenre(null);
            }
        }

        return $this;
    }
}
