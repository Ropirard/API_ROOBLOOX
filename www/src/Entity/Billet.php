<?php

namespace App\Entity;

use App\Repository\BilletRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BilletRepository::class)]
class Billet
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $qrCode = null;

    #[ORM\Column]
    private ?\DateTime $validateDate = null;

    #[ORM\ManyToOne(inversedBy: 'billets')]
    private ?Order $orders = null;

    #[ORM\ManyToOne(inversedBy: 'billet')]
    private ?Pass $pass = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQrCode(): ?string
    {
        return $this->qrCode;
    }

    public function setQrCode(string $qrCode): static
    {
        $this->qrCode = $qrCode;

        return $this;
    }

    public function getValidateDate(): ?\DateTime
    {
        return $this->validateDate;
    }

    public function setValidateDate(\DateTime $validateDate): static
    {
        $this->validateDate = $validateDate;

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

    public function getPass(): ?Pass
    {
        return $this->pass;
    }

    public function setPass(?Pass $pass): static
    {
        $this->pass = $pass;

        return $this;
    }
}
