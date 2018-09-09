<?php

namespace App\Controller;

use App\Service\Cap\CapManager;
use App\Service\Ordering\OrderingManager;
use App\Service\Security\UserManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class AccountController
 * @package App\Controller
 * @Security("is_granted('ROLE_USER')")
 */
class AccountController extends AbstractController
{
    /**
     * @Route("/account", name="account")
     */
    public function account(UserManager $userManager, OrderingManager $orderingManager, CapManager $capManager)
    {
        $user = $userManager->getCurrentUser($this->getUser()->getEmail());
        $cap =
        $orderings = $orderingManager->getOrderingsByUser($user);
        return $this->render('account/index.html.twig', [
            'orderings' => $orderings,
        ]);
    }
}
