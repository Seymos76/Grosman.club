<?php
/**
 * Created by PhpStorm.
 * User: seymos
 * Date: 07/09/18
 * Time: 18:14
 */

namespace App\DataFixtures;


use App\Entity\Vat;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class VatFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $vat = new Vat();
        $vat->setName("TVA 20%");
        $vat->setValue(0.2);
        $this->addReference("vat", $vat);
        $manager->persist($vat);
        $manager->flush();
    }
}
