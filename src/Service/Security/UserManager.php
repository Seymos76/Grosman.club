<?php
/**
 * Created by PhpStorm.
 * User: seymos
 * Date: 06/09/18
 * Time: 20:26
 */

namespace App\Service\Security;


use App\Entity\User;
use App\Service\EntityManager;
use Symfony\Bridge\Doctrine\Security\User\UserLoaderInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class UserManager
{
    private $manager;
    private $passwordManager;

    public function __construct(EntityManager $manager, PasswordManager $passwordManager)
    {
        $this->manager = $manager;
        $this->passwordManager = $passwordManager;
    }

    /**
     * @param User $user
     */
    public function register(User $user)
    {
        $password = $this->passwordManager->encodePassword($user, $user->getPassword());
        $user->setPassword($password);
        $this->manager->update($user);
    }

    public function activateUser(string $code)
    {
        $user = $this->manager->getManager()->getRepository(User::class)->getUserByActivationCode($code);
        if (!$user) {
            return false;
        } else {
            $user->setActive(true);
            $user->setActivationCode(null);
            $this->manager->update($user);
            return true;
        }
    }
}
