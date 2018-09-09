<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\OrderingRepository")
 */
class Ordering
{
    const VAT = 0.2;
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $date_creation;

    /**
     * @ORM\Column(type="string", length=50)
     */
    protected $number;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected $date_payment;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    protected $total_ht;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    protected $total_vat;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    protected $total_ttc;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="orderings", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    protected $user;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Cap", inversedBy="orderings")
     * @ORM\JoinColumn(nullable=false)
     */
    protected $cap;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Invoice", mappedBy="ordering", cascade={"persist", "remove"})
     */
    protected $invoice;

    public function __construct()
    {
        $this->date_creation = new \DateTime('now');
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getNumber(): ?string
    {
        return $this->number;
    }

    public function setNumber(string $number): self
    {
        $this->number = $number;

        return $this;
    }

    public function getDatePayment(): ?\DateTimeInterface
    {
        return $this->date_payment;
    }

    public function setDatePayment(?\DateTimeInterface $date_payment): self
    {
        $this->date_payment = $date_payment;

        return $this;
    }

    public function getTotalHt(): ?float
    {
        return $this->total_ht;
    }

    public function setTotalHt(?float $total_ht): self
    {
        $this->total_ht = $total_ht;

        return $this;
    }

    public function getTotalVat(): ?float
    {
        return $this->total_vat;
    }

    public function setTotalVat(?float $total_vat): self
    {
        $this->total_vat = $total_vat;

        return $this;
    }

    public function getTotalTtc(): ?float
    {
        return $this->total_ttc;
    }

    public function setTotalTtc(?float $total_ttc): self
    {
        $this->total_ttc = $total_ttc;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getCap(): ?Cap
    {
        return $this->cap;
    }

    public function setCap(?Cap $cap): self
    {
        $this->cap = $cap;

        return $this;
    }

    public function getInvoice(): ?Invoice
    {
        return $this->invoice;
    }

    public function setInvoice(Invoice $invoice): self
    {
        $this->invoice = $invoice;

        // set the owning side of the relation if necessary
        if ($this !== $invoice->getOrdering()) {
            $invoice->setOrdering($this);
        }

        return $this;
    }
}
