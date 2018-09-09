<?php
/**
 * Created by PhpStorm.
 * User: seymos
 * Date: 06/09/18
 * Time: 20:27
 */

namespace App\Service;



use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\Entity;

class EntityManager
{
    protected $manager;

    public function __construct(EntityManagerInterface $manager)
    {
        $this->manager = $manager;
    }

    /**
     * @param $entity
     * @return Entity
     */
    public function update($entity)
    {
        $this->getManager()->persist($entity);
        $this->getManager()->flush();
        return $entity;
    }

    /**
     * @param $entity
     * @return bool
     */
    public function remove($entity)
    {
        $this->getManager()->remove($entity);
        $this->getManager()->flush();
        return true;
    }

    /**
     * @return EntityManagerInterface
     */
    public function getManager(): EntityManagerInterface
    {
        return $this->manager;
    }
}
