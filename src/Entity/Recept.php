<?php

namespace App\Entity;

use App\Repository\ReceptRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ReceptRepository::class)
 */
class Recept
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $naam;

    /**
     * @ORM\Column(type="float")
     */
    private $prijs_per_liter;

    /**
     * @ORM\Column(type="text")
     */
    private $bereidingswijze;

    /**
     * @ORM\OneToOne(targetEntity=Fruit::class, inversedBy="recept", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $fruit;

    /**
     * @ORM\OneToMany(targetEntity=Bestellingsregel::class, mappedBy="recept", orphanRemoval=true)
     */
    private $bestellingsregels;

    public function __construct()
    {
        $this->bestellingsregels = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNaam(): ?string
    {
        return $this->naam;
    }

    public function setNaam(string $naam): self
    {
        $this->naam = $naam;

        return $this;
    }

    public function getPrijsPerLiter(): ?float
    {
        return $this->prijs_per_liter;
    }

    public function setPrijsPerLiter(float $prijs_per_liter): self
    {
        $this->prijs_per_liter = $prijs_per_liter;

        return $this;
    }

    public function getBereidingswijze(): ?string
    {
        return $this->bereidingswijze;
    }

    public function setBereidingswijze(string $bereidingswijze): self
    {
        $this->bereidingswijze = $bereidingswijze;

        return $this;
    }

    public function getFruit(): ?Fruit
    {
        return $this->fruit;
    }

    public function setFruit(Fruit $fruit): self
    {
        $this->fruit = $fruit;

        return $this;
    }

    /**
     * @return Collection|Bestellingsregel[]
     */
    public function getBestellingsregels(): Collection
    {
        return $this->bestellingsregels;
    }

    public function addBestellingsregel(Bestellingsregel $bestellingsregel): self
    {
        if (!$this->bestellingsregels->contains($bestellingsregel)) {
            $this->bestellingsregels[] = $bestellingsregel;
            $bestellingsregel->setRecept($this);
        }

        return $this;
    }

    public function removeBestellingsregel(Bestellingsregel $bestellingsregel): self
    {
        if ($this->bestellingsregels->removeElement($bestellingsregel)) {
            // set the owning side to null (unless already changed)
            if ($bestellingsregel->getRecept() === $this) {
                $bestellingsregel->setRecept(null);
            }
        }

        return $this;
    }
}
