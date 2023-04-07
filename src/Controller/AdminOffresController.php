<?php

namespace App\Controller;

use App\Entity\Offre;
use App\Form\OffreFormType;
use App\Repository\OffreRepository;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminOffresController extends AbstractController
{

    #[Route('admin/offres', name:'app_offres')]
    public function index(OffreRepository $offreRepository): Response
    {
        $offres = $offreRepository->findAll();
        return $this->render('admin/offres.html.twig', compact('offres'));
    }

    #[Route('admin/offres/add', name:'add_offres')]
    public function ajoutOffre(EntityManager $em, OffreRepository $offreRepository, Request $request): Response
    {
      $offre= new Offre();

      $offreForm = $this->createForm(OffreFormType::class, $offre);

      $offreForm->handleRequest($request);

      if ($offreForm->isSubmitted() && $offreForm->isValid()){
        $titre = $offreForm->get('name')->getData();
        $offre->setName($titre);
        $desc = $offreForm->get('description')->getData();
        $offre->setDescription($desc);
        $prix=$offreForm->get('prix')->getData();
        $offre->setPrix($prix);
        if ($offreForm->get('ordre')->getData()) {
          $ordre = $offreForm->get('ordre')->getData();
          $ind = $ordre;
          while ($offreRepository->findOneby(array('ordre' => $ind))) {
            $offreRepository->findOneby(array('ordre' => $ind ))->setOrdre($ind+1);
            $ind++;
          }
          $offre->setOrdre($ordre);
        }
        else{
          $tab = $offreRepository->findBy(array(),array('ordre'=>'DESC'));
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
    public function EditOffre(EntityManager $em, OffreRepository $offreRepository, Request $request, String $id): Response
    {
      $id = $request->get('id');
      try{
        $offre= $offreRepository->findOneBy(array('uuid' => $id));
      }catch(\Exception $e){
        $this->addFlash('danger', message:'Pas d\'offres correspondante');
        $this->redirectToRoute('app_admin');
      }
      

      $offreForm = $this->createForm(OffreFormType::class, $offre);

      $offreForm->handleRequest($request);

      if ($offreForm->isSubmitted() && $offreForm->isValid()){
        $titre = $offreForm->get('name')->getData();
        $offre->setName($titre);
        $desc = $offreForm->get('description')->getData();
        $offre->setDescription($desc);
        $prix=$offreForm->get('prix')->getData();
        $offre->setPrix($prix);
        $base = $offre->getOrdre();
        if ($offreForm->get('ordre')->getData() > $base) {
            $ordre = $offreForm->get('ordre')->getData();
            for ($i = $base +1; $i++; $i<=$ordre) {
                $offreTemp = $offreRepository->findOneBy(array('ordre'=> $i));
                if ($offreTemp !== null) {
                    $offreTemp->setOrdre($offreTemp->getOrdre()-1);
                }
            }
            $offre->setOrdre($ordre);
        }
        if ($offreForm->get('ordre')->getData() < $base) {
          $ordre = $offreForm->get('ordre')->getData();
          for ($i = $base -1; $i--; $i>=$ordre) {
              $offreTemp = $offreRepository->findOneBy(array('ordre'=> $i));
              if ($offreTemp !== null) {
                  $offreTemp->setOrdre($offreTemp->getOrdre()+1);
              }
          }
          $offre->setOrdre($ordre);
      }
      $em->persist($offre);
      $em->flush();
      $this->addFlash('success',message:'Elements modifier avec succès');
      return $this->redirectToRoute('app_offres');
    }
    return $this->render('admin/editOffres.html.twig', ["OffreForm" => $offreForm->createView()]);
  }

  #[Route('admin/offres/delete/{id}', name:'delete_offres')]
    public function DeleteOffre(EntityManager $em, OffreRepository $offreRepository, Request $request, String $id): Response
    {
      $id = $request->get('id');
      try{
        $offre= $offreRepository->findOneBy(array('uuid' => $id));
      }catch(\Exception $e){
        $this->addFlash('danger', message:'Pas d\'offres correspondante');
        $this->redirectToRoute('app_admin');
      }

      $tabOffre = $offreRepository->findby(array(),array('ordre' => 'ASC'));

      $base = array_search($offre, $tabOffre, true);
      if ($base!==false){
        for ($base+1;$base++;$base< count($tabOffre)){
          $tabOffre[$base]->setOrdre($tabOffre[$base]->getOrdre()-1);
        }
        $offreRepository->remove($offre);
        $em->flush();
        $this->addFlash('success',message:'Elements supprimé avec succès');
      }

      
    return $this->redirectToRoute('app_offres');
  }


}
