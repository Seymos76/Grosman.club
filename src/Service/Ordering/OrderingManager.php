<?php
/**
 * Created by PhpStorm.
 * User: seymos
 * Date: 09/09/18
 * Time: 13:45
 */

namespace App\Service\Ordering;


use App\Entity\Ordering;
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
        $uniq = uniqid();
        $number = $y.$m.$d.$uniq;
        return $number;
    }

    public function createOrdering()
    {
        $ordering = new Ordering();
        $ordering->setNumber(self::setOrderingNumber());
    }
}
