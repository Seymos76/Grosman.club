<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\InvoiceRepository")
 */
class Invoice extends Ordering
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Ordering", inversedBy="invoice", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $ordering;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOrdering(): ?Ordering
    {
        return $this->ordering;
    }

    public function setOrdering(Ordering $ordering): self
    {
        $this->ordering = $ordering;

        return $this;
    }
}
