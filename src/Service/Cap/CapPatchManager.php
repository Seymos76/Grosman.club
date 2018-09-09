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
     * @param int $id
     * @return CapPatch
     */
    public function getCapPatch(int $id)
    {
        $patch = $this->manager->getRepository(CapPatch::class)->find($id);
        return $patch;
    }
}