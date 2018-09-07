<?php
/**
 * Created by PhpStorm.
 * User: seymos
 * Date: 07/09/18
 * Time: 17:23
 */

namespace App\DataFixtures;


use App\Entity\CapColor;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class CapColorFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for ($i = 1; $i <= 10; $i++) {
            $color = new CapColor();
            $color->setName("Couleur$i");
            $color->setSlug("couleur$i");
            $color->setHexa();
            $color->setRgba();
            $this->addReference("color$i", $color);
            $manager->persist($color);
        }

        $manager->flush();
    }
}
