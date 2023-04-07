<?php
namespace App\Controller;


use App\Entity\Photo;
use App\Form\PhotoFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

class AdminPhotoController extends AbstractController
{
    #[Route('/admin/photos', name: 'app_photos')]
    public function index(Request $request,EntityManagerInterface $em)
    {
        $photos = $em->getRepository(Photo::class)->findAll();
        return $this->render('admin/photos.html.twig', compact('photos'));

}


    #[Route('/admin/photos/add', name: 'add_photo')]
    public function addPhoto(Request $request, SluggerInterface $slugger,EntityManagerInterface $em)
    {
      
        $image = new Photo();
        $form = $this->createForm(PhotoFormType::class, $image);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var UploadedFile $imageFile */
            $imageFile = $form->get('source')->getData();
            $imageFormat = $form->get('type')->getData();
            $imageTitre= $form->get('titre')->getData();
            $imageCategories = $form->get('categories')->getData();
            // this condition is needed because the 'image' field is not required
            // so the PDF file must be processed only when a file is uploaded
            if ($imageFile) {
                $originalFilename = pathinfo($imageFile->getClientOriginalName(), PATHINFO_FILENAME);
                // this is needed to safely include the file name as part of the URL
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$imageFile->guessExtension();

                // Move the file to the directory where images are stored
                try {
                    $imageFile->move(
                        $this->getParameter('images_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }

                // updates the 'imageFilename' property to store the PDF file name
                // instead of its contents
                $image->setSource($newFilename);
                $image->setType($imageFormat);
                $image->setTitre($imageTitre);
                foreach ($imageCategories as $imageCategorie) {
                  $image->addCategory($imageCategorie);
                }
                $em->persist($image);
                $em->flush();
                return $this->redirectToRoute('app_photos');
            }
        }

        return $this->render('admin/newImage.html.twig', [
            'form' => $form,
        ]);
    }
    #[Route('/admin/removeImage/{id}', name: 'app_galerie_remove')]
    public function remove(Request $request, EntityManagerInterface $em,Photo $image)
    {
        $id = $request->get('id');
        $image= $em->getRepository(Photo::class)->findoneBy(array('uuid'=>$id));
        if ($image){
            $nomImage= $this->getParameter("images_directory").'/'.$image->getimageFilename();
            if(file_exists($nomImage)){
                unlink($nomImage);
            }
        }
        $em->remove($image);
        $em->flush();
        return $this->redirectToRoute('app_structure');
}
}
?>