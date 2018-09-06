<?php
/**
 * Created by PhpStorm.
 * User: seymos
 * Date: 06/09/18
 * Time: 21:05
 */

namespace App\Service\Security;

use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class PasswordManager
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    /**
     * @param UserInterface $user
     * @param string $password
     * @return string
     */
    public function encodePassword(UserInterface $user, string $password)
    {
        $encoded = $this->passwordEncoder->encodePassword($user, $password);
        return $encoded;
    }
}
