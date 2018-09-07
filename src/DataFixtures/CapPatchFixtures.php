<?php
/**
 * Created by PhpStorm.
 * User: seymos
 * Date: 07/09/18
 * Time: 18:04
 */

namespace App\DataFixtures;


use App\Entity\CapPatch;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class CapPatchFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for ($i = 1; $i <= 10; $i++) {
            $patch = new CapPatch();
            $patch->setName("Patch$i");
            $patch->setSlug("patch$i");
            $patch->setDateCreation(new \DateTime('now'));
            $patch->setDescription("Ma description");
            $patch->setStock(rand(0,50));
            $patch->setImage("https://img.chapeaushop.fr/Casquette-Classic-Patch-Snapback-by-Vans-bleu-fonce.46616_rf192.jpg");
            $this->addReference("patch$i", $patch);
            $manager->persist($patch);
        }
        $manager->flush();
    }
}
