<?php

namespace App\Entity;

use App\Repository\ReservationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ReservationRepository::class)]
class Reservation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?\DateTime $arrivalDate = null;

    #[ORM\Column]
    private ?\DateTime $departureDate = null;

    #[ORM\Column]
    private ?int $adultsNumber = null;

    #[ORM\Column]
    private ?int $childrenNumber = null;

    /**
     * @var Collection<int, Chamber>
     */
    #[ORM\ManyToMany(targetEntity: Chamber::class, inversedBy: 'reservations')]
    private Collection $chamber;

    #[ORM\ManyToOne(inversedBy: 'reservations')]
    private ?Order $orders = null;

    #[ORM\ManyToOne(inversedBy: 'reservations')]
    private ?Tarif $tarif = null;

    #[ORM\ManyToOne(inversedBy: 'reservations')]
    private ?User $user = null;

    public function __construct()
    {
        $this->chamber = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getArrivalDate(): ?\DateTime
    {
        return $this->arrivalDate;
    }

    public function setArrivalDate(\DateTime $arrivalDate): static
    {
        $this->arrivalDate = $arrivalDate;

        return $this;
    }

    public function getDepartureDate(): ?\DateTime
    {
        return $this->departureDate;
    }

    public function setDepartureDate(\DateTime $departureDate): static
    {
        $this->departureDate = $departureDate;

        return $this;
    }

    public function getAdultsNumber(): ?int
    {
        return $this->adultsNumber;
    }

    public function setAdultsNumber(int $adultsNumber): static
    {
        $this->adultsNumber = $adultsNumber;

        return $this;
    }

    public function getChildrenNumber(): ?int
    {
        return $this->childrenNumber;
    }

    public function setChildrenNumber(int $childrenNumber): static
    {
        $this->childrenNumber = $childrenNumber;

        return $this;
    }

    /**
     * @return Collection<int, Chamber>
     */
    public function getChamber(): Collection
    {
        return $this->chamber;
    }

    public function addChamber(Chamber $chamber): static
    {
        if (!$this->chamber->contains($chamber)) {
            $this->chamber->add($chamber);
        }

        return $this;
    }

    public function removeChamber(Chamber $chamber): static
    {
        $this->chamber->removeElement($chamber);

        return $this;
    }

    public function getOrders(): ?Order
    {
        return $this->orders;
    }

    public function setOrders(?Order $orders): static
    {
        $this->orders = $orders;

        return $this;
    }

    public function getTarif(): ?Tarif
    {
        return $this->tarif;
    }

    public function setTarif(?Tarif $tarif): static
    {
        $this->tarif = $tarif;

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
}
