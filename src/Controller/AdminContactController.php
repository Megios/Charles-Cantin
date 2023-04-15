<?php

namespace App\Controller;

use App\Repository\ContactRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminContactController extends AbstractController
{
    #[Route('admin/contact', name:'app_contacts')]
    public function index(ContactRepository $contactRep): Response
    {
        $contactsNonLu =$contactRep-> findby(array('isRead' => false), array('sendAt' => 'ASC'));
        $contactsLu =$contactRep-> findby(array('isRead' => true), array('sendAt' => 'ASC'));
        return $this->render('admin/contacts.html.twig', compact('contactsNonLu','contactsLu'));
    }
    #[Route('admin/contact/read/{id}', name:'read_contacts')]
    public function editcontact(EntityManagerInterface $em, contactRepository $contactRepository, Request $request, String $id): Response
    {
      $id = $request->get('id');
      try{
        $contact= $contactRepository->findOneBy(array('id' => $id));
      }catch(\Exception $e){
        $this->addFlash('danger', message:'Pas d\'contacts correspondante');
        $this->redirectToRoute('app_contacts');
      }
      if ($contact){
        return $this->render('admin/contact.html.twig', compact('contact'));
      }
      
      return $this->redirectToRoute('app_contacts');
  }
  #[Route('admin/contact/isRead/{id}', name:'isRead_contacts')]
    public function isreadcontact(EntityManagerInterface $em, contactRepository $contactRepository, Request $request, String $id): Response
    {
      $id = $request->get('id');
      try{
        $contact= $contactRepository->findOneBy(array('id' => $id));
      }catch(\Exception $e){
        $this->addFlash('danger', message:'Pas d\'contacts correspondante');
        $this->redirectToRoute('app_contacts');
      }
      if ($contact){
        $contact->setIsRead(!$contact->isIsRead());
        $em->flush();
        $this->addFlash('success',message:'Elements modifier avec succès');
        return $this->redirectToRoute('app_contacts');

      }
      
      return $this->redirectToRoute('app_contacts');
  }

  #[Route('admin/contacts/remove/{id}', name:'delete_contact')]
    public function Removecontact(Request $request, EntityManagerInterface $em,contactRepository $contactRepository, String $id): Response
    {
      $id = $request->get('id');
      try{
        $contact= $contactRepository->findOneBy(array('id' => $id));
        

      }catch(\Exception $e){
        $this->addFlash('danger', message:'Pas d\'contacts correspondante');
        $this->redirectToRoute('app_contacts');
      }
      $contactRepository->remove($contact);
      $em->flush();
      $this->addFlash('success',message:'Elements supprimé avec succès');
    return $this->redirectToRoute('app_contacts' );
  }
}