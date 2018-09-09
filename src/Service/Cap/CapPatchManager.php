<?php
/**
 * Created by PhpStorm.
 * User: seymos
 * Date: 09/09/18
 * Time: 13:04
 */

namespace App\Service\Cap;


use App\Entity\CapPatch;
use App\Service\EntityManager;
use Doctrine\ORM\EntityManagerInterface;

class CapPatchManager extends EntityManager
{
    public function __construct(EntityManagerInterface $manager)
    {
        parent::__construct($manager);
    }

    /**
     * @param string $name
     * @return CapPatch
     */
    public function getCapPatch(string $name)
    {
        $patch = $this->manager->getRepository(CapPatch::class)->findByName($name);
        return $patch;
    }
}