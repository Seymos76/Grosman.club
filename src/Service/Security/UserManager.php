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
     * @param string $gender
     * @param string $lastname
     * @param string $firstname
     * @param string $email
     * @param string $password
     * @param \DateTime $birthdate
     * @return User
     */
    public function register(string $gender, string $lastname, string $firstname, string $email, string $password, \DateTime $birthdate)
    {
        $user = new User();
        $user->setGender($gender);
        $user->setLastname($lastname);
        $user->setFirstname($firstname);
        $user->setEmail($email);
        $user->setBirthdate($birthdate);
        $encoded_password = $this->passwordManager->encodePassword($user, $password);
        $user->setPassword($encoded_password);
        $this->manager->update($user);
        return $user;
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

    /**
     * @param string $email
     * @return User|null|object
     */
    public function getCurrentUser(string $email)
    {
        $user = $this->manager->getManager()->getRepository(User::class)->findOneBy(
            array(
                'email' => $email
            )
        );
        return $user;
    }
}
