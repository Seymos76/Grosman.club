<?php
/**
 * Created by PhpStorm.
 * User: seymos
 * Date: 07/09/18
 * Time: 17:44
 */

namespace App\DataFixtures;


use App\Entity\CapType;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class CapTypeFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for ($i = 1; $i <= 5; $i++) {
            $cap_type = new CapType();
            $cap_type->setName("Forme $i");
            $cap_type->setSlug("forme_$i");
            $cap_type->setDateCreation(new \DateTime('now'));
            $cap_type->setImage("https://cdn.pixabay.com/photo/2017/07/21/14/28/hat-2525910_960_720.png");
            $this->addReference("type$i", $cap_type);
            $manager->persist($cap_type);
        }
        $manager->flush();
    }
}
