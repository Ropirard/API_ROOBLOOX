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
}
