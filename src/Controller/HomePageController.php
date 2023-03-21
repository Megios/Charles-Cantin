<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomePageController extends AbstractController
{
    #[Route('/produit', name: 'app_produit')]
    public function produit(): Response
    {
        return $this->render('page/produit.html.twig');
    }
   
    
     /**
     * @Route("{slug}", name="homepage", requirements={"slug"=".+"})
     */
    public function indexAction(Request $request, $slug = "default")
    {
        return $this->render('page/home.html.twig');
    }
}

