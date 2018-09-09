<?php

namespace App\Controller;

use App\Entity\CapColor;
use App\Entity\CapPatch;
use App\Entity\CapType;
use App\Entity\User;
use App\Form\RegisterType;
use App\Service\Cap\CapManager;
use App\Service\Ordering\OrderingManager;
use App\Service\Security\UserManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class EcommerceController extends AbstractController
{
    /**
     * @Route(path="/", name="index")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index()
    {
        return $this->render('ecommerce/index.html.twig');
    }

    /**
     * @Route("/configurator", name="configurator")
     */
    public function configurator(Request $request, UserManager $userManager, CapManager $capManager, OrderingManager $orderingManager)
    {
        $types = $this->getDoctrine()->getRepository(CapType::class)->findAll();
        $colors = $this->getDoctrine()->getRepository(CapColor::class)->findAll();
        $patches = $this->getDoctrine()->getRepository(CapPatch::class)->findAll();
        if ($request->isMethod("POST")) {
            $answer_type = $request->request->get('answer_group_1');
            $answer_color = $request->request->get('answer_group_2');
            $answer_patch = $request->request->get('answer_group_3');
            $gender = $request->request->get('gender');
            $lastname = $request->request->get('lastname');
            $firstname = $request->request->get('firstname');
            $email = $request->request->get('email');
            $password = $request->request->get('password');
            $birthdate = new \DateTime($request->request->get('birthdate'));
            if (!$birthdate instanceof \DateTime) {
                throw new \UnexpectedValueException("Could not parse the date : $birthdate");
            }
            $cap = $capManager->createCap($answer_type, $answer_color, $answer_patch);
            $user = $userManager->register($gender, $lastname, $firstname, $email, $password, $birthdate);
            // envoi email de confirmation pour activation du compte client
            $orderingManager->createOrdering($cap, $user);
            // envoi email avec commande
            $this->addFlash('success',"Votre commande a été créée, vous pouvez la retrouver dans votre espace client.");
            return $this->redirectToRoute('login');
        }
        return $this->render(
            'ecommerce/configurator.html.twig',
            [
                'types' => $types,
                'colors' => $colors,
                'patches' => $patches
            ]
        );
    }
}
