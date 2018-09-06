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
    private $userLoader;

    public function __construct(EntityManager $manager, PasswordManager $passwordManager, UserLoaderInterface $userLoader)
    {
        $this->manager = $manager;
        $this->passwordManager = $passwordManager;
        $this->userLoader = $userLoader;
    }

    /**
     * @param UserInterface $user
     */
    public function register(User $user)
    {
        $password = $this->passwordManager->encodePassword($user, $user->getPassword());
        $user->setPassword($password);
        $this->manager->update($user);
    }

    public function getUser()
    {
        $user = $this->userLoader->loadUserByUsername();
    }
}
