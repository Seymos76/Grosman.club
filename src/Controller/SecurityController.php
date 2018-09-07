<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegisterType;
use App\Service\Security\UserManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    /**
     * @Route("/login", name="login")
     * @param AuthenticationUtils $authenticationUtils
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function login(AuthenticationUtils $authenticationUtils)
    {
        $last_username = $authenticationUtils->getLastUsername();
        $error = $authenticationUtils->getLastAuthenticationError();
        return $this->render(
            'security/login.html.twig', [
                'last_username' => $last_username,
                'error' => $error
            ]
        );
    }

    /**
     * @Route(path="/register", name="register")
     * @param Request $request
     * @param UserManager $manager
     * @return Response
     */
    public function register(Request $request, UserManager $manager)
    {
        $user = new User();
        $form = $this->createForm(RegisterType::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $manager->register($user);
            $this->addFlash('success', "Votre compte a été créé avec succès.");
            return $this->redirectToRoute('account');
        }
        return $this->render(
            'security/register.html.twig', ['form' => $form->createView()]
        );
    }

    /**
     * @Route(path="/activation-compte/{activation_code}", name="activate_account")
     * @param string $activation_code
     * @param UserManager $userManager
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function activateAccount(string $activation_code, UserManager $userManager)
    {
        $account_activated = $userManager->activateUser($activation_code);
        if ($account_activated === false) {
            $this->addFlash('error', "Votre compte a déjà été activé.");
        } else {
            $this->addFlash('success', "Votre compte a été activé avec succès !");
        }
        return $this->redirectToRoute('login');
    }

    /**
     * @Route(path="/logout", name="logout")
     */
    public function logout()
    {}
}
