<?php
/**
 * Created by PhpStorm.
 * User: seymos
 * Date: 07/09/18
 * Time: 16:01
 */

namespace App\Service\Email;


use App\Entity\User;
use Symfony\Component\DependencyInjection\ContainerInterface;

class EmailManager
{
    private $mailer;
    private $container;

    public function __construct(\Swift_Mailer $mailer, ContainerInterface $container)
    {
        $this->mailer = $mailer;
        $this->container = $container;
    }

    public function buildMessage()
    {

    }

    /**
     * @param User $user
     * @return bool
     * @throws \Throwable
     */
    public function sendCodeForAccountActivation(User $user)
    {
        $message = (new \Swift_Message("Votre compte Grosman.club"))
            ->setFrom('from@grosman.club')
            ->setTo($user->getEmail())
            ->setBody(
                $this->container->get('twig')->render(
                    'email/activation_code.html.twig',
                    array(
                        'user' => $user,
                        'activation_code' => $user->getActivationCode()
                    )
                ),
                "text/html"
            )
            ->addPart(
                $this->container->get('twig')->render(
                    'email/activation_code.txt.twig',
                    array(
                        'user' => $user,
                        'activation_code' => $user->getActivationCode()
                    )
                ),
                'text/plain'
            )
            ;
        if ($this->mailer->send($message)) {
            return true;
        } else {
            return false;
        }
    }
}
