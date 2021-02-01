<?php

namespace App\Entity;

use App\Repository\FruitRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FruitRepository::class)
 */
class Fruit
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
     * @ORM\Column(type="string", length=255)
     */
    private $seizoen;

    /**
     * @ORM\OneToOne(targetEntity=Recept::class, mappedBy="fruit", cascade={"persist", "remove"})
     */
    private $recept;

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

    public function getSeizoen(): ?string
    {
        return $this->seizoen;
    }

    public function setSeizoen(string $seizoen): self
    {
        $this->seizoen = $seizoen;

        return $this;
    }

    public function getRecept(): ?Recept
    {
        return $this->recept;
    }

    public function setRecept(Recept $recept): self
    {
        // set the owning side of the relation if necessary
        if ($recept->getFruit() !== $this) {
            $recept->setFruit($this);
        }

        $this->recept = $recept;

        return $this;
    }
}
