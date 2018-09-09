<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\VatRepository")
 */
class Vat
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $name;

    /**
     * @ORM\Column(type="float")
     */
    private $value;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Ordering", mappedBy="vat")
     */
    private $orderings;

    public function __construct()
    {
        $this->orderings = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getValue(): ?float
    {
        return $this->value;
    }

    public function setValue(float $value): self
    {
        $this->value = $value;

        return $this;
    }

    /**
     * @return Collection|Ordering[]
     */
    public function getOrderings(): Collection
    {
        return $this->orderings;
    }

    public function addOrdering(Ordering $ordering): self
    {
        if (!$this->orderings->contains($ordering)) {
            $this->orderings[] = $ordering;
            $ordering->setVat($this);
        }

        return $this;
    }

    public function removeOrdering(Ordering $ordering): self
    {
        if ($this->orderings->contains($ordering)) {
            $this->orderings->removeElement($ordering);
            // set the owning side to null (unless already changed)
            if ($ordering->getVat() === $this) {
                $ordering->setVat(null);
            }
        }

        return $this;
    }
}
