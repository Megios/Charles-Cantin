<?php

namespace App\Controller;

use App\Entity\Categorie;
use App\Entity\Contact;
use App\Entity\Offre;
use App\Entity\Photo;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;



class ApiController extends AbstractController
{
  #[Route('/getPhotos', name: 'get_photo')]
  public function index(Request $request, EntityManagerInterface $em)
  {
    if ($request->headers->get('Accept') === "application/json, text/plain, */*") {
      $timeeS = $request->get('secu');
      try 
      {
        $photos = $em->getRepository(Photo::class)->findAll();
        $categories = [];
        foreach ($em->getRepository(Categorie::class)->findAll() as $categorie) {
          array_push($categories, $categorie->getNom());
        } ;
        $tableau = [];
        foreach ($photos as $photo) {
          $catTab = [];
          foreach ($photo->getCategories() as $categorie) {
            array_push($catTab, $categorie->getNom() );
          }
          array_push($tableau, ['title'=> $photo->getTitre(), 'source' => 'uploads/images/'.$photo->getSource(), 'type'=>$photo->getType(), "categories" => $catTab]);
        }
      }catch(\Exception $e){
        $tableau = [['title' => "Grossesse 4", 'source' => "./img/photo_grossesse4.jpg", "categories" => [
          "Grossesse"
        ], 'type' => "paysage"], ['title' => "Un titre de mariage", 'source' => "./img/photo_mariage1.jpg", "categories" => [
          "Mariage",
              "CouplePortrait"
        ], 'type' => "paysage"] ];
      }
      return new JsonResponse(['data' => $tableau, 'categories' => $categories]);
    } else {
      return new JsonResponse(['Message' => 'PAs du bon type', 'Error' => 'Json only']);
    }
  }
  #[Route('/getOffres', name: 'get_offres')]
  public function offres(Request $request, EntityManagerInterface $em)
  {
    if ($request->headers->get('Accept') === "application/json, text/plain, */*") {
      $timeeS = $request->get('secu');
      try 
      {
        $offres = $em->getRepository(Offre::class)->findby(array(), array('Ordre' => "ASC"));
        $tableau = [];
        foreach ($offres as $offre) {
          array_push($tableau, ['title'=> $offre->getName(), 'content' => $offre->getDescription(), 'tarif'=>$offre->affichePrix()]);
        }
      }catch(\Exception $e){
        $tableau = [['title' => "Juste pour moi", 'content' => "Séance pour une personne, en extérieur ou en studio", "tarif" => "130 euros"
        ]];
      }
      return new JsonResponse(['data' => $tableau]);
    } else {
      return new JsonResponse(['Message' => 'PAs du bon type', 'Error' => 'Json only']);
    }
  }
  #[Route('/addContact', name: 'addContact')]
    public function ajoutContact(Request $test, EntityManagerInterface $em)
    {
        if ($test->headers->get('content-type') === "application/json") {
            $testform = json_decode($test->getContent(), true);
            $contact = new Contact();
            $contact->setName($testform['object']['nom']['content']);
            $contact->setFirstname($testform['object']['prenom']['content']);
            $contact->setEmail($testform['object']['email']['content']);
            $contact->setMessage($testform['object']['message']['content']);
            
            $em->persist($contact);
            $em->flush();
            return new JsonResponse(['Message' => 'L\'ajout deu message s\'est bien dérouler']);
        } else {
            return new JsonResponse(['Message' => 'PAs du bon type','Error' => 'Json only']);
        }
    }
}