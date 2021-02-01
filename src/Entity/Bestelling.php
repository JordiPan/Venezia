<?php

namespace App\Entity;

use App\Repository\BestellingRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=BestellingRepository::class)
 */
class Bestelling
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
    private $klant;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $telefoonnummer;

    /**
     * @ORM\Column(type="date")
     */
    private $afhaaldatum;

    /**
     * @ORM\OneToMany(targetEntity=Bestellingsregel::class, mappedBy="bestelling", orphanRemoval=true)
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

    public function getKlant(): ?string
    {
        return $this->klant;
    }

    public function setKlant(string $klant): self
    {
        $this->klant = $klant;

        return $this;
    }

    public function getTelefoonnummer(): ?string
    {
        return $this->telefoonnummer;
    }

    public function setTelefoonnummer(string $telefoonnummer): self
    {
        $this->telefoonnummer = $telefoonnummer;

        return $this;
    }

    public function getAfhaaldatum(): ?\DateTimeInterface
    {
        return $this->afhaaldatum;
    }

    public function setAfhaaldatum(\DateTimeInterface $afhaaldatum): self
    {
        $this->afhaaldatum = $afhaaldatum;

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
            $bestellingsregel->setBestelling($this);
        }

        return $this;
    }

    public function removeBestellingsregel(Bestellingsregel $bestellingsregel): self
    {
        if ($this->bestellingsregels->removeElement($bestellingsregel)) {
            // set the owning side to null (unless already changed)
            if ($bestellingsregel->getBestelling() === $this) {
                $bestellingsregel->setBestelling(null);
            }
        }

        return $this;
    }
}
