<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CapRepository")
 */
class Cap
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\CapType", inversedBy="caps")
     * @ORM\JoinColumn(nullable=false)
     */
    private $type;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\CapColor", inversedBy="caps")
     * @ORM\JoinColumn(nullable=false)
     */
    private $color;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\CapPatch", inversedBy="caps")
     * @ORM\JoinColumn(nullable=false)
     */
    private $patch;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date_creation;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $name;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $pricing;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Vat", inversedBy="caps")
     * @ORM\JoinColumn(nullable=false)
     */
    private $vat;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Ordering", mappedBy="cap")
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

    public function getType(): ?CapType
    {
        return $this->type;
    }

    public function setType(?CapType $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getColor(): ?CapColor
    {
        return $this->color;
    }

    public function setColor(?CapColor $color): self
    {
        $this->color = $color;

        return $this;
    }

    public function getPatch(): ?CapPatch
    {
        return $this->patch;
    }

    public function setPatch(?CapPatch $patch): self
    {
        $this->patch = $patch;

        return $this;
    }

    public function getDateCreation(): ?\DateTimeInterface
    {
        return $this->date_creation;
    }

    public function setDateCreation(\DateTimeInterface $date_creation): self
    {
        $this->date_creation = $date_creation;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getPricing(): ?float
    {
        return $this->pricing;
    }

    public function setPricing(?float $pricing): self
    {
        $this->pricing = $pricing;

        return $this;
    }

    public function getVat(): ?Vat
    {
        return $this->vat;
    }

    public function setVat(?Vat $vat): self
    {
        $this->vat = $vat;

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
            $ordering->setCap($this);
        }

        return $this;
    }

    public function removeOrdering(Ordering $ordering): self
    {
        if ($this->orderings->contains($ordering)) {
            $this->orderings->removeElement($ordering);
            // set the owning side to null (unless already changed)
            if ($ordering->getCap() === $this) {
                $ordering->setCap(null);
            }
        }

        return $this;
    }
}
