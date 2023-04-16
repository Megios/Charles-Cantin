<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ZHomePageController extends AbstractController
{
    
    
     /**
     * @Route("{slug}", name="homepage", requirements={"slug"=".+"})
     */
    public function indexAction(Request $request, $slug = "default")
    {
        return $this->render('page/home.html.twig');
    }
}

