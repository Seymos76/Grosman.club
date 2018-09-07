<?php

namespace App\Controller;

use App\Entity\CapColor;
use App\Entity\CapPatch;
use App\Entity\CapType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class EcommerceController extends AbstractController
{
    /**
     * @Route("/configurator", name="configurator")
     */
    public function configurator()
    {
        $types = $this->getDoctrine()->getRepository(CapType::class)->findAll();
        $colors = $this->getDoctrine()->getRepository(CapColor::class)->findAll();
        $patches = $this->getDoctrine()->getRepository(CapPatch::class)->findAll();
        return $this->render(
            'ecommerce/index.html.twig',
            [
                'types' => $types,
                'colors' => $colors,
                'patches' => $patches
            ]
        );
    }
}
