<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use phpDocumentor\Reflection\Types\Self_;

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

    public function setRgba(string $rgba = null): self
    {
        $this->rgba = "rgba(".self::random_color_part().", ".self::random_color_part().", ".self::random_color_part().", 1)";;

        return $this;
    }

    public function getHexa(): ?string
    {
        return $this->hexa;
    }

    public function setHexa(string $hexa = null): self
    {
        $this->hexa = self::random_color();

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

    /**
     * @return string
     */
    public function random_color_part() {
        $color = str_pad( dechex( mt_rand( 0, 255 ) ), 2, '0', STR_PAD_LEFT);
        return $color;
    }

    /**
     * @return string
     */
    public function random_color() {
        $color = $this->random_color_part() . $this->random_color_part() . $this->random_color_part();
        return $color;
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
