<?php

namespace App\Entity;

use App\Repository\PackPriceRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PackPriceRepository::class)]
class PackPrice
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $pricePerPerson = null;

    #[ORM\ManyToOne(inversedBy: 'packPrices')]
    private ?Pack $pack = null;

    #[ORM\ManyToOne(inversedBy: 'packPrices')]
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

    public function getPack(): ?Pack
    {
        return $this->pack;
    }

    public function setPack(?Pack $pack): static
    {
        $this->pack = $pack;

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
