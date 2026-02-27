<?php

namespace App\Entity;

use App\Repository\BundlePriceRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BundlePriceRepository::class)]
class BundlePrice
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $pricePerPerson = null;

    #[ORM\ManyToOne(inversedBy: 'bundlePrices')]
    private ?Bundle $bundle = null;

    #[ORM\ManyToOne(inversedBy: 'bundlePrices')]
    private ?SeasonalCalendar $season = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPricePerPerson(): ?int
    {
        return $this->pricePerPerson;
    }

    public function setPricePerPerson(int $pricePerPerson): static
    {
        $this->pricePerPerson = $pricePerPerson;

        return $this;
    }

    public function getBundle(): ?Bundle
    {
        return $this->bundle;
    }

    public function setBundle(?Bundle $bundle): static
    {
        $this->bundle = $bundle;

        return $this;
    }

    public function getSeason(): ?SeasonalCalendar
    {
        return $this->season;
    }

    public function setSeason(?SeasonalCalendar $season): static
    {
        $this->season = $season;

        return $this;
    }
}
