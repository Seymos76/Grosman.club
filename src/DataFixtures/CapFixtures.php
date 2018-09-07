<?php
/**
 * Created by PhpStorm.
 * User: seymos
 * Date: 07/09/18
 * Time: 18:12
 */

namespace App\DataFixtures;


use App\Entity\Cap;
use App\Entity\CapColor;
use App\Entity\CapPatch;
use App\Entity\CapType;
use App\Entity\Vat;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class CapFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        for ($i = 1; $i <= 10; $i++) {
            $cap = new Cap();
            $cap->setDateCreation(new \DateTime('now'));
            $cap->setName("Cap$i");
            /** @var Vat $vat */
            $vat = $this->getReference('vat');
            /** @var CapPatch $patch */
            $patch = $this->getReference('patch'.rand(1,10));
            /** @var CapColor $color */
            $color = $this->getReference('color'.rand(1,10));
            /** @var CapType $type */
            $type = $this->getReference('type'.rand(1,5));
            $cap->setVat($vat);
            $cap->setColor($color);
            $cap->setPatch($patch);
            $cap->setType($type);
            $cap->setPricing(rand(10.0,50.0));
            $manager->persist($cap);
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            VatFixtures::class,
            CapColorFixtures::class,
            CapTypeFixtures::class,
            CapPatchFixtures::class
        );
    }
}
