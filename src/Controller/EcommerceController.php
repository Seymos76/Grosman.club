<?php

namespace App\Controller;

use App\Entity\CapColor;
use App\Entity\CapPatch;
use App\Entity\CapType;
use App\Entity\User;
use App\Form\RegisterType;
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
    public function configurator(Request $request)
    {
        $types = $this->getDoctrine()->getRepository(CapType::class)->findAll();
        $colors = $this->getDoctrine()->getRepository(CapColor::class)->findAll();
        $patches = $this->getDoctrine()->getRepository(CapPatch::class)->findAll();
        if ($request->isMethod("POST")) {
            $answer_type = $request->request->get('answer_group_1');
            $answer_color = $request->request->get('answer_group_2');
            $answer_patch = $request->request->get('answer_group_3');
            $birthdate = new \DateTime($request->request->get('birthdate'));
            if (!$birthdate instanceof \DateTime) {
                throw new \UnexpectedValueException("Could not parse the date : $birthdate");
            }
            dump($answer_type);
            dump($answer_color);
            dump($answer_patch);
            dump($birthdate);
            die;
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
