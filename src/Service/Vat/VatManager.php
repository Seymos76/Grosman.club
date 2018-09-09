<?php
/**
 * Created by PhpStorm.
 * User: seymos
 * Date: 09/09/18
 * Time: 13:35
 */

namespace App\Service\Vat;


use App\Entity\Vat;
use App\Service\EntityManager;
use Doctrine\ORM\EntityManagerInterface;

class VatManager extends EntityManager
{
    public function __construct(EntityManagerInterface $manager)
    {
        parent::__construct($manager);
    }

    /**
     * @return Vat|null|object
     */
    public function getVat()
    {
        $vat = $this->manager->getRepository(Vat::class)->find(1);
        return $vat;
    }
}
