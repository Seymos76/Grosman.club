<?php
/**
 * Created by PhpStorm.
 * User: seymos
 * Date: 09/09/18
 * Time: 13:45
 */

namespace App\Service\Ordering;


use App\Entity\Cap;
use App\Entity\Ordering;
use App\Entity\User;
use App\Service\EntityManager;
use Doctrine\ORM\EntityManagerInterface;

class OrderingManager extends EntityManager
{
    public function __construct(EntityManagerInterface $manager)
    {
        parent::__construct($manager);
    }

    /**
     * @return string
     */
    public function setOrderingNumber()
    {
        $datetime = new \DateTime('now');
        $y = $datetime->format('Y');
        $m = $datetime->format('m');
        $d = $datetime->format('d');
        $nb = rand(50,500);
        $number = $y.$m.$d.$nb;
        return $number;
    }

    /**
     * @param Cap $cap
     * @param User $user
     * @return Ordering
     */
    public function createOrdering(Cap $cap, User $user)
    {
        $ordering = new Ordering();
        $ordering->setNumber(self::setOrderingNumber());
        $ordering->setCap($cap);
        $ordering->setUser($user);
        $this->update($ordering);
        return $ordering;
    }

    /**
     * @param User $user
     * @return array
     */
    public function getOrderingsByUser(User $user)
    {
        $orderings = $this->manager->getRepository(Ordering::class)->findBy(
            array(
                'user' => $user
            )
        );
        return $orderings;
    }

    public function getAll()
    {
        $orderings = $this->manager->getRepository(Ordering::class)->findAll();
        return $orderings;
    }
}
