<?php
/**
 * Created by PhpStorm.
 * User: seymos
 * Date: 09/09/18
 * Time: 13:03
 */

namespace App\Service\Cap;


use App\Entity\CapType;
use App\Service\EntityManager;
use Doctrine\ORM\EntityManagerInterface;

class CapTypeManager extends EntityManager
{
    public function __construct(EntityManagerInterface $manager)
    {
        parent::__construct($manager);
    }

    /**
     * @param int $id
     * @return CapType
     */
    public function getType(int $id)
    {
        $type = $this->manager->getRepository(CapType::class)->find($id);
        return $type;
    }
}