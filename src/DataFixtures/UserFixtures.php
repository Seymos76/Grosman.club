<?php
/**
 * Created by PhpStorm.
 * User: seymos
 * Date: 07/09/18
 * Time: 18:10
 */

namespace App\DataFixtures;


use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for ($i = 1; $i <= 5; $i++) {
            $user = new User();
            $user->setActive(true);
        }
    }
}