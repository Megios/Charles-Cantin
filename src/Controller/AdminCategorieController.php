<?php

namespace App\Controller;

use App\Entity\Categorie;
use App\Form\CategorieFormType;
use App\Repository\CategorieRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminCategorieController extends AbstractController
{
  #[Route('admin/categories', name:'app_categories')]
  public function index(CategorieRepository $categoriesRep): Response
  {
    $categorieTab =$categoriesRep-> findAll();
    return $this->render('admin/categories.html.twig', compact('categorieTab'));
  }

  #[Route('admin/categories/add', name:'add_categorie')]
    public function ajoutcategorie(EntityManagerInterface $em, Request $request): Response
    {
      $categorie= new Categorie();

      $categorieForm = $this->createForm(CategorieFormType::class, $categorie);

      $categorieForm->handleRequest($request);

      if ($categorieForm->isSubmitted() && $categorieForm->isValid()){
        $nom = $categorieForm->get('Nom')->getData();
        $categorie->setNom($nom);
        $em->persist($categorie);
        $em->flush();
        $this->addFlash('success',message:'Categorie Ajouté avec succès');
        return $this->redirectToRoute('app_categories');

      }
      return $this->render('admin/Addcategories.html.twig', ["categorieForm" => $categorieForm->createView()]);
    }

    #[Route('admin/categories/edit/{id}', name:'edit_categories')]
    public function editCategorie(EntityManagerInterface $em, categorieRepository $categorieRepository, Request $request, String $id): Response
    {
      $id = $request->get('id');
      try{
        $categorie= $categorieRepository->findOneBy(array('id' => $id));
      }catch(\Exception $e){
        $this->addFlash('danger', message:'Pas d\'categories correspondante');
        $this->redirectToRoute('app_admin');
      }

      $categorieForm = $this->createForm(categorieFormType::class, $categorie);

      $categorieForm->handleRequest($request);

      if ($categorieForm->isSubmitted() && $categorieForm->isValid()){
        $nom = $categorieForm->get('Nom')->getData();
        $categorie->setNom($nom);
        $em->persist($categorie);
        $em->flush();
        $this->addFlash('success',message:'Elements modifier avec succès');
        return $this->redirectToRoute('app_categories');
      }
    return $this->render('admin/editcategories.html.twig', ["categorieForm" => $categorieForm->createView(), "categorie" => $categorie]);
  }

  #[Route('admin/categories/remove/{id}', name:'delete_categorie')]
    public function RemoveCategorie(Request $request, EntityManagerInterface $em,categorieRepository $categorieRepository, String $id): Response
    {
      $id = $request->get('id');
      try{
        $categorie= $categorieRepository->findOneBy(array('id' => $id));
        

      }catch(\Exception $e){
        $this->addFlash('danger', message:'Pas d\'categories correspondante');
        $this->redirectToRoute('app_admin');
      }
      $categorieRepository->remove($categorie);
      $em->flush();
      $this->addFlash('success',message:'Elements supprimé avec succès');
    return $this->redirectToRoute('app_categories' );
  }


}