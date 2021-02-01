<?php

namespace App\Entity;

use App\Repository\BestellingsregelRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=BestellingsregelRepository::class)
 */
class Bestellingsregel
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $aantal;

    /**
     * @ORM\ManyToOne(targetEntity=Recept::class, inversedBy="bestellingsregels")
     * @ORM\JoinColumn(nullable=false)
     */
    private $recept;

    /**
     * @ORM\ManyToOne(targetEntity=Bestelling::class, inversedBy="bestellingsregels")
     * @ORM\JoinColumn(nullable=false)
     */
    private $bestelling;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAantal(): ?int
    {
        return $this->aantal;
    }

    public function setAantal(int $aantal): self
    {
        $this->aantal = $aantal;

        return $this;
    }

    public function getRecept(): ?Recept
    {
        return $this->recept;
    }

    public function setRecept(?Recept $recept): self
    {
        $this->recept = $recept;

        return $this;
    }

    public function getBestelling(): ?Bestelling
    {
        return $this->bestelling;
    }

    public function setBestelling(?Bestelling $bestelling): self
    {
        $this->bestelling = $bestelling;

        return $this;
    }
}
