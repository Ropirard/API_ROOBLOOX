<?php

namespace App\Entity;

use App\Repository\BundleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BundleRepository::class)]
class Bundle
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $label = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\Column]
    private ?int $nbNights = null;

    #[ORM\ManyToOne(inversedBy: 'bundles')]
    private ?Pack $pack = null;

    #[ORM\ManyToOne(inversedBy: 'bundles')]
    private ?ChamberType $typeChamber = null;

    /**
     * @var Collection<int, Order>
     */
    #[ORM\OneToMany(targetEntity: Order::class, mappedBy: 'bundle')]
    private Collection $orders;

    /**
     * @var Collection<int, BundlePrice>
     */
    #[ORM\OneToMany(targetEntity: BundlePrice::class, mappedBy: 'bundle')]
    private Collection $bundlePrices;

    public function __construct()
    {
        $this->orders = new ArrayCollection();
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getNbNights(): ?int
    {
        return $this->nbNights;
    }

    public function setNbNights(int $nbNights): static
    {
        $this->nbNights = $nbNights;

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

    public function getTypeChamber(): ?ChamberType
    {
        return $this->typeChamber;
    }

    public function setTypeChamber(?ChamberType $typeChamber): static
    {
        $this->typeChamber = $typeChamber;

        return $this;
    }

    /**
     * @return Collection<int, Order>
     */
    public function getOrders(): Collection
    {
        return $this->orders;
    }

    public function addOrder(Order $order): static
    {
        if (!$this->orders->contains($order)) {
            $this->orders->add($order);
            $order->setBundle($this);
        }

        return $this;
    }

    public function removeOrder(Order $order): static
    {
        if ($this->orders->removeElement($order)) {
            // set the owning side to null (unless already changed)
            if ($order->getBundle() === $this) {
                $order->setBundle(null);
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
            $bundlePrice->setBundle($this);
        }

        return $this;
    }

    public function removeBundlePrice(BundlePrice $bundlePrice): static
    {
        if ($this->bundlePrices->removeElement($bundlePrice)) {
            // set the owning side to null (unless already changed)
            if ($bundlePrice->getBundle() === $this) {
                $bundlePrice->setBundle(null);
            }
        }

        return $this;
    }
}
