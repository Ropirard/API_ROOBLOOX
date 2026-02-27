<?php

namespace App\Entity;

use App\Repository\ChamberTypeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ChamberTypeRepository::class)]
class ChamberType
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
    private ?int $nightlyPrice = null;

    #[ORM\Column]
    private ?int $capacity = null;

    /**
     * @var Collection<int, Bundle>
     */
    #[ORM\OneToMany(targetEntity: Bundle::class, mappedBy: 'typeChamber')]
    private Collection $bundles;

    /**
     * @var Collection<int, Chamber>
     */
    #[ORM\OneToMany(targetEntity: Chamber::class, mappedBy: 'typeChamber')]
    private Collection $chambers;

    public function __construct()
    {
        $this->bundles = new ArrayCollection();
        $this->chambers = new ArrayCollection();
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

    public function getNightlyPrice(): ?int
    {
        return $this->nightlyPrice;
    }

    public function setNightlyPrice(int $nightlyPrice): static
    {
        $this->nightlyPrice = $nightlyPrice;

        return $this;
    }

    public function getCapacity(): ?int
    {
        return $this->capacity;
    }

    public function setCapacity(int $capacity): static
    {
        $this->capacity = $capacity;

        return $this;
    }

    /**
     * @return Collection<int, Bundle>
     */
    public function getBundles(): Collection
    {
        return $this->bundles;
    }

    public function addBundle(Bundle $bundle): static
    {
        if (!$this->bundles->contains($bundle)) {
            $this->bundles->add($bundle);
            $bundle->setTypeChamber($this);
        }

        return $this;
    }

    public function removeBundle(Bundle $bundle): static
    {
        if ($this->bundles->removeElement($bundle)) {
            // set the owning side to null (unless already changed)
            if ($bundle->getTypeChamber() === $this) {
                $bundle->setTypeChamber(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Chamber>
     */
    public function getChambers(): Collection
    {
        return $this->chambers;
    }

    public function addChamber(Chamber $chamber): static
    {
        if (!$this->chambers->contains($chamber)) {
            $this->chambers->add($chamber);
            $chamber->setTypeChamber($this);
        }

        return $this;
    }

    public function removeChamber(Chamber $chamber): static
    {
        if ($this->chambers->removeElement($chamber)) {
            // set the owning side to null (unless already changed)
            if ($chamber->getTypeChamber() === $this) {
                $chamber->setTypeChamber(null);
            }
        }

        return $this;
    }
}
