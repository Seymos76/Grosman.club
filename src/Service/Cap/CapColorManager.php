<?php
/**
 * Created by PhpStorm.
 * User: seymos
 * Date: 09/09/18
 * Time: 12:49
 */

namespace App\Service\Cap;


use App\Entity\CapColor;
use App\Service\EntityManager;
use Doctrine\ORM\EntityManagerInterface;

class CapColorManager extends EntityManager
{
    public function __construct(EntityManagerInterface $manager)
    {
        parent::__construct($manager);
    }

    /**
     * @param string $name
     * @return CapColor
     */
    public function getCapColor(string $name)
    {
        $color = $this->manager->getRepository(CapColor::class)->findByName($name);
        return $color;
    }
}