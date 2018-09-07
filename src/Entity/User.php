<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User implements UserInterface, \Serializable
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $password;

    /**
     * @ORM\Column(type="boolean")
     */
    private $active;

    /**
     * @ORM\Column(type="array")
     */
    private $roles = [];

    /**
     * @ORM\Column(type="datetime")
     */
    private $date_register;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $last_connexion;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $token;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $activation_code;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\CapPatch", mappedBy="author")
     */
    private $capPatches;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Ordering", mappedBy="user")
     */
    private $orderings;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\UserAddress", mappedBy="user")
     */
    private $userAddresses;

    public function __construct()
    {
        $this->capPatches = new ArrayCollection();
        $this->orderings = new ArrayCollection();
        $this->userAddresses = new ArrayCollection();
        $this->activation_code = md5(uniqid('code_', false));
        $this->date_register = new \DateTime('now');
        $this->roles = array("ROLE_USER");
        $this->active = false;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getActive(): ?bool
    {
        return $this->active;
    }

    public function setActive(bool $active): self
    {
        $this->active = $active;

        return $this;
    }

    public function getRoles(): ?array
    {
        return $this->roles;
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    public function getDateRegister(): ?\DateTimeInterface
    {
        return $this->date_register;
    }

    public function setDateRegister(\DateTimeInterface $date_register): self
    {
        $this->date_register = $date_register;

        return $this;
    }

    public function getLastConnexion(): ?\DateTimeInterface
    {
        return $this->last_connexion;
    }

    public function setLastConnexion(?\DateTimeInterface $last_connexion): self
    {
        $this->last_connexion = $last_connexion;

        return $this;
    }

    public function getToken(): ?string
    {
        return $this->token;
    }

    public function setToken(?string $token): self
    {
        $this->token = $token;

        return $this;
    }

    public function getActivationCode(): ?string
    {
        return $this->activation_code;
    }

    public function setActivationCode(?string $activation_code): self
    {
        $this->activation_code = $activation_code;

        return $this;
    }

    /**
     * @return Collection|CapPatch[]
     */
    public function getCapPatches(): Collection
    {
        return $this->capPatches;
    }

    public function addCapPatch(CapPatch $capPatch): self
    {
        if (!$this->capPatches->contains($capPatch)) {
            $this->capPatches[] = $capPatch;
            $capPatch->setAuthor($this);
        }

        return $this;
    }

    public function removeCapPatch(CapPatch $capPatch): self
    {
        if ($this->capPatches->contains($capPatch)) {
            $this->capPatches->removeElement($capPatch);
            // set the owning side to null (unless already changed)
            if ($capPatch->getAuthor() === $this) {
                $capPatch->setAuthor(null);
            }
        }

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
            $ordering->setUser($this);
        }

        return $this;
    }

    public function removeOrdering(Ordering $ordering): self
    {
        if ($this->orderings->contains($ordering)) {
            $this->orderings->removeElement($ordering);
            // set the owning side to null (unless already changed)
            if ($ordering->getUser() === $this) {
                $ordering->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|UserAddress[]
     */
    public function getUserAddresses(): Collection
    {
        return $this->userAddresses;
    }

    public function addUserAddress(UserAddress $userAddress): self
    {
        if (!$this->userAddresses->contains($userAddress)) {
            $this->userAddresses[] = $userAddress;
            $userAddress->addUser($this);
        }

        return $this;
    }

    public function removeUserAddress(UserAddress $userAddress): self
    {
        if ($this->userAddresses->contains($userAddress)) {
            $this->userAddresses->removeElement($userAddress);
            $userAddress->removeUser($this);
        }

        return $this;
    }

    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }

    public function getSalt()
    {
        // TODO: Implement getSalt() method.
    }

    /** @see \Serializable::serialize() */
    public function serialize()
    {
        return serialize(array(
            $this->id,
            $this->username,
            $this->password,
            $this->email
            // see section on salt below
            // $this->salt,
        ));
    }

    /** @see \Serializable::unserialize() */
    public function unserialize($serialized)
    {
        list (
            $this->id,
            $this->username,
            $this->password,
            $this->email
            // see section on salt below
            // $this->salt
            ) = unserialize($serialized, array('allowed_classes' => false));
    }
}
