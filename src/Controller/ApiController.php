<?php

namespace App\Controller;

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
        $tableau = [];
        foreach ($photos as $photo) {
          array_push($tableau, ['title'=> $photo->getTitre(), 'source' => $photo->getSource(), 'type'=>$photo->getType()]);
        }
      }catch(\Exception $e){
        $tableau = [['title' => "Grossesse 4", 'source' => "./img/photo_grossesse4.jpg", "categories" => [
          "Grossesse"
        ], 'type' => "paysage"], ['title' => "Un titre de mariage", 'source' => "./img/photo_mariage1.jpg", "categories" => [
          "Mariage",
              "CouplePortrait"
        ], 'type' => "paysage"] ];
      }
      return new JsonResponse(['data' => $tableau]);
    } else {
      return new JsonResponse(['Message' => 'PAs du bon type', 'Error' => 'Json only']);
    }
  }
}