<?php

namespace App\Entity;

use App\Repository\CameraRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CameraRepository::class)]
class Camera
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $model = null;

    #[ORM\ManyToOne(inversedBy: 'cameras')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Brand $brand = null;

    #[ORM\Column]
    private ?float $price = null;

    #[ORM\Column]
    private ?int $megapixels = null;

    #[ORM\Column(length: 50)]
    private ?string $sensorType = null;

    #[ORM\Column]
    private ?bool $isWeatherSealed = null;

    #[ORM\Column]
    private ?int $releaseYear = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $features = null;

    #[ORM\Column]
    private ?int $stockQuantity = null;

    /**
     * @var Collection<int, Purchase>
     */
    #[ORM\OneToMany(targetEntity: Purchase::class, mappedBy: 'camera')]
    private Collection $purchases;

    public function __construct()
    {
        $this->purchases = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getModel(): ?string
    {
        return $this->model;
    }

    public function setModel(string $model): static
    {
        $this->model = $model;

        return $this;
    }

    public function getBrand(): ?Brand
    {
        return $this->brand;
    }

    public function setBrand(?Brand $brand): static
    {
        $this->brand = $brand;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): static
    {
        $this->price = $price;

        return $this;
    }

    public function getMegapixels(): ?int
    {
        return $this->megapixels;
    }

    public function setMegapixels(int $megapixels): static
    {
        $this->megapixels = $megapixels;

        return $this;
    }

    public function getSensorType(): ?string
    {
        return $this->sensorType;
    }

    public function setSensorType(string $sensorType): static
    {
        $this->sensorType = $sensorType;

        return $this;
    }

    public function isWeatherSealed(): ?bool
    {
        return $this->isWeatherSealed;
    }

    public function setIsWeatherSealed(bool $isWeatherSealed): static
    {
        $this->isWeatherSealed = $isWeatherSealed;

        return $this;
    }

    public function getReleaseYear(): ?int
    {
        return $this->releaseYear;
    }

    public function setReleaseYear(int $releaseYear): static
    {
        $this->releaseYear = $releaseYear;

        return $this;
    }

    public function getFeatures(): ?string
    {
        return $this->features;
    }

    public function setFeatures(?string $features): static
    {
        $this->features = $features;

        return $this;
    }

    public function getStockQuantity(): ?int
    {
        return $this->stockQuantity;
    }

    public function setStockQuantity(int $stockQuantity): static
    {
        $this->stockQuantity = $stockQuantity;

        return $this;
    }

    /**
     * @return Collection<int, Purchase>
     */
    public function getPurchases(): Collection
    {
        return $this->purchases;
    }

    public function addPurchase(Purchase $purchase): static
    {
        if (!$this->purchases->contains($purchase)) {
            $this->purchases->add($purchase);
            $purchase->setCamera($this);
        }

        return $this;
    }

    public function removePurchase(Purchase $purchase): static
    {
        if ($this->purchases->removeElement($purchase)) {
            // set the owning side to null (unless already changed)
            if ($purchase->getCamera() === $this) {
                $purchase->setCamera(null);
            }
        }

        return $this;
    }
}
