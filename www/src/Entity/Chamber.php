<?php

namespace App\Entity;

use App\Repository\ChamberRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ChamberRepository::class)]
class Chamber
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 20)]
    private ?string $number = null;

    #[ORM\Column]
    private ?bool $isAvailable = null;

    /**
     * @var Collection<int, HotelReservation>
     */
    #[ORM\OneToMany(targetEntity: HotelReservation::class, mappedBy: 'chamber')]
    private Collection $hotelReservations;

    #[ORM\ManyToOne(inversedBy: 'chambers')]
    private ?ChamberType $typeChamber = null;

    public function __construct()
    {
        $this->hotelReservations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumber(): ?string
    {
        return $this->number;
    }

    public function setNumber(string $number): static
    {
        $this->number = $number;

        return $this;
    }

    public function isAvailable(): ?bool
    {
        return $this->isAvailable;
    }

    public function setIsAvailable(bool $isAvailable): static
    {
        $this->isAvailable = $isAvailable;

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
            $hotelReservation->setChamber($this);
        }

        return $this;
    }

    public function removeHotelReservation(HotelReservation $hotelReservation): static
    {
        if ($this->hotelReservations->removeElement($hotelReservation)) {
            // set the owning side to null (unless already changed)
            if ($hotelReservation->getChamber() === $this) {
                $hotelReservation->setChamber(null);
            }
        }

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
}
