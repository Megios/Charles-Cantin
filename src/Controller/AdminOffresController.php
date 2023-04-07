<?php

namespace App\Controller;

use App\Entity\Offre;
use App\Form\OffreFormType;
use App\Repository\OffreRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminOffresController extends AbstractController
{

    #[Route('admin/offres', name:'app_offres')]
    public function index(OffreRepository $offreRepository): Response
    {
        $offres = $offreRepository->findBy(array(),array('Ordre'=>'ASC'));
        return $this->render('admin/offres.html.twig', compact('offres'));
    }

    #[Route('admin/offres/add', name:'add_offres')]
    public function ajoutOffre(EntityManagerInterface $em, OffreRepository $offreRepository, Request $request): Response
    {
      $offre= new Offre();

      $offreForm = $this->createForm(OffreFormType::class, $offre);

      $offreForm->handleRequest($request);

      if ($offreForm->isSubmitted() && $offreForm->isValid()){
        $titre = $offreForm->get('Name')->getData();
        $offre->setName($titre);
        $desc = $offreForm->get('Description')->getData();
        $offre->setDescription($desc);
        $prix=$offreForm->get('Prix')->getData();
        $offre->setPrix($prix);
        if ($offreForm->get('Ordre')->getData()) {
          $ordre = $offreForm->get('Ordre')->getData();
          $ind = $ordre;
          while ($offreRepository->findOneby(array('Ordre' => $ind))) {
            $offreRepository->findOneby(array('Ordre' => $ind ))->setOrdre($ind+1);
            $ind++;
          }
          $offre->setOrdre($ordre);
        }
        else{
          $tab = $offreRepository->findBy(array(),array('Ordre'=>'DESC'));
          $ordre = $tab[0]->getOrdre()+1;
          $offre->setOrdre($ordre);
        }
        $em->persist($offre);
        $em->flush();
        $this->addFlash('success',message:'Elements Ajouté avec succès');
        return $this->redirectToRoute('app_offres');

      }
      return $this->render('admin/AddOffres.html.twig', ["OffreForm" => $offreForm->createView()]);
    }

    #[Route('admin/offres/edit/{id}', name:'edit_offres')]
    public function EditOffre(EntityManagerInterface $em, OffreRepository $offreRepository, Request $request, String $id): Response
    {
      $id = $request->get('id');
      try{
        $offre= $offreRepository->findOneBy(array('uuid' => $id));
        $base = $offre->getOrdre();
      }catch(\Exception $e){
        $this->addFlash('danger', message:'Pas d\'offres correspondante');
        $this->redirectToRoute('app_admin');
      }
      

      $offreForm = $this->createForm(OffreFormType::class, $offre);

      $offreForm->handleRequest($request);

      if ($offreForm->isSubmitted() && $offreForm->isValid()){
        $titre = $offreForm->get('Name')->getData();
        $offre->setName($titre);
        $desc = $offreForm->get('Description')->getData();
        $offre->setDescription($desc);
        $prix=$offreForm->get('Prix')->getData();
        $offre->setPrix($prix);
        $ordre = $offreForm->get('Ordre')->getData();
        if ($ordre > $base) {
          $i = $base +1;
          while ($i <= $ordre) {
            $offreTemp = $offreRepository->findOneBy(array('Ordre'=> $i));
            var_dump($offreTemp);
            if ($offreTemp !== null) {
              $offreTemp->setOrdre($offreTemp->getOrdre()-1);
            }
            $i++;
          };
            $offre->setOrdre($ordre);
        }
        if ($ordre < $base) {
          $i = $base +1;
          while ($i >= $ordre) {
              $offreTemp = $offreRepository->findOneBy(array('Ordre'=> $i));
              if ($offreTemp !== null) {
                  $offreTemp->setOrdre($offreTemp->getOrdre()+1);
              }
              $i--;
          }
          $offre->setOrdre($ordre);
      }
      $em->persist($offre);
      $em->flush();
      $this->addFlash('success',message:'Elements modifier avec succès');
      return $this->redirectToRoute('app_offres');
    }
    return $this->render('admin/editOffres.html.twig', ["OffreForm" => $offreForm->createView(),'offre' => $offre ]);
  }

  #[Route('admin/offres/delete/{id}', name:'delete_offres')]
    public function DeleteOffre(EntityManagerInterface $em, OffreRepository $offreRepository, Request $request, String $id): Response
    {
      $id = $request->get('id');
      try{
        $offre= $offreRepository->findOneBy(array('uuid' => $id));
      }catch(\Exception $e){
        $this->addFlash('danger', message:'Pas d\'offres correspondante');
        $this->redirectToRoute('app_admin');
      }

      $tabOffre = $offreRepository->findby(array(),array('Ordre' => 'ASC'));

      $base = array_search($offre, $tabOffre, true);
      if ($base!==false){
        $i = $base +1;
        while($i<=count($tabOffre)-1){
          $tabOffre[$i]->setOrdre($tabOffre[$i]->getOrdre()-1);
          $i++;
        }
        $offreRepository->remove($offre);
        $em->flush();
        $this->addFlash('success',message:'Elements supprimé avec succès');
      }

      
    return $this->redirectToRoute('app_offres');
  }


}
