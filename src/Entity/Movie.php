<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Movie
 *
 * @ORM\Table(name="movie")
 * @ORM\Entity(repositoryClass="App\Repository\MovieRepository")
 */
class Movie
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255, nullable=false)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="image", type="string", length=20, nullable=false)
     */
    private $image;

    /**
     * @var int
     *
     * @ORM\Column(name="year", type="integer", nullable=false)
     */
    private $year;

    /**
     * @var string
     *
     * @ORM\Column(name="genres", type="string", length=255, nullable=false)
     */
    private $genres;

    /**
     * @var string
     *
     * @ORM\Column(name="actors", type="string", length=255, nullable=false)
     */
    private $actors;

    /**
     * @var string
     *
     * @ORM\Column(name="directors", type="string", length=255, nullable=false)
     */
    private $directors;

    /**
     * @var string
     *
     * @ORM\Column(name="plot", type="text", length=65535, nullable=false)
     */
    private $plot;

    /**
     * @var float
     *
     * @ORM\Column(name="rating", type="float", precision=2, scale=1, nullable=false)
     */
    private $rating;

    /**
     * @var int
     *
     * @ORM\Column(name="runtime", type="integer", nullable=false)
     */
    private $runtime;

    /**
     * @var string|null
     *
     * @ORM\Column(name="trailer_id", type="string", length=100, nullable=true)
     */
    private $trailerId;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_created", type="datetime", nullable=false)
     */
    private $dateCreated;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\WatchListItem", mappedBy="movie")
     */
    private $watchListItems;

    public function __construct()
    {
        $this->watchListItems = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

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

    public function getYear(): ?int
    {
        return $this->year;
    }

    public function setYear(int $year): self
    {
        $this->year = $year;

        return $this;
    }

    public function getGenres(): ?string
    {
        return $this->genres;
    }

    public function setGenres(string $genres): self
    {
        $this->genres = $genres;

        return $this;
    }

    public function getActors(): ?string
    {
        return $this->actors;
    }

    public function setActors(string $actors): self
    {
        $this->actors = $actors;

        return $this;
    }

    public function getDirectors(): ?string
    {
        return $this->directors;
    }

    public function setDirectors(string $directors): self
    {
        $this->directors = $directors;

        return $this;
    }

    public function getPlot(): ?string
    {
        return $this->plot;
    }

    public function setPlot(string $plot): self
    {
        $this->plot = $plot;

        return $this;
    }

    public function getRating(): ?float
    {
        return $this->rating;
    }

    public function setRating(float $rating): self
    {
        $this->rating = $rating;

        return $this;
    }

    public function getRuntime(): ?int
    {
        return $this->runtime;
    }

    public function setRuntime(int $runtime): self
    {
        $this->runtime = $runtime;

        return $this;
    }

    public function getTrailerId(): ?string
    {
        return $this->trailerId;
    }

    public function setTrailerId(?string $trailerId): self
    {
        $this->trailerId = $trailerId;

        return $this;
    }

    public function getDateCreated(): ?\DateTimeInterface
    {
        return $this->dateCreated;
    }

    public function setDateCreated(\DateTimeInterface $dateCreated): self
    {
        $this->dateCreated = $dateCreated;

        return $this;
    }

    /**
     * @return Collection|WatchListItem[]
     */
    public function getWatchListItems(): Collection
    {
        return $this->watchListItems;
    }

    public function addWatchListItem(WatchListItem $watchListItem): self
    {
        if (!$this->watchListItems->contains($watchListItem)) {
            $this->watchListItems[] = $watchListItem;
            $watchListItem->setMovie($this);
        }

        return $this;
    }

    public function removeWatchListItem(WatchListItem $watchListItem): self
    {
        if ($this->watchListItems->contains($watchListItem)) {
            $this->watchListItems->removeElement($watchListItem);
            // set the owning side to null (unless already changed)
            if ($watchListItem->getMovie() === $this) {
                $watchListItem->setMovie(null);
            }
        }

        return $this;
    }


}
