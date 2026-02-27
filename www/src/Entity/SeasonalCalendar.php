<?php

namespace App\Entity;

use App\Repository\SeasonalCalendarRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SeasonalCalendarRepository::class)]
class SeasonalCalendar
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $label = null;

    #[ORM\Column]
    private ?\DateTime $startDate = null;

    #[ORM\Column]
    private ?\DateTime $endDate = null;

    /**
     * @var Collection<int, PackPrice>
     */
    #[ORM\OneToMany(targetEntity: PackPrice::class, mappedBy: 'season')]
    private Collection $packPrices;

    /**
     * @var Collection<int, BundlePrice>
     */
    #[ORM\OneToMany(targetEntity: BundlePrice::class, mappedBy: 'season')]
    private Collection $bundlePrices;

    public function __construct()
    {
        $this->packPrices = new ArrayCollection();
        $this->bundlePrices = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(string $label): static
    {
        $this->label = $label;

        return $this;
    }

    public function getStartDate(): ?\DateTime
    {
        return $this->startDate;
    }

    public function setStartDate(\DateTime $startDate): static
    {
        $this->startDate = $startDate;

        return $this;
    }

    public function getEndDate(): ?\DateTime
    {
        return $this->endDate;
    }

    public function setEndDate(\DateTime $endDate): static
    {
        $this->endDate = $endDate;

        return $this;
    }

    /**
     * @return Collection<int, PackPrice>
     */
    public function getPackPrices(): Collection
    {
        return $this->packPrices;
    }

    public function addPackPrice(PackPrice $packPrice): static
    {
        if (!$this->packPrices->contains($packPrice)) {
            $this->packPrices->add($packPrice);
            $packPrice->setSeason($this);
        }

        return $this;
    }

    public function removePackPrice(PackPrice $packPrice): static
    {
        if ($this->packPrices->removeElement($packPrice)) {
            // set the owning side to null (unless already changed)
            if ($packPrice->getSeason() === $this) {
                $packPrice->setSeason(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, BundlePrice>
     */
    public function getBundlePrices(): Collection
    {
        return $this->bundlePrices;
    }

    public function addBundlePrice(BundlePrice $bundlePrice): static
    {
        if (!$this->bundlePrices->contains($bundlePrice)) {
            $this->bundlePrices->add($bundlePrice);
            $bundlePrice->setSeason($this);
        }

        return $this;
    }

    public function removeBundlePrice(BundlePrice $bundlePrice): static
    {
        if ($this->bundlePrices->removeElement($bundlePrice)) {
            // set the owning side to null (unless already changed)
            if ($bundlePrice->getSeason() === $this) {
                $bundlePrice->setSeason(null);
            }
        }

        return $this;
    }
}
