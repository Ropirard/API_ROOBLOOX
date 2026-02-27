<?php

namespace App\Entity;

use App\Repository\OrderRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OrderRepository::class)]
#[ORM\Table(name: '`order`')]
class Order
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTime $startDate = null;

    #[ORM\Column]
    private ?int $nbPeople = null;

    #[ORM\Column]
    private ?int $totalPriceScreenshot = null;

    #[ORM\Column]
    private ?\DateTime $purchaseDate = null;

    #[ORM\Column(length: 50)]
    private ?string $reference = null;

    /**
     * @var Collection<int, Pass>
     */
    #[ORM\ManyToMany(targetEntity: Pass::class)]
    #[ORM\JoinTable(name: "order_pass")]
    #[ORM\JoinColumn(onDelete: "CASCADE")]
    private Collection $pass;

    #[ORM\ManyToOne(inversedBy: 'orders')]
    private ?User $user = null;

    #[ORM\ManyToOne(inversedBy: 'orders')]
    private ?Pack $pack = null;

    #[ORM\ManyToOne(inversedBy: 'orders')]
    private ?Bundle $bundle = null;

    /**
     * @var Collection<int, HotelReservation>
     */
    #[ORM\OneToMany(targetEntity: HotelReservation::class, mappedBy: 'orders')]
    private Collection $hotelReservations;

    public function __construct()
    {
        $this->pass = new ArrayCollection();
        $this->hotelReservations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getNbPeople(): ?int
    {
        return $this->nbPeople;
    }

    public function setNbPeople(int $nbPeople): static
    {
        $this->nbPeople = $nbPeople;

        return $this;
    }

    public function getTotalPriceScreenshot(): ?int
    {
        return $this->totalPriceScreenshot;
    }

    public function setTotalPriceScreenshot(int $totalPriceScreenshot): static
    {
        $this->totalPriceScreenshot = $totalPriceScreenshot;

        return $this;
    }

    public function getPurchaseDate(): ?\DateTime
    {
        return $this->purchaseDate;
    }

    public function setPurchaseDate(\DateTime $purchaseDate): static
    {
        $this->purchaseDate = $purchaseDate;

        return $this;
    }

    public function getReference(): ?string
    {
        return $this->reference;
    }

    public function setReference(string $reference): static
    {
        $this->reference = $reference;

        return $this;
    }

    /**
     * @return Collection<int, Pass>
     */
    public function getPass(): Collection
    {
        return $this->pass;
    }

    public function addPass(Pass $pass): static
    {
        if (!$this->pass->contains($pass)) {
            $this->pass->add($pass);
        }

        return $this;
    }

    public function removePass(Pass $pass): static
    {
        $this->pass->removeElement($pass);

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

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

    public function getBundle(): ?Bundle
    {
        return $this->bundle;
    }

    public function setBundle(?Bundle $bundle): static
    {
        $this->bundle = $bundle;

        return $this;
    }

    /**
     * @return Collection<int, HotelReservation>
     */
    public function getHotelReservations(): Collection
    {
        return $this->hotelReservations;
    }

    public function addHotelReservation(HotelReservation $hotelReservation): static
    {
        if (!$this->hotelReservations->contains($hotelReservation)) {
            $this->hotelReservations->add($hotelReservation);
            $hotelReservation->setOrders($this);
        }

        return $this;
    }

    public function removeHotelReservation(HotelReservation $hotelReservation): static
    {
        if ($this->hotelReservations->removeElement($hotelReservation)) {
            // set the owning side to null (unless already changed)
            if ($hotelReservation->getOrders() === $this) {
                $hotelReservation->setOrders(null);
            }
        }

        return $this;
    }
}
