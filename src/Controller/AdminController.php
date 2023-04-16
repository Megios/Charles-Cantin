<?php

namespace App\Controller;

use App\Entity\Categorie;
use App\Entity\Contact;
use App\Entity\Offre;
use App\Entity\Photo;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    #[Route('/admin', name: 'app_admin')]
    public function index(EntityManagerInterface $em): Response
    {
        $photos = $em->getRepository(Photo::class)->findAll();
        $offres = $em->getRepository(Offre::class)->findAll();
        $categories = $em->getRepository(Categorie::class)->categorieVide(true);
        $messageNonLu = $em->getRepository(Contact::class)->findBy(array("isRead" => false));
        return $this->render('admin/index.html.twig', compact('photos', 'offres','categories','messageNonLu'));
    }
}
?>