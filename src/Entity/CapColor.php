<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CapColorRepository")
 */
class CapColor
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
     * @ORM\Column(type="string", length=255)
     */
    private $slug;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $rgba;

    /**
     * @ORM\Column(type="string", length=7)
     */
    private $hexa;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Cap", mappedBy="color")
     */
    private $caps;

    public function __construct()
    {
        $this->caps = new ArrayCollection();
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

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function getRgba(): ?string
    {
        return $this->rgba;
    }

    public function setRgba(string $rgba): self
    {
        $this->rgba = $rgba;

        return $this;
    }

    public function getHexa(): ?string
    {
        return $this->hexa;
    }

    public function setHexa(string $hexa): self
    {
        $this->hexa = $hexa;

        return $this;
    }

    /**
     * @return Collection|Cap[]
     */
    public function getCaps(): Collection
    {
        return $this->caps;
    }

    public function addCap(Cap $cap): self
    {
        if (!$this->caps->contains($cap)) {
            $this->caps[] = $cap;
            $cap->setColor($this);
        }

        return $this;
    }

    public function removeCap(Cap $cap): self
    {
        if ($this->caps->contains($cap)) {
            $this->caps->removeElement($cap);
            // set the owning side to null (unless already changed)
            if ($cap->getColor() === $this) {
                $cap->setColor(null);
            }
        }

        return $this;
    }
}
