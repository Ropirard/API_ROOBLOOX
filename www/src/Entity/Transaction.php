<?php

namespace App\Entity;

use App\Repository\TransactionRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TransactionRepository::class)]
class Transaction
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(nullable: true)]
    private ?int $realMoneyAmount = null;

    #[ORM\Column(nullable: true)]
    private ?int $virtualCurrencyAmount = null;

    #[ORM\Column]
    private ?\DateTime $createdAt = null;

    #[ORM\Column(length: 30)]
    private ?string $type = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRealMoneyAmount(): ?int
    {
        return $this->realMoneyAmount;
    }

    public function setRealMoneyAmount(?int $realMoneyAmount): static
    {
        $this->realMoneyAmount = $realMoneyAmount;

        return $this;
    }

    public function getVirtualCurrencyAmount(): ?int
    {
        return $this->virtualCurrencyAmount;
    }

    public function setVirtualCurrencyAmount(?int $virtualCurrencyAmount): static
    {
        $this->virtualCurrencyAmount = $virtualCurrencyAmount;

        return $this;
    }

    public function getCreatedAt(): ?\DateTime
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTime $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): static
    {
        $this->type = $type;

        return $this;
    }
}
